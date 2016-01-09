<?php
/* @var $this CmsManagementController */
/* @var $model CmsManagement */

$this->breadcrumbs=array(
	'Cms Managements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CmsManagement', 'url'=>array('index')),
	array('label'=>'Manage CmsManagement', 'url'=>array('admin')),
);
?>

<!--<h1>Create CmsManagement</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>