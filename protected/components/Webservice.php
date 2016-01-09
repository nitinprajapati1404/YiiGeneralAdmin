<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
error_reporting(0);

class Webservice extends Controller {

    protected function beforeAction() {
        return $this->_authenticate();
    }

    public function getFirstMSG($msg = array()) {
        foreach ($msg as $m => $v) {
            return $v[0];
        }
    }

    ## function for unset some attributes for obj has multi data

    public function unsetvaluesmutidata($obj, $unset) {

        if (!empty($obj) && $obj !== "" && !empty($unset) && $unset !== "") {
            foreach ($obj as $id => $each) {
                foreach ($unset as $key => $value) {
                    unset($obj[$id][$value]);
                }
            }
            return $obj;
        } else {
            return $obj;
        }
    }

    ##function for unset some attributes for object has only one data 

    public function unsetvalues($obj, $unset) {
        if (!empty($obj) && $obj !== "" && !empty($unset) && $unset !== "") {
            foreach ($unset as $key => $value) {
                unset($obj[$value]);
            }
            return $obj;
        } else {
            return $obj;
        }
    }

    /*
     * function for display response 
     * $respons_code = code of response
     * $response : data in response
     * $flag if 1 then die and if 0 then not die and if no value puted then 1 is default
     */

    public function response($respons_code, $response, $flag = '1') {
        if (!empty($respons_code) && !empty($response)) {
//            http_response_code($respons_code);
            $httpStatusCode = $respons_code;
            $httpStatusMsg = $this->setMessage($httpStatusCode); ## get the message based on  status code
            $this->setHeader($httpStatusCode, $httpStatusMsg); ## set header response code and message
            echo $data = json_encode($response);
//            echo str_replace("\\", "", $data);
            if ($flag == 1) {
                die;
            }
        }
    }

    #Set message based on status code 

    public function setMessage($httpStatusCode = '') {
        $httpStatusMsg = 'Something Wrong.';
        if (!empty($httpStatusCode)) {
            $codes = Array(
                200 => 'OK',
                201 => 'Data Stored Successfully',
                204 => 'No Content',
                207 => 'Data Not Found', 
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
            );
            if(array_key_exists($httpStatusCode, $codes)){
                $httpStatusMsg = $codes[$httpStatusCode];
            }
        }
        return $httpStatusMsg; 
    }

    ## set value in header as per our respose code 

    public function setHeader($httpStatusCode = '', $httpStatusMsg = '') {
        if (!empty($httpStatusCode) && !empty($httpStatusMsg)) {
            $phpSapiName = substr(php_sapi_name(), 0, 3);
            if ($phpSapiName == 'cgi' || $phpSapiName == 'fpm') {
                header('Status: ' . $httpStatusCode . ' ' . $httpStatusMsg);
            } else {
                $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
                header($protocol . ' ' . $httpStatusCode . ' ' . $httpStatusMsg);
            }
        }
    }

    /*
     * Function to authenticate the api request 
     * No parameters return type boolean
     * Code By: Nitin Prajapati, Avani Manvar, Sanket Virani
     */

    public function _authenticate() { 
        $response = array();

        $headerParam = getallheaders();
        $token_id = urldecode($headerParam['Api-Key']);  ## pass api_key param client_id#access_token in this format

        $keys = array(
            1 => 'pass1',
            2 => 'pass2',
            3 => 'pass3',
        );
        if (in_array(base64_decode($token_id), $keys)) { 
            return true;
        } else {
            $response["status"] = '-10';
            $response["message"] = "Authentication Failed";
            $this->response(401, $response);
        }
    }

}
