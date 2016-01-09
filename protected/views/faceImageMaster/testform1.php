<form action="createTest" method="POST" enctype="multipart/form-data">

    <div class="row">
        <label for="FaceImageMaster_tracer_id">Tracer ID</label>		
        <input name="FaceImageMaster[tracer_id]" id="FaceImageMaster_tracer_id" type="text">	
    </div>
    <input type="file" name="files[]" multiple="" />
    <input type="submit"/>
</form>