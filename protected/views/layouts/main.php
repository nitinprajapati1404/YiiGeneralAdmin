<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once 'head.php';?>
        <script type="text/javascript">var siteurl = "<?php echo App::param("siteurl"); ?>";</script>   
                <meta http-equiv="refresh" content="<?php echo 1000;?>"/>
    </head>

    <body class="stickyheader">
        <div id="loading-image">
           <!-- <img src="http://localhost/phoenix_old/bracket-theme/template/images/loaders/loader7.gif" alt="Loading..." />-->
</div>
        <!-- Preloader -->
<!--        <div id="preloader">
            <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>-->

        <section>

            <?php 
//            $this->renderPartial('//layouts/sidebar');
            require_once 'sidebar.php'; 
            
            ?>
            
            <?php 
//            echo "111";die;
?>
            <div class="mainpanel">

                <?php 
//$this->renderPartial('//layouts/header');
 require_once 'header.php'; ?>

                <div class="pageheader"> 
                <!--here $this->heading is removed-->
                    <?php if (isset($this->breadcrumbs)): ?>
                        <div class="breadcrumb-wrapper">
                            <?php
//                            $this->widget('zii.widgets.CBreadcrumbs', array(
//                                'links' => $this->breadcrumbs,
//                                'homeLink' => '<a href="' . Yii::app()->baseUrl . '">Home</a>',
//                                'separator' => ' <span style="font-size:16px;color:#d1d1d1;"> &nbsp;/&nbsp; </span> '
//                            ));
                            ?><!-- breadcrumbs -->
                        </div>
                    <?php endif ?>
                </div>

                <div class="contentpanel">
                    <?php
                    
                    echo $content; ?>
                </div><!-- contentpanel -->

            </div><!-- mainpanel -->
            <div class="rightpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="rp-alluser">
                        <h5 class="sidebartitle">My Activities</h5>
                        <ul class="chatuserlist">
                           
                        </ul>    
                    </div>
                </div><!-- tab-content -->
            </div><!-- rightpanel -->
        </section>
<?php require_once 'footer.php'; ?>
<script>
$(document).ready(function(e) {
    $('table.table  tr td input').attr('placeholder','Search here...')
});
</script>
    </body>
</html>
