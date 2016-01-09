<?php

error_reporting(E_ALL);
require_once 'settings.php';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Scrum Board Beta 1.0',
    'defaultController' => 'site/login',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.mailer.*'
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        //'ipFilters'=>array('127.0.0.1','64.64.20.42','202.131.112.18','dev.credencys.com'),
        ),
        'api'
    ),
    // application components
    'components' => array(
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'htmlOptions' => array(
                        'class' => 'pagination'
                    ),
                    'header' => false,
                    'maxButtonCount' => 5,
                    'cssFile' => false,
                ),
                'CGridView' => array(
                    'htmlOptions' => array(
                        'class' => 'table-responsive'
                    ),
                    'template' => "{items}\n{summary}{pager}",
                    'summaryText' => "Showing  {start} - {end} of {count} entries",
                    'pager' => array('header' => ''),
                    'itemsCssClass' => 'table dataTable no-footer vertical-middle',
//                    'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
//                    'itemsCssClass' => 'table table-striped table-hover',
//                    'cssFile' => false,
//                    'summaryCssClass' => 'dataTables_info',
//                    'summaryText' => 'Showing {start} to {end} of {count} entries',
//                    'template' => '{items}<div class="row"><div class="col-md-5 col-sm-12">{summary}</div><div class="col-md-7 col-sm-12">{pager}</div></div><br />',
                ),
//                'bootstrap.widgets.TbButtonColumn' => array(
//                    'template' => '{listen}{delete}',
//                    'buttons' => array(
//                        'listen' => 'xxxx.widgets.buttons.Listen',
//                    )
//                ),
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        //this is the json webservice extention use to create webservice and other database 
        // related opearation
        'JsonWebservice' => array(
            'class' => 'application.extensions.JsonWebservice.JsonWebservice',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                /**
                 * Start
                 * To access apis/v1/ 
                 */
//                'apis' => 'apis',
//                'apis/<controller:\w+>' => 'apis/<controller>',
//                'apis/<controller:\w+>/<action:\w+>' => 'apis/<controller>/<action>',
                'apis/v1' => 'apis/v1',
                'apis/v1/<controller:\w+>' => 'apis/v1/<controller>',
                'apis/v1/<controller:\w+>/<action:\w+>' => 'apis/v1/<controller>/<action>',
                /**
                 * End
                 * To access apis/v1/ 
                 */
                /**
                 * Start
                 * To access api module                 /
                 */
                'api' => 'api',
                'api/<controller:\w+>' => 'api/<controller>',
                'api/<controller:\w+>/<action:\w+>' => 'api/<controller>/<action>',
                /**
                 * End
                 * To access api module                 /
                 */
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'bitly' => array(
            'class' => 'application.extensions.bitly.VGBitly',
            'login' => 'o_jlh2l1ug0', // login name
            'apiKey' => 'R_37971bbfd2b246b8be31196d232d9f40', // apikey 
            'format' => 'json', // default format of the response this can be either xml, json (some callbacks support txt as well)
        ),
//        'db' =>$settingsOfdb1, 
        'db' => array(
            'connectionString' => 'mysql:host=192.168.1.10;dbname=db_general_admin',
            'emulatePrepare' => true,
            'username' => 'remote',
            'password' => 'remote',
            'charset' => 'utf8',
            'class' => 'CDbConnection'
        ),
        'phpThumb' => array(
            'class' => 'ext.EPhpThumb.EPhpThumb',
            'options' => array(),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
    /*
     * if log needed then uncomment the below lines
     */
//		'log'=>array(
//			'class'=>'CLogRouter',
//			'routes'=>array(
//				array(
//					'class'=>'CFileLogRoute',
//					'levels'=>'error, warning',
//				),
//				// uncomment the following to show log messages on web pages
//				
//				array(
//					'class'=>'CWebLogRoute',
//				),
//				
//			),
//		),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array_merge(
            array(
                // this is used in contact page
                'adminEmail' => 'webmaster@example.com',
                'siteurl' => 'http://' . $_SERVER['HTTP_HOST'] . '/generaladmin/',
                'lib' => 'http://' . $_SERVER['HTTP_HOST'] . '/generaladmin/lib/',
                'sitepath' => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'generaladmin' . DIRECTORY_SEPARATOR,
                'upload_path_local' => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'generaladmin' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR,
                'upload_url_local' => 'http://' . $_SERVER['HTTP_HOST'] . '/generaladmin/uploads/',
            )
//             array(
//                // this is used in contact page
//                'adminEmail' => 'webmaster@example.com',
//                'siteurl' => 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->baseUrl.'/',
//                'lib' => 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->baseUrl.'/lib/',
//                'sitepath' => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . Yii::app()->baseUrl,
//                'upload_path_local' => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .Yii::app()->baseUrl.'uploads' . DIRECTORY_SEPARATOR,
//                'upload_url_local' => 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->baseUrl.'/uploads/',
//            )
    ),
);
