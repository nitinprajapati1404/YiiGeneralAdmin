<?php
/* @var $this FaceImageMasterController */
/* @var $model FaceImageMaster */

$this->breadcrumbs=array(
	'Face Image Masters'=>array('index'),
	$model->fim_id=>array('view','id'=>$model->fim_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FaceImageMaster', 'url'=>array('index')),
	array('label'=>'Create FaceImageMaster', 'url'=>array('create')),
	array('label'=>'View FaceImageMaster', 'url'=>array('view', 'id'=>$model->fim_id)),
	array('label'=>'Manage FaceImageMaster', 'url'=>array('admin')),
);
?>

<h1>Update<?php echo $model->fim_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>