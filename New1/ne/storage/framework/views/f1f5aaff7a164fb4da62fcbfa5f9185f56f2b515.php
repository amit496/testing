<?php $__env->startSection('content'); ?>
	<?php if(session('success')): ?>
		<div class="alert <?php echo e(Session::get('alert-class', 'alert-info'), false); ?> alert-dismissible fade show">
			<?php echo e(session('success'), false); ?>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	 <?php endif; ?>
	 <?php if(session('error')): ?>
		<div class="alert <?php echo e(Session::get('alert-class', 'alert-info'), false); ?> alert-danger  fade show">
			<?php echo e(session('error'), false); ?>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	 <?php endif; ?>
	<div class="box stf_outer_body stf_outer_page_load stf_side_bar_not_hide stf_manage_products_list  stf_products_list_section stf_product_window_show_class" style="display:none">
		<div class="stf_products_list_section">
			
			<?php echo $data['product_list_html']; ?>

		</div>
		
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-style'); ?>
<style>
#DataTables_Table_0 .c-text-left{text-align:left!important}
#DataTables_Table_0 .c-text-center{text-align:center!important}
</style>
<?php $__env->startSection('page-script'); ?>
jQuery(document).ready(function(){
	con
	stfGetProductListHtmlAjax();
});
<?php echo $__env->make('admin.stylist_form.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/stylist_form/manage_products.blade.php ENDPATH**/ ?>