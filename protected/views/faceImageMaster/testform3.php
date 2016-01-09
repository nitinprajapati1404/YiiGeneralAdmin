

<style>

    //  Find the bellow CSS code
    input[type="file"] { 
        display:block;
    }
    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        margin: 10px 10px 0 0;
        padding: 1px;
    }
</style>
<!--<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/config.js'; ?>"></script>-->
<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        config.imagePreview('#files','change');
    });

</script>
<form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="createTest3">

    Find the bellow HTML code
    <h2>preview multiple images before upload using jQuery</h2>
    <div class="row">
        <label for="FaceImageMaster_tracer_id">Tracer ID</label>		
        <input name="FaceImageMaster[tracer_id]" id="FaceImageMaster_tracer_id" type="text">	
    </div>
    <label>Choose Image</label>
    <input type="file" id="files" name="images[]" multiple />

    <input type="submit"/>

</form>


