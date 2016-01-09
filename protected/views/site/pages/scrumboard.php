<?php
$session = new CHttpSession;
$session->open();
$pid = base64_decode($_GET["id"]);
$sprint = (@$_GET["s"] != '') ? base64_decode($_GET["s"]) : 1;
yii::import("application.model.webservice");
$wp = new Webservice();
$projectName = ProjectMaster::model()->projectName($pid);
$wp->getTaskByDateForChart($pid,$sprint);
$ps = StoriesTasks::model()->workProgressPercentage($pid,$sprint);
$progress = $ps["progress"];
$pers = $ps["p"];
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Scrum Board</title>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/css/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/css/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js'; ?>"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/scrumboard.css" />
        <!-- Burndown charg Js-->
        <link class="include" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/jquery.jqplot.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/examples.min.css" />
        <!-- END -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#pb1 img").css({'background-position':'<?php echo $progress;?>% -50%'});
                $("#accordion").accordion({collapsible: false, active: true});
                $(".makeMeDraggable").hover(function() {
                    var ids = $(this).attr("id");
                    //alert(ids);
                    $("#" + ids).draggable();
                });
                openpopup = function(){
                    document.getElementById('popup_content').innerHTML = '';
                    document.getElementById('toPopup').style.display = 'block';
                    //var line2 = [['1/1/2008', 100], ['2/14/2008', 67], ['3/7/2008', 39], ['4/22/2008', 10]];
                    var line2 = [<?php echo $wp->getTaskByDateForChart($pid, $sprint); ?>];
                    
                    var plot2 = $.jqplot('popup_content', [line2], {
                    title: "Burn Down Chart For Project <i><?php echo $projectName; ?></i> For Sprint <?php echo $sprint;?>",
                      axes: {
                        xaxis: {
                          renderer: $.jqplot.DateAxisRenderer,
                          label: 'Days',
                          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                          tickOptions: {
                              // labelPosition: 'middle',
                              angle: -30
                          }
                        },
                        yaxis: {
                          label: 'Hours',
                          labelRenderer: $.jqplot.CanvasAxisLabelRenderer
                        }
                      }
                      , highlighter: {
                        show: true,
                        sizeAdjust: 7.5
                      },
                      cursor: {
                        show: false
                      }
                    });
                }
                closepopup = function() {
                    document.getElementById('toPopup').style.display = 'none';
                }
               openDiv = function(id){
                    var divid = 'expand-'+id;
                    var content = document.getElementById(divid).innerHTML ;
                    document.getElementById('toPopup').style.display = 'block';
                    document.getElementById('popup_content').innerHTML = content ;
                }
            });
            $(init);
            function init() {
                $('#makeMeDroppable').droppable({
                    drop: handleDropEvent,
                    hoverClass: 'cell-highlght',
                    containment: '#makeMeDroppable-1'
                });
                $('#makeMeDroppable-1').droppable({
                    drop: handleDropEvent,
                    hoverClass: 'cell-highlght',
                    containment: '#makeMeDroppable'
                });
                $('#makeMeDroppable-2').droppable({
                    drop: handleDropEvent,
                    hoverClass: 'cell-highlght',
                    containment: '#makeMeDroppable-2'
                });
                $('#makeMeDroppable-3').droppable({
                    drop: handleDropEvent,
                    hoverClass: 'cell-highlght',
                    containment: '#makeMeDroppable-3'
                });
            }
            function handleDropEvent(event, ui) {
                var draggable = ui.draggable;
                var parentDivid = $(this).attr("id");
                var destParentDivId = draggable.parent().attr("id") ;
                
                var status_id = 1;

                if (parentDivid == 'makeMeDroppable') {
                    status_id = 2;
                } else if (parentDivid == 'makeMeDroppable-2') {
                    status_id = 3;
                } else if (parentDivid == 'makeMeDroppable-3') {
                    status_id = 4;
                }
                var taskid = (draggable.attr('alt'));
                var style = draggable.attr('style');
                $(".action-div").show();
                $.post("<?php echo Yii::app()->baseUrl; ?>/index.php/storiestasks/updateTaskStyle",
                        {act: "updateStyle",
                            taskid: taskid,
                            style: style,
                            status_id: status_id
                        }
                )
                .done(function(data) {
                   
                    $(".action-div img").hide();
                   // $("ui-widget-header").css({'background': 'none repeat scroll 0 0 #008000','border': '1px solid','color': '#FFFFFF','font-weight': 'bold'});
                    $( "#success-div" ).dialog({
                        resizable: false,
                        width:500,
                        draggable: false,
                        resizable: false,
                        close: function(){
                             location.reload(); 
                        },
                        buttons: {
                            Ok: function() {
                                $( this ).dialog( "close" );
                                location.reload(); 
                            }
                        }
                        
                    });
                })
                .fail(function() {
                    $(".action-div img").hide();
                    $( "#dialog" ).dialog({
                        resizable: false,
                        width:500,
                        draggable: false,
                        resizable: false,
                        buttons: {
                            Ok: function() {
                                $( this ).dialog( "close" );
                                location.reload(); 
                            }
                        },
                        close: function(){
                             location.reload(); 
                        }
                        
                    });
                });
            }
        </script>
        <!---  script for drop-down  --->
        <script type="text/javascript">
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
            // 
    </script>
    </head>
    <body>
        <div id="dialog" title="! Warning Message" style="display: none;">
            <p><span><img src="<?php echo Yii::app()->baseUrl . '/images/warning.png'; ?>" style="float:left;margin: -5px 0;" /></span>&nbsp;
                <span style="color:red;text-align:center;">Login required for this action.Please login with your credential !</span></p>
        </div>
        <div id="success-div" title="Success Message" style="display: none;">
            <p><span><img src="<?php echo Yii::app()->baseUrl . '/images/success.png'; ?>" style="float:left;margin: -5px 0;" /></span>&nbsp;
                <span style="color:green;text-align:center;">You action is completed successfully!</span></p>
        </div>
        <div id="toPopup" > 
            <div class="close" onclick="closepopup();"></div>
            <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
            <div id="popup_content" > <!--your content start-->
                
            </div> <!--your content end-->
        </div> <!--toPopup end-->
        <div class="loader"></div>
        <div id="backgroundPopup"></div>
        <div class="action-div" style="display: none;">
            <img id="pro-img" src="<?php echo Yii::app()->baseUrl . '/css/ajax-loader-scrool.gif'; ?>" style="float: left;margin: 22% 48%;" />
        </div>
        <div id="content" style="min-height: 200px;margin: -20px 0 0;">
            <div class="top_panel">
                <span style="color: #E1E1E1;font-size: 26px;float: left;">
                    &nbsp;Scrum For Project <b>
                </span>
                <span style="color:white;font-size: 26px;text-transform:uppercase;float: left;">
                    &nbsp;<i><?php echo $projectName; ?></i>&nbsp;<span style="font-size: 12px ;">Sprint-<?php echo $sprint;?></span></b>
                </span>
                &nbsp;&nbsp;&nbsp;
                <ul id="sddm" style="float: right">
                    <li class="icon"><a href="#" onmouseover="mopen('m1')" onmouseout="mclosetime()"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/setting.png" alt="" title=""></a>
                        <div id="m1" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">
                            <a href="#" id="openopoup" onclick="openpopup();">Burn Down Chart</a>
                            <a href="<?php echo Yii::app()->baseUrl . '/index.php/projectStories/create?backurl=1'; ?>">Create Stories</a>
                            <a href="<?php echo Yii::app()->baseUrl . '/index.php/storiesTasks/create?backurl=1'; ?>">Create Tasks</a>
                        </div>
                    </li>

                </ul>
                <span class="phpText">&nbsp;PHP&nbsp;</span>
                <span class="phpCube"></span>
                
                <span class="androidText">&nbsp;Android&nbsp;</span>
                &nbsp;<span class="androidCube"></span>
                <span class="iosText">&nbsp;Ios&nbsp;</span>
                <span class="iosCube"></span>
                <span class="mtext">&nbsp;Mobile Story&nbsp;</span>
                <span class="mCube"><img src="<?php echo Yii::app()->baseUrl ; ?>/images/mobile.png"/></span>
                <span class="mtext">&nbsp;Web Story&nbsp;</span>&nbsp;&nbsp;
                <span class="mCube"><img src="<?php echo Yii::app()->baseUrl ; ?>/images/browser.png"/></span>
                <span class="progress-bar" id="pb1">
                    <span class="pers"><?php echo $pers ;?>%</span>
                    &nbsp;
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/progressbar.gif">
                    
                </span>
            </div>  
            
                <div id="sidebarbg" style="margin-left: 0px;"></div>
                <div class="stories-div">
                    <div class="stories-div-child-heading-first">
                        User Stories
                    </div>
                    <div class="stories-user-div" id="accordion">
                        <?php echo $wp->createStoriesBlock($pid, 'mobile',$sprint); ?>
                        <?php echo $wp->createStoriesBlock($pid, 'web',$sprint); ?>
                    </div>
                </div>
            
            <div class='content_area clearfix'>
                <div class="todo-div">
                    <div class="stories-div-child-heading">
                        To Do
                    </div>
                    <div class="stories-user-div" id="makeMeDroppable-1">
                        <?php echo $wp->createTaskBlock($pid, 'mobile', '1' , $sprint); ?>
                        <?php echo $wp->createTaskBlock($pid, 'web', '1' ,$sprint); ?>
                    </div>
                </div>
                <div class="inprogress-div">
                    <div class="stories-div-child-heading">
                        In Progress
                    </div>
                    <div class="stories-user-div" id="makeMeDroppable">
                        <?php // echo $wp->createTaskBlock($pid, 'mobile', '2'); ?>
                        <?php //echo $wp->createTaskBlock($pid, 'web', '2'); ?>
                    </div>
                </div>
                <div class="testing-div">
                    <div class="stories-div-child-heading-last">
                        Testing
                    </div>
                    <div class="stories-user-div" id="makeMeDroppable-2">
                        <?php //echo $wp->createTaskBlock($pid, 'mobile', '3'); ?>
                        <?php //echo $wp->createTaskBlock($pid, 'web', '3'); ?>
                    </div>
                 </div>
                <div class="done-div">
                    <div class="stories-div-child-heading-last">
                        Done
                    </div>
                    <div class="stories-user-div-last" id="makeMeDroppable-3">
                        <?php //echo $wp->createTaskBlock($pid, 'mobile', '3'); ?>
                        <?php //echo $wp->createTaskBlock($pid, 'web', '3'); ?>
                    </div>
                 </div>
            </div>
        </div>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/jquery.jqplot.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.logAxisRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.highlighter.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.barRenderer.min.js"></script>
    </body>
</html>