<?php
/* @var $this Controller */
$session = new CHttpSession;
$session->open();
$pid = ($session["pid"] != '') ? $session["pid"] : @$_GET["pid"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.default.css" media="screen, projection" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-57x57.png">
            <link rel="apple-touch-icon" sizes="60x60" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-60x60.png"></link>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-72x72.png"></link>
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-76x76.png"></link>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-114x114.png"></link>
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-120x120.png"></link>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-144x144.png"></link>
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-152x152.png"></link>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo App::param("siteurl")?>images/favicon/apple-icon-180x180.png"></link>
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo App::param("siteurl")?>images/favicon/android-icon-192x192.png"></link>
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo App::param("siteurl")?>images/favicon/favicon-32x32.png"></link>
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo App::param("siteurl")?>images/favicon/favicon-96x96.png"></link>
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo App::param("siteurl")?>images/favicon/favicon-16x16.png"></link>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript">var siteurl = "<?php echo App::param("siteurl"); ?>";</script>  
        <script src="<?php echo App::param("siteurl") ?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo App::param("siteurl") ?>js/jquery-ui-1.10.3.min.js"></script>
        <script src="<?php echo App::param("siteurl") ?>js/bootstrap.min.js"></script>
        <script src="<?php echo App::param("siteurl") ?>js/jquery.mCustomScrollbar.js"></script>
        <link rel="stylesheet" type="text/css" href="<?= App::param('siteurl'); ?>css/jquery.mCustomScrollbar.css"/>
    </head>
    <body class="signin">


        <section>

            <div class="signinpanel">

                <div class="row">
<?php echo $content; ?>
                </div><!-- row -->

            </div><!-- signin -->

        </section>


<?php require_once 'footer.php'; ?>
        <script>
                    jQuery(document).ready(function() {

                        // Please do not use the code below
                        // This is for demo purposes only
                        var c = jQuery.cookie('change-skin');
                        if (c && c == 'greyjoy') {
                            jQuery('.btn-success').addClass('btn-orange').removeClass('btn-success');
                        } else if (c && c == 'dodgerblue') {
                            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
                        } else if (c && c == 'katniss') {
                            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
                        }
                    });
        </script>

    </body>    

</html>
