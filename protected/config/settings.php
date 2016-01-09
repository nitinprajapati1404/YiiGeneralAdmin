<?php

/**
 * @settingsOfdb has database settinds
 * $settingsOfAWSSES has setting parameters of AWS SES
 * 
 */
//$settingsOfdb1 =  array(
//            'connectionString' => 'mysql:host=localhost;dbname=newfaceid',
//            'emulatePrepare' => true,
//            'username' => 'root',
//            'password' => '',
//            'charset' => 'utf8',
//            'class' => 'CDbConnection'
//        );

$settingsOfdb1 = array(
    array('connectionString' => 'mysql:host=192.168.1.10;dbname=db_general_admin',
        'emulatePrepare' => true,
        'username' => 'remote',
        'password' => 'remote',
        'charset' => 'utf8',
        'class' => 'CDbConnection'),
    array('connectionString' => 'mysql:host=192.168.1.10;dbname=db_general_admin',
        'emulatePrepare' => true,
        'username' => 'remote',
        'password' => 'remote',
        'charset' => 'utf8',
        'class' => 'CDbConnection'));

$settingsOfdb = array(
    'connectionString' => 'mysql:host=192.168.1.10;dbname=devcred_phoenix',
    'emulatePrepare' => true,
    'username' => 'remote',
    'password' => 'remote',
    'charset' => 'utf8',
    'class' => 'CDbConnection'
);
$settingsOfLocaldb = array(
    'connectionString' => 'mysql:host=localhost;dbname=devcred_phoenix',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'class' => 'CDbConnection'
);

$settingsOfAWSSES = array(
    // this is used in contact page
    'SESKey' => 'aws_key',
    'SESSecret' => 'aws_secre',
    'SESRegion' => 'us-east-1',
    'SESNoreplyEmail' => 'test@test.com',
);

$testCaseComponent = array(
    'fixture' => array(
        'class' => 'system.test.CDbFixtureManager',
    ),
    /* uncomment the following to provide test database connection
     * */
    'connectionString' => 'mysql:host=192.168.1.10;dbname=devcred_phoenix_test',
    'emulatePrepare' => true,
    'username' => 'remote',
    'password' => 'remote',
    'charset' => 'utf8',
    'class' => 'CDbConnection'
);
