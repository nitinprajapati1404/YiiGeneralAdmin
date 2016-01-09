<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$data = json_decode(Yii::app()->bitly->shorten('http://www.betaworks.com')->getResponseData(),true);

$shorturl = ($data["status_code"]== '200') ? $data["data"]["url"] : '';
//print_r($shorturl);
?>

<h1>Welcome <?php echo $username ;?> </h1>