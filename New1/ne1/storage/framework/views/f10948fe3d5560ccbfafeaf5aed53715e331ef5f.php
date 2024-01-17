<section class="space40">
  <div class="product-type">
    <div class="container">
      <div class="product-type__inner">
        <div class="row">
          <div class="col-lg-4">
            <div class="product-type__col">
              <div class="product-type__col-header">
                <div class="sell-header">
                  <div class="sell-header__title">
                    <h2><?php echo trans('theme.today_popular'); ?></h2>
                  </div>
                  <div class="header-line">
                    <span></span>
                  </div>
                </div>
              </div>
              <div class="product-type__col-product">

                <?php echo $__env->make('theme::partials._product_vertical', ['products' => $daily_popular ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="product-type__col">
              <div class="product-type__col-header">
                <div class="sell-header">
                  <div class="sell-header__title">
                    <h2><?php echo trans('theme.weekly_popular'); ?></h2>
                  </div>
                  <div class="header-line">
                    <span></span>
                  </div>
                </div>
              </div>
              <div class="product-type__col-product">
                <?php echo $__env->make('theme::partials._product_vertical', ['products' => $weekly_popular], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="product-type__col">
              <div class="product-type__col-header">
                <div class="sell-header">
                  <div class="sell-header__title">
                    <h2><?php echo trans('theme.monthly_popular'); ?></h2>
                  </div>
                  <div class="header-line">
                    <span></span>
                  </div>
                </div>
              </div>
              <div class="product-type__col-product">
                <?php echo $__env->make('theme::partials._product_vertical', ['products' => $monthly_popular], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/popular.blade.php ENDPATH**/ ?>