
 <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'//js/jquery.form.js'; ?>"></script>
<form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="ImageUplaod">
    <input type="hidden" name="image_form_submit" value="1"/>
    <div class="row">
        <label for="FaceImageMaster_tracer_id">Tracer ID</label>		
        <input name="FaceImageMaster[tracer_id]" id="FaceImageMaster_tracer_id" type="text">	
    </div>
    <label>Choose Image</label>
    <input type="file" name="images[]" id="images" multiple >
    <div class="uploading none">
        <label>&nbsp;</label>
        <img src="uploading.gif" alt="uploading......"/>
    </div>
    
    <div id="images_preview"></div>
</form>


<script type="text/javascript">
$(document).ready(function(){
    $('#images').on('change',function(){
        $('#multiple_upload_form').ajaxForm({
            //display the uploaded images
            target:'#images_preview',
            beforeSubmit:function(e){
                $('.uploading').show();
            },
            success:function(e){
                $('.uploading').hide();
            },
            error:function(e){
            }
        }).submit();
    });
});
</script>