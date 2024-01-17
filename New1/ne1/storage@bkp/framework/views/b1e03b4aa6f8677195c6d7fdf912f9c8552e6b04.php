<!-- Main Header -->
<header class="main-header customize_header stf_top_header">
  <!-- Logo -->
  <a href="<?php echo e(url('/'), false); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><?php echo e(Str::limit(get_site_title(), 2, '.'), false); ?></span>

    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><?php echo e(get_site_title(), false); ?></span>
  </a>
 

  <!-- dappr-customize -->

 
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top stf_top_nav" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="javascript::void(0)" class="sidebar-toggle stf_product_window_hide_class" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <a href="javascript:void(0)" class="stf_reveal_item_list_top_nav_btn" style="display: none;" onclick="stfShowRevealsPage(this)"><i class="fa fa-angle-left"></i></a>

    <a href="javascript:void(0)" class="stf_product_window_back_btn stf_product_window_show_class" onclick="stfProductWindowShowHide('N')" style="display: none;" ><i class="fa fa-angle-left"></i></a>
    <ul class="nav navbar-nav hidden-xs">
      <li>
        <a href="<?php echo e(route('admin.account.profile'), false); ?>">
          <?php echo e(trans('app.welcome') . ' ' . Auth::user()->getName(), false); ?>

        </a>
      </li>

      
    </ul>
    
   
    <div class="stf_top_website_name"><img src="<?php echo e(url('images/stylist/header_logo.png'), false); ?>" alt="DAPPER"></div>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages Menu-->
        

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu" id="notifications-dropdown"> 
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>            
            <?php if($count_notification = Auth::user()->unreadNotifications->count()): ?>
              <span class="label label-warning"><?php echo e($count_notification, false); ?></span>
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu">
            <li class="header"><?php echo e(trans('messages.notification_count', ['count' => $count_notification]), false); ?> </li>
            
            <li>
              <ul class="menu">
                <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <?php
                      $notification_view = 'admin.partials.notifications.' . Str::snake(class_basename($notification->type));
                    ?>

                    <?php echo $__env->first([$notification_view, 'admin.partials.notifications.default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul><!-- .menu -->
            </li>
            <li class="footer"><a href="<?php echo e(route('admin.notifications'), false); ?>"><?php echo e(trans('app.view_all_notifications'), false); ?></a></li>
          </ul>
        </li><!-- /.notifications-menu -->

        <!-- Announcement Menu -->
        <?php if($active_announcement = get_global_announcement()): ?>
          <li class="dropdown tasks-menu" id="announcement-dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bullhorn"></i>
              <?php if($active_announcement && $active_announcement->updated_at > Auth::user()->read_announcements_at): ?>
                <span class="label"><i class="fa fa-circle"></i></span>
              <?php endif; ?>
            </a>
            <ul class="dropdown-menu">
              <li>
                <?php echo $active_announcement->parsed_body; ?>

                <?php if($active_announcement->action_url): ?>
                  <span class="indent10">
                    <a href="<?php echo e($active_announcement->action_url, false); ?>" class="btn btn-flat btn-default btn-xs"><?php echo e($active_announcement->action_text, false); ?></a>
                  </span>
                <?php endif; ?>
              </li>
            </ul>
          </li><!-- /.notifications-menu -->
        <?php endif; ?>

        <!-- Wallet -->
        <?php if(Auth::user()->isMerchant() && is_incevio_package_loaded('wallet')): ?>
          <li class="dropdown tasks-menu" id="wallet-dropdown">
            <a href="<?php echo e(route('merchant.wallet'), false); ?>">
              <span><?php echo e(trans('wallet::lang.balance'), false); ?>: </span>
              <?php echo e(get_formated_currency(Auth::user()->shop->balance, config('system_settings.decimals', 2)), false); ?>

            </a>
          </li>
        <?php endif; ?>

        <li class="user user-menu">
          <a href="<?php echo e(route('admin.account.profile'), false); ?>">
            <?php if(Auth::user()->image): ?>
              <img src="<?php echo e(get_storage_file_url(Auth::user()->image->path, 'tiny'), false); ?>" class="user-image" alt="<?php echo e(trans('app.avatar'), false); ?>">
            <?php else: ?>
              <img src="<?php echo e(get_gravatar_url(Auth::user()->email, 'tiny'), false); ?>" class="user-image" alt="<?php echo e(trans('app.avatar'), false); ?>">
            <?php endif; ?>
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"><?php echo e(trans('app.account'), false); ?></span>
          </a>
        </li>

        <li>
          <a href="<?php echo e(Request::session()->has('impersonated') ? route('admin.secretLogout') : route('logout'), false); ?>"><i class="fa fa-sign-out"></i> <span class="hidden-xs"><?php echo e(trans('app.log_out'), false); ?></span></a>
        </li>

        <li>
          
        </li>
      </ul>
    </div>
  </nav>
</header>

<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/header.blade.php ENDPATH**/ ?>