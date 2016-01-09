 
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
/*$this->breadcrumbs=array(
	'Login',
);*/
// if(isset(Yii::app()->request->cookies['phoenix_admin_username'])){
//     $model->username = Yii::app()->request->cookies['phoenix_admin_username']->value;
//     $model->password = base64_decode(Yii::app()->request->cookies['phoenix_admin_password']->value);
// }else{
//     $model->username = "";
//     $model->password = "";
// }
//$cookieUserName = (isset(Yii::app()->request->cookies['username'])) ? Yii::app()->request->cookies['username']->value : '';
//$cookiePassword = (isset(Yii::app()->request->cookies['password'])) ? Yii::app()->request->cookies['password']->value : '';
?>

 <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                      <img src="<?=App::param('siteurl');?>/images/logo3.png">
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                   <h5><strong>Welcome to Test.</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i>Manage Application</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i>Manage the All about Application</li>
                        
                    </ul>
                    <div class="mb20"></div>
                    
                </div><!-- signin0-info -->
            
            </div>
            
            <div class="col-md-5 loginform">
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'frmLoginform',
                        'action'=>Yii::app()->createUrl('/site/login'),
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                        ),

                )); ?>

                <!--<form method="post" id="frmLoginform">-->
                    <h4 class="nomargin ">Admin Login</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                   
                <?php echo $form->error($model, 'password',array("class" => "errorMsg")); ?>
                    <?php echo $form->textField($model,'username', array("class" => "form-control uname validate[required,custom[email]]","placeholder"=>"Username","maxlength"=>150)); ?>
                    <?php echo $form->passwordField($model,'password', array("class" => "validate[required,minSize[5]] form-control pword","placeholder"=>"Password","maxlength"=>150)); ?>
                    <div class="ckbox ckbox-primary mt10">
                        <input type="checkbox" name="remember" id="remember">
                        <label class="marginleft5" for="remember">Remember Me</label>
                    </div>
                    <a  id="btnForgetPwd" href="#" data-toggle="modal" data-target="#divForgetPwd"><small>Forgot Your Password?</small></a>
                    
                    <?php //echo CHtml::submitButton('Sign In',array('class'=>'btn btn-success btn-block')); ?>
                    
                    <input class="btn btn-primary btn-block" type="button" value="Sign In" id="btnSubmitlogin" name="btnSubmitlogin">
                    
 <?php $this->endWidget(); ?>
            </div><!-- col-sm-5 -->


	<div id="divForgetPwd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content panel panel-dark panel-alt ">
             <div class="modal-header panel-heading">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
               <h4 class="modal-title" id="myModalLabel" style="color:#fff;text-align:center;">Forgot Password</h4>
             </div>
             <div class="modal-body">
               <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'frmForgetPwdform',
                    //'action'=>Yii::app()->createUrl('/site/ForgetPassword'),
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                    ),

                )); ?>
                <div id="divConsumerError" class="fontRed center errorMsg"></div>
               <input type="text" id="txtUsername" name="txtUsername" placeholder="Please Enter Your Email Address" class="form-control uname validate[required,custom[email]]">
               <?php $this->endWidget(); ?>
                 <span id="spnLoadingImg" style="display:none;"><img src="<?=App::param('siteurl');?>images/loading.gif" style="display: block;margin-left: auto;margin-right: auto;"/></span>
             </div>
             <div class="modal-footer">
             
               <button type="button" id="btnForgetpwdSubmit" class="btn btn-primary  btn-sm">Submit</button>
                 <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
             
             </div>
           </div>
         </div>
       </div>


<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/btvalidationEngine.js", CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/btvalidationEngine-en.js", CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(App::param('siteurl') . "js/login.js", CClientScript::POS_END); ?>
<link rel="stylesheet" type="text/css" href="<?=App::param('siteurl');?>css/validationEngine.css"/>
  <?php  
    /*Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(e){
$('#frmLoginform').validationEngine();
$('#btnSubmitlogin').click(function(e){
        e.preventDefault();
        if($('#frmLoginform').validationEngine('validate'))
        {
             $('form#frmLoginform').submit();
        }
     }); 
     $('#btnForgetPwd').click(function(e){
        $('#frmForgetPwdform').validationEngine();
    });
 });
", CClientScript::POS_END);*/
?>

