<?php

error_reporting(E_ALL);

class TestApiController extends Webservice {

    /**
     * @desc : This action is define how to add data into database
     * using JsonWebserice Extentions . Following are the addData Arguments description.
     * @table : Name of Database Table in which you want to insert Database
     * @$post : Post Data array 
     * @$nfield : Neglect Field name from the data array . Muliple field comes with comma separated .
     * @$uniqueField : Name of database field on which you want ot perform unique operation 
     * @$lastIdStatus : If 1 = return true/flase 
     *                  If 0 = return lastinsert id of data / false
     * @$fieldEncode : Use to decode the particulart field from the data array 
     * @dataoj = yii data object.
     */
    public function actionTest() {

        $cms_id = 14;
        $connection = Yii::app()->db;
        $sql = '
                  SELECT * 
                    FROM
                        cms_management
                    WHERE
                        cms_id = :cms_id';

        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam(':cms_id', $cms_id);
        $allResult = $command->queryAll();
        $response["status"] = '1';
        $response["data"] = $allResult;
        $response["message"] = "data received from server";
        $this->response(200, $response);
    }

    public function actionTimeZone() {
        $time_zone = $this->getTimeZoneFromIpAddress();
        echo 'Your Time Zone is ' . $time_zone;


//        $clientsIpAddress = $this->get_client_ip();
//        echo '<pre>';
//        print_R($clientsIpAddress);
    } 
   

}

?>
