<?php echo e($customer->nice_name, false); ?>

<?php if (! ($customer->active)): ?>
    <span class="label label-default indent10"><?php echo e(trans('app.inactive'), false); ?></span>
<?php endif; ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/partials/actions/customer/nice_name.blade.php ENDPATH**/ ?>