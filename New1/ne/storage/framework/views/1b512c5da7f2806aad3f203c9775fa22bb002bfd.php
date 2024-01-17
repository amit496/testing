<ul class="list-group">
	<?php if($logger): ?>
		<?php
			$logChanges = [
				'current_billing_plan',
				'card_brand',
				'card_last_four',
			];
		?>

	    <?php $__empty_1 = true; $__currentLoopData = $logger->logs(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	      	<?php
	        	$changes = $activity->changes()->all();
	      	?>

	      	<?php if(empty($changes)) continue; ?>

	        <?php if(strtolower($activity->description) == 'updated'): ?>
	          	<?php $__currentLoopData = $changes['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrbute => $new_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	          		<?php if(! in_array($attrbute, $logChanges)) continue; ?>

			      	<li class="list-group-item">
			      		<i class="fa fa-arrow-circle-o-right"></i>
			      		<span class="indent10">
			                <?php echo get_activity_str($logger, $attrbute, $new_value, $changes['old'][$attrbute]); ?>

			      		</span>

			        	<span class="pull-right"><?php echo e($activity->created_at->diffForHumans() . ' ' . trans('app.by') . ' ' . $activity->causer->getName(), false); ?></span>
			        </li>
	          	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	        <?php endif; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	    	<span class="indent5"><?php echo e(trans('messages.no_history_data'), false); ?></span>
	    <?php endif; ?>
    <?php else: ?>
    	<span class="indent5"><?php echo e(trans('messages.no_history_data'), false); ?></span>
	<?php endif; ?>
</ul><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/account/_activity_logs.blade.php ENDPATH**/ ?>