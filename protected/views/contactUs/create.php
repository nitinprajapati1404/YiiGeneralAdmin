<?php
/* @var $this ContactUsController */
/* @var $model ContactUs */

$this->breadcrumbs=array(
	'Contact Uses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContactUs', 'url'=>array('index')),
	array('label'=>'Manage ContactUs', 'url'=>array('admin')),
);
?>

<!--<h1>Create ContactUs</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>