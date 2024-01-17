<?php if(file_exists(sys_image_path('flags') . $visitor->country_code . '.png')): ?>
	<img src="<?php echo e(asset(sys_image_path('flags') . $visitor->country_code . '.png'), false); ?>" class="lang-flag">
<?php endif; ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/partials/actions/visitor/flag.blade.php ENDPATH**/ ?>