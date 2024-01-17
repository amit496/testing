<ul class="list-group">
	<?php if($billable->stripe_id && $billable->invoices()): ?>
	    <?php $__currentLoopData = $billable->invoices(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    <table class="table">
		    	<thead>
			    	<tr>
			    		<th><?php echo e(trans('app.date'), false); ?></th>
			    		<th><?php echo e(trans('app.description'), false); ?></th>
			    		<th><?php echo e(trans('app.status'), false); ?></th>
			    		<th><?php echo e(trans('app.amount'), false); ?></th>
			    		<th>&nbsp;</th>
			    	</tr>
		    	</thead>
		    	<tbody>
	                <?php $__currentLoopData = $invoice->subscriptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    		<tr>
			    			
			    			<td><?php echo e(\Carbon\Carbon::createFromTimestamp($invoice->asStripeInvoice()->created)->toFormattedDateString(), false); ?></td>
			    			<td>
			    				<?php echo e(trans('app.invoice_for', ['start' => $subscription->startDateAsCarbon()->toFormattedDateString(), 'end' => $subscription->endDateAsCarbon()->toFormattedDateString()]), false); ?>

			    			</td>
			    			<td><?php echo e(trans('app.' . $invoice->status), false); ?></td>
			    			<td><?php echo e($invoice->total(), false); ?></td>
				            <td>
				            	<a href="<?php echo e(route('admin.account.subscription.invoice',$invoice->id), false); ?>"><i class="fa fa-cloud-download" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.download'), false); ?>"></i></a>
				            </td>
			    		</tr>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    	</tbody>
		    </table>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php else: ?>
    	<span class="indent5"><?php echo e(trans('app.no_invoice'), false); ?></span>
	<?php endif; ?>
</ul><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/account/_invoices.blade.php ENDPATH**/ ?>