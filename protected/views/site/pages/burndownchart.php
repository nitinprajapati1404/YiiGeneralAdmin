<!DOCTYPE html>
<link class="include" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/jquery.jqplot.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/examples.min.css" />
<!--    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="syntaxhighlighter/styles/shThemejqPlot.min.css" />-->
  
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->
<!--    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl . '/css/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js'; ?>"></script>
<!--    <div class="colmask leftmenu">
      <div class="colleft">
        <div class="col1" id="example-content">-->

<!--<div class="example-plot" id="chart1"></div>-->
<div class="example-plot" id="chart2"></div>
<!--<div class="example-plot" id="chart3"></div>
<div class="example-plot" id="chart4"></div>  -->

    
<!--    
<script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){
    var line1 = [6.5, 9.2, 14, 19.65, 26.4, 35, 51];

    var plot1 = $.jqplot('chart1', [line1], {
        legend: {show:false},
        axes:{
          xaxis:{
          tickOptions:{ 
            angle: -30
          },
          tickRenderer:$.jqplot.CanvasAxisTickRenderer,
            label:'Core Motor Amperage', 
          labelOptions:{
            fontFamily:'Helvetica',
            fontSize: '14pt'
          },
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer
          }, 
          yaxis:{
            renderer:$.jqplot.LogAxisRenderer,
            tickOptions:{
                labelPosition: 'middle', 
                angle:-30
            },
            tickRenderer:$.jqplot.CanvasAxisTickRenderer,
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
            labelOptions:{
                fontFamily:'Helvetica',
                fontSize: '14pt'
            },
            label:'Core Motor Voltage'
          }
        }
    });

});
</script>-->
<script class="code" type="text/javascript" language="javascript">
var $jq = $.noConflict();
$jq(document).ready(function(){   
    
    var line2 = [['1/1/2008', 100], ['2/14/2008', 67], ['3/7/2008', 39], ['4/22/2008', 10]];

    var plot2 = $jq.jqplot('chart2', [line2], {
      axes: {
        xaxis: {
          renderer: $jq.jqplot.DateAxisRenderer,
          label: 'Days',
          labelRenderer: $jq.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $jq.jqplot.CanvasAxisTickRenderer,
          tickOptions: {
              // labelPosition: 'middle',
              angle: -30
          }
          
        },
        yaxis: {
          label: 'Hours',
          labelRenderer: $jq.jqplot.CanvasAxisLabelRenderer
        }
      }
    });

});
</script>
<!--<script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){   
    var line3 = [['Cup Holder Pinion Bob', 7], ['Generic Fog Lamp Marketing Gimmick', 9], 
    ['HDTV Receiver', 15], ['8 Track Control Module', 12], 
    ['SSPFM (Sealed Sludge Pump Fourier Modulator)', 3], 
    ['Transcender/Spice Rack', 6], ['Hair Spray Rear View Mirror Danger Indicator', 18]];

    var plot3 = $.jqplot('chart3', [line3], {
      series:[{renderer:$.jqplot.BarRenderer}],
      axes: {
        xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
          label: 'Warranty Concern',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          tickOptions: {
              angle: -30,
              fontFamily: 'Courier New',
              fontSize: '9pt'
          }
          
        },
        yaxis: {
          label: 'Occurance',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer
        }
      }
    });
    
    
});
</script>-->
  
<!--<script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){

    var line = [['Cup Holder Pinion Bob', 7], ['Generic Fog Lamp', 9], ['HDTV Receiver', 15], 
    ['8 Track Control Module', 12], [' Sludge Pump Fourier Modulator', 3], 
    ['Transcender/Spice Rack', 6], ['Hair Spray Danger Indicator', 18]];

    var line2 = [['Nickle', 28], ['Aluminum', 13], ['Xenon', 54], ['Silver', 47], 
    ['Sulfer', 16], ['Silicon', 14], ['Vanadium', 23]];

    var plot4 = $.jqplot('chart4', [line, line2], {
        title: 'Concern vs. Occurrance',
        series:[{renderer:$.jqplot.BarRenderer}, {xaxis:'x2axis', yaxis:'y2axis'}],
        axes: {
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Warranty Concern',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: 30
                }
            },
            x2axis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Metal',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: 30
                }
            },
            yaxis: {
                autoscale:true,
                label: 'Occurance',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: 30
                }
            },
            y2axis: {
                autoscale:true,
                label: 'Number',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: 30
                }
            }
        }
    });
});
    </script>-->

<!-- End example scripts -->

<!-- Don't touch this! -->


    
<!--    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/syntaxhighlighter/scripts/shBrushXml.min.js"></script>-->
<!-- Additional <?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins go here -->
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/jquery.jqplot.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.logAxisRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/jqplot/plugins/jqplot.barRenderer.min.js"></script>

<!-- End additional plugins -->

<!--        </div>
         
    </div>
    </div>-->
    <!--<script type="text/javascript" src="example.min.js"></script>-->

