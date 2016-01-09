<?php
/* @var $this ContactUsController */
/* @var $model ContactUs */
$this->breadcrumbs=array(
	'Cms Managements'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CmsManagement', 'url'=>array('index')),
	array('label'=>'Create CmsManagement', 'url'=>array('create')),
);
?>

<div class="flash-success" id="msg" style="margin-top: 30px; display: none;"></div>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h4 class="panel-title">Manage Cms Managements</h4>
            </div>
            <div class="col-md-6">

                <div class="panel-btns">
                    <!--<a class="btn btn-primary btn-xs" href="<?php echo App::param('siteurl') . $this->id; ?>/Create">Add Magazine</a>-->
                </div>

            </div>
        </div>
    </div>
    <div class="panel-body">
        <input type="hidden" id="statusId" name="statusId" />
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'cms-management-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'template' => "{items}\n{summary}{pager}",
            'summaryText' => "Showing  {start} - {end} of {count} entries",
            'pager' => array('header' => ''),
            'itemsCssClass' => 'table dataTable no-footer vertical-middle',
            'afterAjaxUpdate' => 'js:function(){loadSwitch()}',
            'columns' => array(
                array(
                    'header' => '#',
                    'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                ),
                //		'fim_id',
//		'fm_id',
//                array(
//                    'header'=>'User Name',
//                    'name'=>'UseName',
//                     'type'=>'raw',
//                    'value'=>'$data->FaceMaster->user_name',
//                ),
//                'cms_id',
		'cms_page_alias',
		'cms_page_title',
		'cms_page_content', 
                array(
                    'header' => 'Status',
                    'type' => 'raw',
                    'value' => function($data) {
                $html = '<div class="toggle-inner" style="width: 80px; margin-left: 0px;">';
                $html.= '<div class="switch switch-square" data-on-label="Active" data-off-label="Inactive">';
                $html.= CHtml::checkBox('is_active', $data->is_active, array('class' => 'switchCls', 'cms_id' => $data->cms_id));
                $html.= '</div>';
                $html.= '</div>';
                return $html;
            },
                ),
                array(
                    'header' => 'Action',
                    'class' => 'CButtonColumn',
                    'template' => '{update}',
                    'buttons' => array(
                        'update' => array(
                            'options' => array('rel' => 'tooltip', 'data-toggle' => 'tooltip', 'class' => 'btn btn-xs btn-primary', 'title' => Yii::t('app', 'Edit')),
                            'label' => '<i class="fa fa-pencil"></i> Edit',
                            'imageUrl' => false,
                        ),
                    )
                ),
            ),
        ));
        ?>
    </div>   
</div>

<?php

//
//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$('#contact-us-grid').yiiGridView('update', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
?>
 <script type="text/javascript"> 
$(document).ready(function(){ 
     config.eventHandler('.switchCls','change',function(e){ 
            if(confirm('Do you really want to change status?')){
                $("#statusId").val($(this).attr('fim_id')); 
                 updateGrid();
            }
            else
            {
                    $.fn.yiiGridView.update('face-image-master-grid');
            }
	}); 
});
function updateGrid()
{  
    var statusId = $("#statusId").val();
    var data = {}; 
    data['model_name'] = "<?php echo $this->id;?>";
    $.fn.yiiGridView.update('face-image-master-grid', {
            type:'POST',
            data: data,
            url:siteurl+"<?php echo $this->id.'/ChangeStatus/';?>"+statusId,
            success:function(data) {
            }
    });
}
function  backTostatus()
{
    $.fn.yiiGridView.update('face-image-master-grid');
}
</script>
<style>
    .ac_heading{
        display: none;
    }
</style>


  