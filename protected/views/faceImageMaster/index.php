<?php
/* @var $this FaceImageMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Face Image Masters',
);

$this->menu=array(
	array('label'=>'Create FaceImageMaster', 'url'=>array('create')),
	array('label'=>'Manage FaceImageMaster', 'url'=>array('admin')),
);
?>

<h1>Face Image Masters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
