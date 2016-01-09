<?php
error_reporting(E_ALL);
class WebserviceController extends Webservice {
 
    public function actionImportSqlFile() {
        $config = Yii::app()->getComponents(false);
//         App::pr($config,2);
        if (is_object($config['db'])) {
            $config['db'] = App::objtoarray($config['db']);
        }
//        App::pr($config['db']);
//        die;
        $is_multiple_db = array_key_exists('0', $config['db']);
        if ($is_multiple_db) { 
            foreach ($config['db'] as $d => $db) { 
                $imported = $this->importSqlFile($db);
            }
        } else { 
            $imported = $this->importSqlFile($config['db']);
        }
    }

    public function importSqlFile($db = '') {
        if (!empty($db)) {
            if (isset($db['connectionString'])) {
                $connectionString = $db['connectionString'];
                $username = $db['username'];
                $password = $db['password'];
                $info = explode(':', $connectionString);

                $dbInfo = explode(';', $info[1]);
                $hostnameInfo = explode("=", $dbInfo[0]);
                $dbnameInfo = explode("=", $dbInfo[1]);
                $hostname = $hostnameInfo[1];
                $dbname = $dbnameInfo[1];
// db connect
                $pdo = new PDO($connectionString, $username, $password);

// file header stuff
                $output = "-- PHP MySQL Dump\n--\n";
                $output .= "-- Host: $hostname\n";
                $output .= "-- Generated: " . date("r", time()) . "\n";
                $output .= "-- PHP Version: " . phpversion() . "\n\n";
                $output .= "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n\n";
                $output .= "--\n-- Database: `$dbname`\n--\n";
// get all table names in db and stuff them into an array
                $tables = array();
                $stmt = $pdo->query("SHOW TABLES");
//        App::pr($stmt,2);
                while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                    $tables[] = $row[0];
                }

// process each table in the db
                foreach ($tables as $table) {
                    $fields = "";
                    $sep2 = "";
                    $output .= "\n-- " . str_repeat("-", 60) . "\n\n";
                    $output .= "--\n-- Table structure for table `$table`\n--\n\n";
                    // get table create info
                    $stmt = $pdo->query("SHOW CREATE TABLE $table");
                    $row = $stmt->fetch(PDO::FETCH_NUM);
                    $output.= $row[1] . ";\n\n";
                    // get table data
                    $output .= "--\n-- Dumping data for table `$table`\n--\n\n";

                    $stmt = $pdo->query("SELECT * FROM $table");
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        // runs once per table - create the INSERT INTO clause
                        if ($fields == "") {
                            $fields = "INSERT INTO `$table` (";
                            $sep = "";
                            // grab each field name
                            foreach ($row as $col => $val) {
                                $fields .= $sep . "`$col`";
                                $sep = ", ";
                            }
                            $fields .= ") VALUES";
                            $output .= $fields . "\n";
                        }
                        // grab table data
                        $sep = "";
                        $output .= $sep2 . "(";
                        foreach ($row as $col => $val) {
                            // add slashes to field content
                            $val = addslashes($val);
                            // replace stuff that needs replacing
                            $search = array("\'", "\n", "\r");
                            $replace = array("''", "\\n", "\\r");
                            $val = str_replace($search, $replace, $val);
                            $output .= $sep . "'$val'";
                            $sep = ", ";
                        }

                        // terminate row data
                        $output .= ")";
                        $sep2 = ",\n";
                    }
                    // terminate insert data
                    $output .= ";\n";
                }
//        App::pr($output,1);
                $time = date('Y-m-d');
                $file_name = $dbname . "_" . $time . ".txt";

                $path = App::param('upload_path_local') . 'import_sql/' . $file_name;
                $f = fopen($path, "wb");
                fwrite($f, $output);
                fclose($f);
//        chmod($path, 0777); 

                $from = "mitesh.shah@credencys.com";
                $subject = "Test Database Dump - " . date('Y-m-d');
                $content = "Please Find Attachment of Test Database DB Dump";
//        $to = "nitin.prajapati@credencys.com"; 
                $to = "nitin.prajapati@credencys.com";
                $file_to_attach = $path;

                $sendMail = App::sendmail($content, $subject, $to, $from, '', $file_to_attach);
                if ($sendMail) {
                    unlink($file_to_attach);
                }
            }
            return true;
        }
        return false;
    }

}

?>
