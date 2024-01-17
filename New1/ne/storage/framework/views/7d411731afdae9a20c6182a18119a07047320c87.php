<?php if(config('analytics.tracking_id')): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(config('analytics.tracking_id'), false); ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '<?php echo e(config('analytics.tracking_id'), false); ?>');
  </script>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/analytic_script.blade.php ENDPATH**/ ?>