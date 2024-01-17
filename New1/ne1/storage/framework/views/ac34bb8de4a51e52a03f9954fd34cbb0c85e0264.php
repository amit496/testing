<section>
  <div class="top-rated">
    <div class="container">
      <div class="top-rated__inner">
        <div class="top-rated__header">
          <div class="sell-header sell-header--bold">
            <div class="sell-header__title">
              <h2><?php echo e(trans('theme.additional_item'), false); ?></h2>
            </div>
            <div class="header-line">
              <span></span>
            </div>
            <div class="best-deal__arrow">
              <ul>
                <li><button class="left-arrow slider-arrow slick-arrow top-rated-left"><i class="fal fa-chevron-left"></i></button></li>
                <li><button class="right-arrow slider-arrow slick-arrow top-rated-right"><i class="fal fa-chevron-right"></i></button></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="top-rated__items">
          <div class="top-rated__items-inner">

            <?php echo $__env->make('theme::partials._product_horizontal', ['products' => $additional_items], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/additional_items.blade.php ENDPATH**/ ?>