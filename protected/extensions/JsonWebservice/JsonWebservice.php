<?php
/**
 * @desc : Yii Web Service Extentions 
 * @author: aNKIT kHAMBHATA
 * @version: 1.0
 */
class JsonWebservice extends CApplicationComponent {

    /**
     * @desc : Filter Data to prevent sql injunction
     * @param type $variable : value 
     * @return type
     */
    public function filterData($variable) {
        $variable = strip_tags(trim($variable));
        return $variable;
    }

    /**
     * @desc : This is add webservice 
     * @param type $post : post array
     * @param type $nfield : neglect file from post array
     * @param type $uniqueField : unique file on which you want
     * to perform unique operation
     * @return type
     */
    public function addData($table, $post, $nfield, $uniqueField, $lastIdStatus = 1,$fieldEncode = array(),$dataobj = 'db') {

        $neglectField = array();
        $uniqueQuery = '';
        if ($uniqueField != '' && $post[$uniqueField] != '') {
            $uniqueFieldValue = $post[$uniqueField];
            $uniqueQuery = "SELECT * FROM $table where $uniqueField LIKE '%$uniqueFieldValue%'";
        }
        if ($nfield != '') {
            $neglectField = explode(",", $nfield);
        }
        $dataArray = $this->generateArrayForQuery($post,$neglectField,'add',$fieldEncode) ;
        $f = $dataArray["f"];
        $d = $dataArray["d"];
        $status = 0;    
        
        if ($uniqueQuery != '') {
            $num = $this->getCount($uniqueQuery, $dataobj);
            if ($num > 0) {
                $status = "-2";
            } else {
                $sql = "insert into " . $table . "(" . implode(',', $f) . ") values (" . implode(',', $d) . ")";
            }
        } else {
            $sql = "insert into " . $table . "(" . implode(',', $f) . ") values (" . implode(',', $d) . ")";
        }

        if ($status == 0) {
            if ($lastIdStatus == 0) {
                $lastId = $this->executeQuery($sql, $dataobj, 0);
                if ($lastId > 0) {
                    $response = array("status" => '1', "lastid" => $lastId);
                } else {
                    $response = array("status" => '-1');
                }
            } else {
                if ($this->executeQuery($sql,$dataobj)) {
                    $response = array("status" => '1');
                } else {
                    $response = array("status" => '-1');
                }
            }
        } else {
            $response = array("status" => "$status");
        }
        return $response;
    }
    /**
     * @desc : Used to Update Data 
     * @param type $post : post data array
     * @param type $nfield : neglect filed array
     * @param type $uniqueField : Database unique filed name
     * @param type $where : mysql where condition after where clause
     * @return string
     */
    public function updateData($table, $post, $nfield, $uniqueField, $where, $fieldEncode = array(),$dataobj = 'db') {
        $neglectField = array();
        $uniqueQuery = '';
        $uniqueFieldValue = '';
        $uniqueFieldOldValue = '';
        if ($uniqueField != '') {
            @array_push($neglectField, $uniqueField . "_old");
            $uniqueFieldValue = $post[$uniqueField];
            $uniqueFieldOldValue = $post[$uniqueField . "_old"];
            $uniqueQuery = "SELECT * FROM $table where $uniqueField LIKE '%$uniqueFieldValue%'";
        }
        if ($nfield != '') {
            $neglectField = explode(",", $nfield);
        }
        $dataArray = $this->generateArrayForQuery($post,$neglectField,'update',$fieldEncode) ;
        $f = $dataArray["f"];
        $status = 0;
        if ($uniqueField != '') {
            if ($uniqueFieldValue == $uniqueFieldOldValue) {
                $status = 0;
            } else {
                $num = $this->getCount($uniqueQuery, $dataobj);
                if ($num > 0) {
                    $status = "-2";
                }
            }
        } else {
            $status = 0;
        }
        if ($status == 0) {
            $sql = "UPDATE $table SET " . implode(",", $f) . " WHERE $where";
            if ($this->executeQuery($sql, $dataobj)) {
                $response = array("status" => '1');
            } else {
                $response = array("status" => '-1');
            }
        } else {
            $response = array("status" => '-2');
        }
        return $response;
    }
    /**
     *@desc : This function is generate data and field array 
     * for insert and updat operation of database
     * @param type $post : data array
     * @param type $neglectField : neglectefield
     * @param type $type : 
     * @return type 
     */
    protected function generateArrayForQuery($post,$neglectField,$type='add',$fieldEncode = array()) {
        $f = array();
        $d = array();
        $response = array();
        
        foreach ($post as $key => $val) {
            if (!in_array($key,$neglectField)) {
                if(@array_key_exists("fields", $fieldEncode)) {
                    if (in_array($key, $fieldEncode["fields"])) {
                        $fieldEncodeFunctions = $fieldEncode["encodefunction"][$key];
                        $values = "'" . $fieldEncodeFunctions($val) . "'";
                        $cv = $fieldEncodeFunctions($val);
                    } else {
                        $values = "'" . ($val) . "'";
                        $cv = ($val);
                    }
                } else {
                    $values = "'" . ($val) . "'";
                    $cv = ($val);
                }
                if ($type == 'update') {
                    $f[] = $key . "=" . $this->filterData($values);
                } else if ($type == 'add') {
                    $f[] = $key;
                    $d[] = $this->filterData($values);
                    $vc[] = $cv;
                }
            }
        }
        if ($type == 'add') {
            $response["f"] = $f;
            $response["d"] = $d;
            $response["combine"] = array_combine($f, $vc);
        } else if ($type == 'update') {
            $response["f"] = $f;
        }
        return $response;
    }
    /**
     * @desc : Purpose to Validate User while login
     * @param type $table : name of table 
     * @param type $where : where condition
     * @return string : repose array 
     */
    public function userValidate($table, $where ,$dataobj = 'obj') {
        $connection = Yii::app()->$dataobj;
        $sql = "SELECT * FROM 
                    $table 
                WHERE 
                    1=1 AND  $where";
        $num = $this->getCount($sql,$dataobj);
        $uid = '';
        if ($num > 0) {
            $response = array("status" => "1");
        } else {
            $response = array("status" => "-1");
        }
        return $response;
    }

    /**
     * @desc : Function is used to fetch The data 
     * from the database table
     * @param type $post : post array
     * @return string
     */
    public function fetchData($post, $dataobj = 'db') {
        $table = $post["table"];
        $fields = $post["fields"];
        $beforeWhere = $post["beforeWhere"];
        $afterWhere = ($post["afterWhere"] == '') ? " 1=1 " : $post["afterWhere"];
        $recordPerPage = $post["r_p_p"];
        $start = ($post["start"] == '') ? 0 : $post["start"];
        $nextStart = ($post["start"] != '' && $post["start"] != 'all') ? ($start + $recordPerPage) : '';
        $limit = '';
        if ($start == 'all') {
            $limit = '';
        } else {
            $limit = " LIMIT $start , $recordPerPage ";
        }
        $connection = Yii::app()->$dataobj;
        $sqlTotal = "select $fields from $table  $beforeWhere where $afterWhere ";
        $totalRecords = $this->getTotalRecords($sqlTotal, $dataobj);
        $sql = "$sqlTotal $limit";
        if ($this->getCount($sql, $dataobj) > 0) {
            $list = $connection->createCommand($sql)->queryAll();
            $response = array("status" => "1",
                "data" => $list,
                "nextStart" => "$nextStart",
                "totalRecord" => "$totalRecords",
                "queryString" => "$sql"
            );
        } else {
            $response = array("status" => "-3", "queryString" => "$sql");
        }
        return $response;
    }

    /**
     * @desc : Count total number of recoreds 
     * @param type $sql : mysql query statement
     * @param type $dataobj : data object 
     */
    public function getTotalRecords($sql, $dataobj = 'db') {
        return $this->getCount($sql, $dataobj);
    }

    /**
     * @desc : get total number of the row from fetch records
     * @param type $sql : mysql query statement
     * @return type
     */
    protected function getCount($sql, $dataobj = 'db') {
        try {
            $connection = Yii::app()->$dataobj;
            $command = $connection->createCommand($sql);
            $dataReader = $command->query();
            $rowCount = $dataReader->rowCount;
            return $rowCount;
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * @desc : Count the distance between two lat logn 
     * @param type $lat1 : latitude of from
     * @param type $lon1 : longitude of Form
     * @param type $lat2 : latitude of To
     * @param type $lon2 : longitude of To
     * @param type $unit : K = kilometer , N = miles 
     * @return type : float
     */
    public function getDistanceFromLatLng($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    /**
     * @desc : User to execute mysql query statement
     * @param type $sql : mysql query statement
     * @param type $dataobj: data object in case of more than tow
     * @param type $status : if 0 : last insert ID 1 : return true/fase
     * @return boolean
     */
    public function executeQuery($sql, $dataobj = 'db', $status = 1) {
        try {
            $connection = Yii::app()->$dataobj;
            $command = $connection->createCommand($sql);
            $dataReader = $command->query();
            /**
             * @desc : with Following Syntaxt we get last insert id 
             */
            if ($status == 0) {
                $lastInsertID = Yii::app()->$dataobj->getLastInsertID();
            }

            if ($dataReader) {
                if ($status == 0) {
                    return $lastInsertID;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * @desc : Get single Row data 
     * @param type $sql : mysql query statement
     * @param type $dataobj : data object , in case of more than two database
     * @return boolean 
     */
    public function getRowData($sql, $dataobj = 'db') {
        try {
            $connection = Yii::app()->$dataobj;
            $command = $connection->createCommand($sql);
            $dataReader = $command->queryRow();

            /**
             * @desc : with Following Syntaxt we get last insert id 
             */
            Yii::app()->db->getLastInsertID();
            if ($dataReader) {
                return $dataReader;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public static function p($d) {
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
    /**
     * @desc : Send Json Response
     * @param type $response @de
     */
    public function response($response){
        $data = array("response" => $response);
        return json_encode($data);
        
    }
    /**
     *
     * @param type $deviceToken : Phone Device Token
     * @param string $message : message to be send 
     * @param type $certificate : IOS certificate 
     * @return boolean 
     */
    public function sendPushNotificationToIos($deviceToken, $message = '', $certificate) {
        if ($deviceToken != '0') {
            $ctx = stream_context_create();
            $passphrase = '12345';
            stream_context_set_option($ctx, 'ssl', 'local_cert', Yii::app()->basePath . DIRECTORY_SEPARATOR . $certificate);
            stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
            $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
            $body['aps'] = array(
                'badge' => +1,
                'alert' => $message,
                'sound' => 'default'
            );
            $payload = json_encode($body);
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
            $result = fwrite($fp, $msg, strlen($msg));
            $flag = 0;
            if (!$result) {
                $flag = 1;
            }
            fclose($fp);
            if ($flag == 0) {
                return true;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * @desc
     * @param type $registatoin_ids : array of register ids
     * @return boolean 
     */
    public function sendPushNotificationToAndroid($registatoin_ids, $message) {
        $url = 'https://android.googleapis.com/gcm/send';
        $messages = array("data" => $message);

        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $messages,
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        $res = json_decode($result, true);
        if ($res["success"] == '1') {
            return true;
        } else {
            return false;
        }
    }

}
