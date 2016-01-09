<?php
$this->breadcrumbs=array(
	'Face Image Masters'=>array('admin'),
	$model->fim_id,
);
//App::pr($model,2);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <h4 class="panel-title">Test Image Detail</h4>
            </div>
            <div class="col-md-6">
                <div class="panel-btns pull-right">
                    <!--<a href="" class="minimize">&minus;</a>-->
                </div>
                <div class="mr5 pull-right">
                        <button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button">
                          Action <span class="caret"></span>
                        </button>
                        <ul role="menu" class="dropdown-menu">  
                          <li>
                                <a href="<?php echo App::param('siteurl').$this->id;?>/create">Add Image</a> 
                          </li> 
                          <li>
                                <a href="<?php echo App::param('siteurl').$this->id;?>/Update/<?php echo $model->fim_id; ?>">Edit Image</a>
                          </li>
                        

                        </ul>
                 </div>
            </div>
    </div>
 </div>
    <div class="panel-body">
        <?php 
            $paramArr = [];
            $paramArr[]=array('column'=>'user_name','name'=>'user_name','value'=>$model->FaceMaster->user_name);
            $paramArr[]=array('column'=>'tracer_id','name'=>'tracer_id','value'=>$model->tracer_id); 
            $paramArr[]=array('column'=>'image','name'=>'Image','value'=>$model->image);
            $this->renderPartial('../site/customDetailView',array('model'=>$model,'paramArr'=>$paramArr));
         ?>
    </div> 
</div> 

 
