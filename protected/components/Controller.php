<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function checkUserAdmin($accessRole_id = '') {
        $session = new CHttpSession();
        $session->open();

        $user_id = $session['uid'];
//        App::pr($user_id,2);
        $user_rid = $session['rid'];
        if (!empty($user_id)) {
            if (!empty($accessRole_id)) {
//            App::pr($accessRole_id,2);
                $record = UserMaster::model()->find("u_id = $user_id AND ur_id IN($accessRole_id)");
//            App::pr($record,2);
                if (!empty($record)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $record = UserMaster::model()->findByPk($user_id);
                if (!empty($record)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return FALSE;
        }
    }

    /**
     *  change Status of the record of any Model
     */
    public function actionChangeStatus($id) {
        $mdl = $_POST['model_name'];
        $model = $mdl::model()->findByPk($id);
        $current_value = $model->is_active;
        if ($current_value == '1') {
            $comment = "inactivated";
            $value = '0';
        } else {
            $comment = "activated";
            $value = '1';
        }
        $model->is_active = $value;
        $result = $model->update();
        if ($result === true) {
            echo true;
        } else {
            echo false;
        }
    }

}
