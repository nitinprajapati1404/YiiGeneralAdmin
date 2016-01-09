<div class="headerbar">
    <a class="menutoggle"><i class="fa fa-bars"></i></a>



    <div class="header-right">
        <ul class="headermenu"> 
             
                <li>
                    <div class="btn-group">
                         
                        <div class="dropdown-menu dropdown-menu-head pull-right">
                            <h5 class="title">You have Message</h5>
                     
                        </div>
                    </div>
                </li>
          
            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php
                        $userPic = App::getSession('uprofile_pic');
                        if ($userPic == '')
                            $userPic = App::param('upload_url_local') .'adminuser/default.png';
                        else
                            $userPic = App::param('upload_url') . 'adminuser/'.$userPic;
                        ?>
                        <img src="<?php echo $userPic; ?>" alt="Profile Pic" title="<?php echo App::getSession('fullname'); ?>"/>
                        <?php echo App::getSession('fullname'); ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <!--<li><a href="<?php echo App::param('siteurl') . "adminUsersMaster/UserProfile/"; ?>"><i class="fa fa-user"></i> My Profile</a></li>-->
   
                        <li><a href="<?= App::param('siteurl'); ?>userMaster/ChangePassword/"><i class="glyphicon glyphicon-question-sign"></i> Change Password</a></li>
                        
                         
                        <li><a href="<?= App::param('siteurl'); ?>site/logout/"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                        
                    </ul>
                </div>
            </li> 
        </ul>
    </div><!-- header-right -->

</div><!-- headerbar -->
<?php // App::pr($_SESSION);?>
    
