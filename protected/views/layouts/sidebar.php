<?php //Yii::import("application.components.Menu", true);       ?>
<div class="leftpanel sticky-leftpanel">

    <div class="logopanel">
        <a href="<?= App::param('siteurl'); ?>site/index">
            <img  src="<?= App::param('siteurl'); ?>images/logo3.png" width="37px">
            <span>Yii General Application</span>
        </a>
    </div><!-- logopanel -->

    <div class="leftpanelinner">    

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <?php
                $imageurl = App::param('upload_url') . 'adminuser/';
                $name = App::getSession('uprofile_pic');
                ?>
                <img alt="Profile Pic" title="<?php echo App::getSession('fullname'); ?>" src="<?php echo $imageurl . $name; ?>" class="media-object">
                <div class="media-body">
                    <h4><?php echo App::getSession('fullname'); ?></h4>
                </div>
            </div>

            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">

                <!--<li><a href="<?php echo App::param('siteurl') . "adminUsersMaster/UserProfile/"; ?>"><i class="fa fa-user"></i> My Profile</a></li>-->
                <!--<li><a href="<?php //echo App::param('siteurl')."AdminUsersMaster/".App::getSession('uid');       ?>"><i class="fa fa-user"></i> My Profile</a></li>-->
<!--                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>-->
                <li><a href="<?= App::param('siteurl'); ?>userMaster/ChangePassword/"><i class="glyphicon glyphicon-question-sign"></i> Change Password</a></li>

                <li><a href="<?= App::param('siteurl'); ?>site/logout/"><i class="fa fa-sign-out"></i> Log Out</a></li>
            </ul>
        </div>

        <!--<h5 class="sidebartitle">Navigation</h5>-->

        <?php
        //echo 'hello';die;
        $menuArr = menu::getMenu();
//        App::pr($menuArr);
        ?>
        <ul class="nav nav-pills nav-stacked nav-bracket">
            <?php
            foreach ($menuArr as $k => $v) {
                $cls = '';
                if (isset($v['submenu']) && is_array($v['submenu']) && !empty($v['submenu']))
                    $cls = 'nav-parent';

                $class = isset($v['class']) ? $v['class'] : "fa fa-home";
                if (isset($v['maincontroller']) && !empty($v['maincontroller'])) {  //to highlight title for that which is not submenu but part of this controller
                    $mainController = array_map('strtolower', $v['maincontroller']); // make all the values in lower case
                    if (in_array(strtolower($this->id . 'controller'), $mainController)) {
                        $cls = 'nav-parent active';
                    }
                }
                ?> 
                <li class="<?php echo $cls ?>"><a href="<?php echo $v['url'] ?>"><i class="<?php echo $class ?>"></i> <span><?php echo $v['label']; ?></span></a>
                    <?php
                    if (isset($v['submenu']) && is_array($v['submenu']) && !empty($v['submenu'])) {
                        $submenuArr = $v['submenu'];
                        ?>
                        <ul class="children">
                            <?php
                            foreach ($submenuArr as $i => $j) {
//                                App::pr($this->id);
//                                App::pr($this->action->id);
                                $flag = 0;
                                if (isset($j['controller']) && $j['controller'] != '') {
                                    if (isset($j['url']) && $j['url'] != '') {
                                        $tmpUrlArr = explode('/', $j['url']);
                                        $actionName = array_pop($tmpUrlArr);
                                        if (strtolower($actionName) == 'admin')
                                            $actionName = 'view';
                                    }
                                    // if (App::checkPermission($j['controller'], $actionName) == 1)
                                    $flag = 1;
                                }
                                if ($flag == 1) {
                                    $activeCls = '';

                                    $tmpActionName = $actionName;
                                    if ($actionName == 'view')
                                        $tmpActionName = 'admin';
                                    //echo $tmp = $actionName.'=='.strtolower($j['controller']).'=='.strtolower($this->id).' && '.strtolower($actionName).'=='.strtolower($this->action->id);
                                    if (strtolower($j['controller']) == strtolower($this->id . 'controller') && strtolower($tmpActionName) == strtolower($this->action->id))
                                        $activeCls = 'active';
                                    //echo $tmpActionName.'=='.$activeCls;die;
                                    ?>
                                    <li class="<?php echo $activeCls; ?>"><a href="<?php echo $j['url']; ?>"><i class="fa fa-caret-right"></i> <?php echo $j['label']; ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->

<script type="text/javascript">
    $(document).ready(function(e) {
        $('.leftpanel-collapsed .nav-bracket .children').mCustomScrollbar(); /* Custome Scrollbar  */

//       $(".children ul").click(function (e) {
//    e.preventDefault();
////    $(".children ul").removeClass("selected");
//    $(this).parent('li').removeClass('nav-active').addClass('nav-active'); // I also tried .parent().addClass
//});

        $('li .active').parent().parent().removeClass('nav-active').addClass('nav-active');
    });
</script>