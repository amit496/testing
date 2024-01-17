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
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Manage Stylist Form</h3>
	      <div class="box-tools pull-right">
				<a href="<?php echo e(url('admin/stylist/add'), false); ?>"  class=" btn btn-new btn-flat">Add a New Form</a>
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-no-sort">
	        <thead>
	        <tr>
	          <th>#</th>
	          <th>Name</th>
	          <th>Slug</th>
	          <th>Status</th>
	          <th>Date</th>
	         
	          <th>Action </th>
	         
	        </tr>
	        </thead>
	        <tbody>
				
			
		       <?php if($list->count() > 0): ?>
                                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td scope="row" class="checkbox-cell"> <?php echo e(($list->currentpage()-1) * $list->perpage() + $key + 1, false); ?> </td>
                                                    <td> <?php echo e($info->name, false); ?> </td>
                                                    <td> <?php echo e($info->slug, false); ?> </td>
                                                    
                                                    <td>

                                                            <?php if($info->status): ?>
                                                               <a href="<?php echo e(url($action_base_url.'/update/id/'.$info->id, ['status',0]), false); ?>">
                                                               <span class="badge bg-label-primary me-1">Active</span>
                                                            <?php else: ?>
                                                               <a href="<?php echo e(url($action_base_url.'/update/id/'.$info->id, ['status',1]), false); ?>">
                                                            <span class="badge bg-label-warning me-1">Inactive</span>
                                                            <?php endif; ?>
                                                        </a>
                                                    </td>
                                                    <td> <?php echo e($info->updated_at, false); ?> </td>

                                                    <td> <?php echo e($info->code, false); ?> </td>

                                                    <td>
                                                    <a class="btn btn-info" title="Edit" href="<?php echo e(url($action_base_url.'/add', $info->id), false); ?>"><i class="fa fa-solid fa-edit"></i></a>
                                                     <a class="btn btn-danger" title="Delete" href="<?php echo e(url($action_base_url.'/delete/'.$info->id), false); ?>"><i class="fa fa-solid fa-trash"></i> </a>
                                                     <a class="btn btn-info" title="Visit Page" href="<?php echo e(url('stylist/'.$info->slug), false); ?>" target="_blank"><i class="fa-solid fa-eye fa"></i></a>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            
                                        <?php endif; ?>

                                        
		       
	        </tbody>
	      </table>
	      <td colspan="6">
                                                <?php echo e($list->links(), false); ?>

                                            </td>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/stylist_form/manage.blade.php ENDPATH**/ ?>