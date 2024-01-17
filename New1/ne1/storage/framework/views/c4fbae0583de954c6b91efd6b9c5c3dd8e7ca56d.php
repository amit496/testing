<?php if(config('system_settings.worldwide_business_area')): ?>
	<div class="alert alert-info alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong><i class="icon fa fa-info-circle"></i><?php echo e(trans('app.notice'), false); ?></strong>
		<?php echo e(trans('messages.active_worldwide_business_area'), false); ?>

	</div>
<?php endif; ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/partials/notices/worldwide_business_area.blade.php ENDPATH**/ ?>