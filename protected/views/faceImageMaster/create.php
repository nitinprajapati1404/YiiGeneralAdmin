<?php
/* @var $this FaceImageMasterController */
/* @var $model FaceImageMaster */

$this->breadcrumbs=array(
	'Face Image Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FaceImageMaster', 'url'=>array('index')),
	array('label'=>'Manage FaceImageMaster', 'url'=>array('admin')),
);
?>

<h1>Create</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>