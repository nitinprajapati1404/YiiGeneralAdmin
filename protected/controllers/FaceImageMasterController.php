<?php
error_reporting(E_ALL);

class FaceImageMasterController extends Controller {
//use ImageUpload method for upload Image 
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
//        $user_id = Yii::app()->user->id;  
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'testCreate', 'createTest', 'createTest2', 'createTest3', 'imageUplaod','create', 'update','changeStatus','admin', 'delete'),
                'expression' => $this->checkUserAdmin('1,2,3') . "== 1",
            ), 
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
//         App::pr(Yii::app()->user->id,2);
//        App::pr($key,1);
//        App::pr($this->action->id,2);
        $dataProvider = new CActiveDataProvider('FaceImageMaster');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new FaceImageMaster('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FaceImageMaster']))
            $model->attributes = $_GET['FaceImageMaster'];

        $this->render('admin', array(
            'model' => $model,
        ));
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
        $model = new FaceImageMaster;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
//        App::pr($_POST);
//        App::pr($_FILES, 2);
        if (isset($_POST['FaceImageMaster'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $path = 'images/test/';

                $allfiles = App::ImageUpload($_FILES["image"], $path);

                foreach ($allfiles as $each => $file) {
                    $modelNew = new FaceImageMaster;
                    $modelNew->attributes = $_POST['FaceImageMaster'];
                    $modelNew->image = $file;
                    if ($modelNew->save()) {
                        
                    } else {
                        App::pr($modelNew->getErrors());
                    }
                }
                ## follow steps as per requirement in your model
                $transaction->commit();
            } catch (Exception $e) {
                echo 'data not saved';
                $transaction->rollback();
            } 
            $this->redirect(array('admin'));
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
//        App::pr($_POST);
//        App::pr($_FILES, 1);  
        $model = $this->loadModel($id);
        if (isset($_POST['FaceImageMaster'])) {
            $model->attributes = $_POST['FaceImageMaster'];
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $path = 'images/test/';
                if (isset($_FILES["image"])) {
                    $allfiles = App::ImageUpload($_FILES["image"], $path);
                    $alfilesName = implode(',', $allfiles);
                    $model->image = $alfilesName;
                    if ($model->save()){  
                    }else {
                        App::pr($modelNew->getErrors());
                    }
                } 
                ## follow steps as per requirement in your model
                $transaction->commit();
            } catch (Exception $e) {
                echo 'data not saved';
                $transaction->rollback();
            }
            $this->redirect(array('admin'));
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionTestCreate() {
        $model = new FaceImageMaster;
        $valid_formats = array("jpg", "png", "gif", "zip", "bmp");
        $max_file_size = 1024 * 100; //100 kb
        $path = "uploads/"; // Upload directory
        $count = 0;
//        App::pr($_POST);
//        App::pr($_FILES,2);
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            // Loop $_FILES to exeicute all files
            foreach ($_FILES['files']['name'] as $f => $name) {
                if ($_FILES['files']['error'][$f] == 4) {
                    continue; // Skip file if any error found
                }
                if ($_FILES['files']['error'][$f] == 0) {
                    if ($_FILES['files']['size'][$f] > $max_file_size) {
                        $message[] = "$name is too large!.";
                        continue; // Skip large files
                    } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {
                        $message[] = "$name is not a valid format";
                        continue; // Skip invalid file formats
                    } else { // No error found! Move uploaded files 
                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path . $name))
                            $count++; // Number of successfully uploaded file
                    }
                }
            }
        }
        $this->render('testform', array(
            'model' => $model,
        ));
    }

    ##to uplaod the images then returns name  of all images in array

    public function actionCreateTest() {
//        echo Yii::app()->basePath;
//                echo '<br>';
//        echo Yii::app()->getBaseUrl();die;
        $model = new FaceImageMaster;
        if (isset($_FILES) && !empty($_FILES) && isset($_POST['FaceImageMaster'])) {
            $model->attributes = $_POST['FaceImageMaster'];
            $errors = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {
//                App::pr($_FILES);
                $path = 'images/test/';
                $allfiles = App::ImageUpload($_FILES["files"], $path);
                App::pr($allfiles, 2);
                foreach ($allfiles as $each => $file) {
                    $model->image = $file;
                    if ($model->save()) {
                        echo 'saved';
                    }
                }
                ## follow steps as per requirement in your model
                $transaction->commit();
            } catch (Exception $e) {
                echo 'data not saved';
                $transaction->rollback();
            }
        }
        $this->render('testform1', array(
            'model' => $model,
        ));
    }

    # using only PHP
    ## need to understand how to get all names of images whuch are uploaded
    ## and preview the images 

    public function actionCreateTest2() {
//        echo Yii::app()->basePath;
//                echo '<br>';
//        echo Yii::app()->getBaseUrl();die;
        $model = new FaceImageMaster;
        if (isset($_FILES) && !empty($_FILES) && isset($_POST['FaceImageMaster'])) {
            $model->attributes = $_POST['FaceImageMaster'];
            $errors = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $path = 'images/test/';
                $allfiles = App::ImageUpload($_FILES["images"], $path);
                App::pr($allfiles, 2);
                ## follow steps as per requirement in your model
                $transaction->commit();
            } catch (Exception $e) {
                echo 'data not saved';
                $transaction->rollback();
            }
        }
        $this->render('testform2', array(
            'model' => $model,
        ));
    }

    ## prov

    public function actionCreateTest3() {
//        echo Yii::app()->basePath;
//                echo '<br>';
//        echo Yii::app()->getBaseUrl();die;
        $model = new FaceImageMaster;
        if (isset($_FILES) && !empty($_FILES) && isset($_POST['FaceImageMaster'])) {
            $model->attributes = $_POST['FaceImageMaster'];
            $errors = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $path = 'images/test/';
                $allfiles = App::ImageUpload($_FILES["images"], $path);
                App::pr($allfiles, 2);
                ## follow steps as per requirement in your model
                $transaction->commit();
            } catch (Exception $e) {
                echo 'data not saved';
                $transaction->rollback();
            }
        }
        $this->render('testform3', array(
            'model' => $model,
        ));
    }

    # using Jquery and  PHP 
    ## action for only upload images to server not save the images called form testform2

    public function actionImageUplaod() {
        if (isset($_FILES) && !empty($_FILES)) {
            $errors = array();
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $path = 'images/test/';
                $allfiles = App::ImageUpload($_FILES["images"], $path);
                //Generate images view
                if (!empty($allfiles)) {
                    $path = App::getImageUrl("images/test/");
                    $count = 0;
                    foreach ($allfiles as $image_src) {
                        $image_src = $path . $image_src;
                        App::pr($image_src);
                        $count++
                        ?>
                        <ul class="reorder_ul reorder-photos-list">
                            <li id="image_li_<?php echo $count; ?>" class="ui-sortable-handle">
                                <a href="javascript:void(0);" style="float:none;" class="image_link"><img src="<?php echo $image_src; ?>" alt=""></a>
                            </li>
                        </ul>
                        <?php
                    }
                }
                ## follow steps as per requirement in your model
                $transaction->commit();
            } catch (Exception $e) {
                echo 'data not saved';
                $transaction->rollback();
            }
        }
    }

    /**

     * 
     * @param type $files : array of files
     * @param type $path  : path of upload location
     * @param type $max_file_size ; max allowed file size to upload /
     */
    public function ImageUpload($files = '', $path = '', $max_file_size = '') {
        $allfiles = array();
        if (!empty($files) && !empty($path)) {
//            App::pr($files,2);
            $errors = array();
            $root = $files;
            foreach ($root['tmp_name'] as $key => $tmp_name) {
                $file_name = $root['name'][$key];
                $file_size = $root['size'][$key];
                $file_tmp = $root['tmp_name'][$key];
                $file_type = $root['type'][$key];
                if (!empty($max_file_size)) {
                    if ($file_size > $max_file_size) {
                        $errors[] = "File size must be less than $max_file_size MB";
                    }
                }
                if (empty($errors) == true) {
                    if (is_dir($path . $file_name) == false) {
                        $file_name = time() . '_' . $file_name;
                        $allfiles[] = $file_name;
                        $testname = $path . $file_name;
                        $b = move_uploaded_file($file_tmp, $testname);
                        echo $b;
                        echo '<br>';
                    }
                } else {
                    print_r($errors);
                }
            }
        }
        return $allfiles;
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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return FaceImageMaster the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = FaceImageMaster::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param FaceImageMaster $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'face-image-master-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
