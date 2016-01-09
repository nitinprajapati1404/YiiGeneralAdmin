<?php 
$session = new CHttpSession;
$session->open();
$pid = base64_decode($_GET["id"]);
yii::import("application.model.webservice");
$wp = new Webservice();
$projectName = $session["project_name"];
//Webservice::p(
       
//        ) ; 

//($pid,'web');
?>
<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="default.css">
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>-->
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>-->
        <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/css/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js'; ?>"></script>
     
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/scrumboard.css" />
        <script type="text/javascript">
         $(document).ready(function(){
             $( "#accordion" ).accordion({collapsible:false, active:true});
             $(".makeMeDraggable").hover(function() {
        
                var ids = $(this).attr("id");
                //alert(ids);
                $("#" + ids).draggable();
                });
            });
            $(init);
            function init() {
                //$('#makeMeDraggable').draggable();
                //$('#makeMeDraggable-1').draggable();
                $('#makeMeDroppable').droppable({
                    drop: handleDropEvent
                });
                $('#makeMeDroppable-1').droppable({
                    drop: handleDropEvent
                });
                $('#makeMeDroppable-2').droppable({
                    drop: handleDropEvent
                });
            }
            function handleDropEvent(event, ui) {
                var draggable = ui.draggable;
                var parentDivid =$(this).attr("id");
                var status_id = 1 ;
                
                if(parentDivid == 'makeMeDroppable') {
                    status_id = 2;
                } else if (parentDivid == 'makeMeDroppable-2') {
                    status_id = 3;
                }
                var taskid = (draggable.attr('alt')) ;
                var style = draggable.attr('style') ;
               $(".action-div").show();
                $.post( "<?php echo Yii::app()->baseUrl;?>/index.php/storiestasks/updateTaskStyle", 
                    { act: "updateStyle", 
                        taskid: taskid,
                        style : style ,
                        status_id : status_id
                    }
                    )
                    .done(function( data ) {
                        $(".action-div").hide();
                    });
                    
                //alert( 'The square with ID "' + draggable.attr('id') + '" was dropped onto me!' );
            }
        </script>

        <!---  script for drop-down  --->
        <script type="text/javascript">
        <!--
            var timeout = 500;
            var closetimer = 0;
            var ddmenuitem = 0;

        // open hidden layer
            function mopen(id)
            {
                // cancel close timer
                mcancelclosetime();

                // close old layer
                if (ddmenuitem)
                    ddmenuitem.style.visibility = 'hidden';

                // get new layer and show it
                ddmenuitem = document.getElementById(id);
                ddmenuitem.style.visibility = 'visible';

            }
        // close showed layer
            function mclose()
            {
                if (ddmenuitem)
                    ddmenuitem.style.visibility = 'hidden';
            }

        // go close timer
            function mclosetime()
            {
                closetimer = window.setTimeout(mclose, timeout);
            }

        // cancel close timer
            function mcancelclosetime()
            {
                if (closetimer)
                {
                    window.clearTimeout(closetimer);
                    closetimer = null;
                }
            }

        // close layer when click-out
            document.onclick = mclose;
        // -->
        </script>
 
</head>
<body>
    <div class="action-div" style="display: none;"><img src="<?php echo Yii::app()->baseUrl.'/css/ajax-loader-2.gif'; ?>" style="float: left;
    margin: 22% 48%;" /></div>

  <!--    <div class="info">
        <div style="width:100%;margin-bottom: 15px;">
            <input type="text" size="1" class="info-input">
            <input type="text" style="float :right;margin:4px 0px" size="1" class="info-input">
        </div>
        <div style="width:100%;"> 
            <textarea rows="2" cols="9"  class="info-textarea"></textarea>
        </div>
        
        <div style="width:100%;margin-bottom: 15px;">
            <input type="text" size="1" class="info-input" >
            <input type="text" style="float :right;margin:4px 0px" size="1" class="info-input">
        </div>
    </div>
 <div class="info">
        <span class="info-input">AK</span>
        <span class="info-input" style="float :right;margin:4px 0px">4</span>
        <div  class="info-box">  Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
              ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
              amet, nunc. Nam a nibh. </div>
        <span class="info-input">AK</span>
        <span class="info-input" style="float :right;margin:4px 0px">4</span>
    </div>
    -->
  
<div id="content" style=" height: 1000px;">
<div class="top_panel">
    <span style="color: #E1E1E1;font-size: 26px;">
        &nbsp;Scrum For Project <b>
    </span>
<span style="color:white;font-size: 26px;text-transform:uppercase;">
    <i><?php echo $projectName ;?></i></b>
</span>
<ul id="sddm">
	<li class="icon"><a href="#" onmouseover="mopen('m1')" onmouseout="mclosetime()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/setting.png" alt="" title=""></a>
		<div id="m1" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
		<a href="#">Burn Down Chart</a>
		<a href="#">Create Stories</a>
		<a href="#">Create Tasks</a>
		
		</div>
	</li>
	
</ul>




 <!-- <span class="icon"><a href=""><img src="setting.png" alt="" title=""></a></span>-->
</div>  
    <div style="margin:auto;">
    <div class="stories-div" />
        <div class="stories-div-child-heading-first">
           User Stories
        </div>
        <div class="stories-user-div" id="accordion">
           
            <!--
            <h3>Stories 2</h3>
            <div>
              <p>
              Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
              ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
              amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
              odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
              </p>
            </div>
            <h3>Stories 3</h3>
            <div>
              <p>
              Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
              ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
              amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
              odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
              </p>
            </div>
            <h3>Stories 4</h3>
            <div>
              <p>
              Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
              ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
              amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
              odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
              </p>
            </div>
            <h3>Stories 5</h3>
            <div>
              <p>
              Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
              ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
              amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
              odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
              </p>
            </div>
            -->
            <?php echo $wp->createStoriesBlock($pid,'mobile') ;?>
            <?php echo $wp->createStoriesBlock($pid,'web') ;?>
        </div>
    </div>
    <div class="todo-div" />
        <div class="stories-div-child-heading">
           To Do
        </div>
        <div class="stories-user-div" id="makeMeDroppable-1">
            <?php echo $wp->createTaskBlock($pid, 'mobile' , '1') ;?>
            
            <?php echo $wp->createTaskBlock($pid, 'web' , '1') ;?>
         <!--   <div class="makeMeDraggable info" alt ="1" id="makeMeDraggable-1">
               
                    <div style="width:100%;margin-bottom: 15px;">
                        <div class="info-input" style="float:left"> 1</div>
                        <div class="info-input" style="float :right;">4</div>
                    </div>
                    <div  class="info-box" style="width:100%;"> 
                        As a User I can able to login into the login panel .
                    </div>

                    <div style="width:100%">
                        <div class="info-input" style="float:left"> Ankit</div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit" class="link-info" >Edit</a>
                        <div class="info-input" style="float :right;">3</div>                       
                        &nbsp;&nbsp;&nbsp;<div class="info-input" style="float :right;">4</div>
                    </div>
               
                    <div style="width:100%;display: none;" id="makeMeDraggable-1-edit"  >
                    <div style="width:100%;margin-bottom: 15px;">
                        <input type="text" size="1" class="info-input">
                        <input type="text" style="float :right;margin:4px 0px" size="1" class="info-input">
                    </div>
                    <div style="width:100%;"> 
                        <textarea rows="2" cols="9"  class="info-textarea"></textarea>
                    </div>

                    <div style="width:100%;margin-bottom: 15px;">
                        <input type="text" size="1" class="info-input" >
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit" class="link-info" alt="makeMeDraggable-1">Submit</a>
                        <input type="text" style="float :right;margin:4px 0px" size="1" class="info-input">
                    </div>
                    </div>
                 
               
            </div>
 -           <div class="makeMeDraggable warning" alt ="2" id="makeMeDraggable-2">
                <div style="width:100%;margin-bottom: 15px;">
                    <div class="info-input" style="float:left"> 1</div>
                    <div class="info-input" style="float :right;">4</div>
                </div>
                <div  class="info-box" style="width:100%;"> 
                   As a User I can able to login into the login panel .
                </div>
                
              <div style="width:100%">
                    <div class="info-input" style="float:left"> Ankit</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit" class="link-warning" >Edit</a>
                    <div class="info-input" style="float :right;">4</div>
                </div>
            </div>
            <div class="makeMeDraggable success" alt ="3" id="makeMeDraggable-3">
                <div style="width:100%;margin-bottom: 15px;">
                    <div class="info-input" style="float:left"> 1</div>
                    <div class="info-input" style="float :right;">4</div>
                </div>
                <div  class="info-box" style="width:100%;"> 
                   As a User I can able to login into the login panel .
                </div>
                
              <div style="width:100%">
                    <div class="info-input" style="float:left"> Ankit</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit" class="link-success" >Edit</a>
                    <div class="info-input" style="float :right;">4</div>
                </div>
            </div>
             <div class="makeMeDraggable error" alt ="4" id="makeMeDraggable-4"> 
                 <div style="width:100%;margin-bottom: 15px;">
                    <div class="info-input" style="float:left"> 1</div>
                    <div class="info-input" style="float :right;">4</div>
                </div>
                <div  class="info-box" style="width:100%;"> 
                   As a User I can able to login into the login panel .
                </div>
                
              <div style="width:100%">
                    <div class="info-input" style="float:left"> Ankit</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit" class="link-error" >Edit</a>
                    <div class="info-input" style="float :right;">4</div>
                </div>
            </div>-->
        </div>
    </div>
    <div class="inprogress-div" />
        <div class="stories-div-child-heading">
           In Progress
        </div>
        <div class="stories-user-div" id="makeMeDroppable">
             <?php echo $wp->createTaskBlock($pid, 'mobile' , '2') ;?>
            
            <?php echo $wp->createTaskBlock($pid, 'web' , '2') ;?>
        </div>
    </div>
    <div class="done-div" />
        <div class="stories-div-child-heading-last">
           Testing
        </div>
        <div class="stories-user-div-last" id="makeMeDroppable-2">
            <?php echo $wp->createTaskBlock($pid, 'mobile' , '3') ;?>
            
            <?php echo $wp->createTaskBlock($pid, 'web' , '3') ;?>
        </div>
    </div>
  <!--  <div class="stories-div">
        
    </div>
  <div id="makeMeDraggable" class="makeMeDraggable"> 1</div>
  <div id="makeMeDraggable-1" class="makeMeDraggable"> 2</  div>
  <div id="makeMeDroppable"><h1> Done</h1> </div>
  <div id="makeMeDroppable-1"><h1> In Progress</h1> </div>
    <div id="makeMeDroppable-2"><h1> To do</h1> </di
--> 
</div>
</div>
 
</body>
</html>