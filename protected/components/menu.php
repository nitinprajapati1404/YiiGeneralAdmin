<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author lenovo
 */
$cContro = Yii::app()->controller->id;

class menu {

    //for echo '<pre>';print_r.
    ## If wants to check different action than view than, pass action array parameter in main array:mitesh
    public static function getMenu() {
        $menuArr = array(
            array(
                'label' => 'Test Management',
                'maincontroller' => array('faceImageMasterController'),
                'class' => 'fa fa-user',
                'url' => '#',
                'submenu' => array(
                    array(
                        'label' => 'Manage Test Group',
                        'url' => App::param('siteurl') . 'faceImageMaster/admin',
                        'controller' => 'faceImageMasterController',
                    ),
                    array(
                        'label' => 'Create Test Group',
                        'url' => App::param('siteurl') . 'faceImageMaster/create',
                        'controller' => 'faceImageMasterController',
                    )  
                )
            ),
            array(
                'label' => 'Contact Us Management',
                'maincontroller' => array('contactUsController'),
                'class' => 'fa fa-user',
                'url' => '#',
                'submenu' => array(
                    array(
                        'label' => 'Manage Contact Us',
                        'url' => App::param('siteurl') . 'contactUs/admin',
                        'controller' => 'contactUsController',
                    ) 
                )
            ),
            array(
                'label' => 'CMS Management',
                'maincontroller' => array('cmsManagementController'),
                'class' => 'fa fa-user',
                'url' => '#',
                'submenu' => array(
                    array(
                        'label' => 'Manage CMS',
                        'url' => App::param('siteurl') . 'cmsManagement/admin',
                        'controller' => 'cmsManagementController',
                    ),
                    array(
                        'label' => 'Create CMS',
                        'url' => App::param('siteurl') . 'cmsManagement/create',
                        'controller' => 'cmsManagementController',
                    )  
                )
            ),
        );

        return $menuArr;
    }

}
