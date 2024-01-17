<div class="section-title">
  <h4><?php echo app('translator')->get('theme.manage_your_account'); ?></h4>
</div>

<ul class="account-sidebar-nav">
   
  
  <li class="<?php echo e($tab == 'orders' ? 'active' : '', false); ?>">
    <a href="<?php echo e(route('account', 'orders'), false); ?>"><i class="fas fa-shopping-cart"></i> <?php echo app('translator')->get('theme.nav.my_orders'); ?></a>
  </li>
  
  <li class="<?php echo e($tab == 'account' ? 'active' : '', false); ?>">
    <a href="<?php echo e(route('account', 'account'), false); ?>" ><i class="fas fa-user"></i> <?php echo app('translator')->get('theme.nav.my_account'); ?></a>
  </li>
</ul>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/nav/account_page_sidebar.blade.php ENDPATH**/ ?>