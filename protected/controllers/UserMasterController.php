<?php

class UserMasterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        $session = new CHttpSession;
        $session->open();
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'changePassword'),
//				'users'=>array($session["uname"]),
                'expression' => $this->checkUserAdmin('1,2,3') . "== 1",
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new UserMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserMaster'])) {
            $model->attributes = $_POST['UserMaster'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->u_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserMaster'])) {
            $model->attributes = $_POST['UserMaster'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->u_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('UserMaster');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new UserMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UserMaster']))
            $model->attributes = $_GET['UserMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UserMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = UserMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UserMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    ## change password function 

    public function actionChangePassword() {
//        $this->heading = "Change Password";
        $model = new UserMaster();

        if (isset($_POST['UserMaster'])) {
            $currPwd = $_POST['UserMaster']['CurrentPassword'];
            $encodedPswd = base64_encode($currPwd);
            $uId = App::getSession('uid');
            $criteria = new CDbCriteria;
            $criteria->addCondition("u_id = $uId AND user_pass = '$encodedPswd'");

            $countUser = $model->findAll($criteria);

            if (!empty($countUser)) {
                $model1 = new UserMaster;
                $countUser[0]->user_pass = base64_encode($_POST['UserMaster']['NewPassword']);
//                $model1->modified_on=date('Y-m-d h:i');
                $countUser[0]->update();
                App::setSession('upassword', md5($countUser[0]->user_pass));
                Yii::app()->user->setFlash('success', 'Password has been updated successfully..');
                $this->redirect(App::param("siteurl") . "site/index");
            } else {
                Yii::app()->user->setFlash('error', 'Current Password is incorrect..');
                $this->redirect(App::param("siteurl") . "userMaster/ChangePassword/");
            }
        }

        $this->render('changepassword', array(
            'model' => $model,
        ));
    }

}
