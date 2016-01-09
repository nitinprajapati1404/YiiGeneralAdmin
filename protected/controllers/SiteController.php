<?php

//error_reporting(0);
class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index', array('username' => $session["fullname"]));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = "simple";
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->getBaseUrl(true) . "/site/index");
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
//        session_destroy();
        $session = new CHttpSession;
        $session->close();
        $this->redirect(Yii::app()->getBaseUrl(true) . "/site/login");
    }
 

    ## forget password code : Nitin

    public function actionForgetPassword() {
        $model = new UserMaster;
        if (isset($_POST['email']) && $_POST['email'] != '') {
            $email = trim(urldecode($_POST['email']));
            $Criteria = new CDbCriteria();
            $Criteria->condition = "user_name = '$email'";
            $Criteria->select = 'u_id';
            $res = [];
            $res = $model->find($Criteria);

            if (!empty($res)) {
                $res = App::objtoarray($res);
                $returnval = $this->verificationMail($email, 'forget');
                if ($returnval)
                    echo 1;
            } else {
                echo '0';
            }
        } else {
            echo '-1';
        }
        exit;
    }

    public function verificationMail($email, $mode = '') {
        if ($email != '') {
            $subject = 'Forgot Password Notification';
            $key = 'forgetpassword_admin';
            $mall_id = 1;

            $from = "nitin.prajapati@credencys.com"; 
            $content = "test";
            $subject = "test"; 
            $returnval = App::sendmail($content, $subject, $email, $from, '');
            return $returnval;
        } else
            return false;
    }

}
