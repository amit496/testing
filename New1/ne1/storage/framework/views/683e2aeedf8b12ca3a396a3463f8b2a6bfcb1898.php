<?php if($deal_of_the_day): ?>
  <section>
    <div class="best-deal">
      <div class="container">
        <div class="best-deal__inner">
          <div class="row">
            <div class="col-lg-<?php echo e($featured_items ? '8' : '12', false); ?>">
              <div class="best-deal__col">
                <div class="best-deal__header">
                  <div class="sell-header">
                    <div class="sell-header__title">
                      <h2><?php echo e(trans('theme.deal_of_the_day'), false); ?></h2>
                    </div>
                    <div class="header-line">
                      <span></span>
                    </div>
                  </div>
                </div>

                <div class="week-deal">
                  <div class="week-deal__label"><?php echo e(trans('theme.hot'), false); ?></div>
                  <div class="week-deal__inner">
                    <div class="week-deal__slider deal-slider">
                      <?php $__currentLoopData = $deal_of_the_day->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="week-deal__slider-item">
                          <img src="<?php echo e(get_storage_file_url($img->path, 'medium'), false); ?>" alt="<?php echo e($deal_of_the_day->title, false); ?>">
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="week-deal__details">
                      <div class="week-deal__details-name">
                        <a href="<?php echo e(route('show.product', $deal_of_the_day->slug), false); ?>"><?php echo strip_tags($deal_of_the_day->title); ?></a>
                      </div>

                      <div class="week-deal__details-price">
                        <p>
                          <span class="regular-price">
                            <?php echo get_formated_price($deal_of_the_day->current_sale_price(), config('system_settings.decimals', 2)); ?>

                          </span>

                          <?php if($deal_of_the_day->hasOffer()): ?>
                            <span class="old-price">
                              <?php echo get_formated_price($deal_of_the_day->sale_price, config('system_settings.decimals', 2)); ?>

                            </span>
                          <?php endif; ?>
                        </p>
                      </div>

                      <div class="best-seller__item-rating">
                        <?php echo $__env->make('theme::partials._vertical_ratings', ['ratings' => $deal_of_the_day->ratings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      </div>

                      <div class="week-deal__details-description">
                        <p><?php echo e(substr(strip_tags($deal_of_the_day->description), 0, 100), false); ?></p>
                      </div>

                      <div class="week-deal__details-list">
                        <ul>
                          <?php if($feature = unserialize($deal_of_the_day->key_features)): ?>
                            <?php for($i = 0; $i < 3; $i++): ?>
                              <li><i class="fal fa-check"></i> <span><?php echo e(!empty($feature[$i]) ? $feature[$i] : null, false); ?></span></li>
                            <?php endfor; ?>
                          <?php endif; ?>
                        </ul>
                      </div>

                      <div class="week-deal-btns mt-4">
                        <a href="javascript:void(0)" data-link="<?php echo e(route('cart.addItem', $deal_of_the_day->slug), false); ?>" class="sc-add-to-cart" tabindex="0">
                          <i class="fal fa-shopping-cart"></i>
                          <span class="d-none d-sm-inline-block"><?php echo e(trans('theme.add_to_cart'), false); ?></span>
                        </a>

                        <a href="javascript:void(0)" data-link="<?php echo e(route('wishlist.add', $deal_of_the_day), false); ?>" class="add-to-wishlist">
                          <i class="far fa-heart"></i> <?php echo e(trans('theme.button.add_to_wishlist'), false); ?>

                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- .col-lg-* -->

            <?php if($featured_items): ?>
              <div class="col-lg-4">
                <div class="best-deal__col">
                  <div class="best-deal__header">
                    <div class="sell-header">
                      <div class="sell-header__title">
                        <h2><?php echo e(trans('theme.featured'), false); ?></h2>
                      </div>
                      <div class="header-line">
                        <span></span>
                      </div>
                      <div class="best-deal__arrow">
                        <ul>
                          <li>
                            <button class="left-arrow slider-arrow best-seller-left">
                              <i class="fal fa-chevron-left"></i>
                            </button>
                          </li>
                          <li>
                            <button class="right-arrow slider-arrow best-seller-right">
                              <i class="fal fa-chevron-right"></i>
                            </button>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="best-seller">
                    <div class="best-seller__slider best-seller-slider">
                      <?php echo $__env->make('theme::partials._product_vertical', ['products' => $featured_items], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                  </div>
                </div>
              </div> <!-- .col-lg-4 -->
            <?php endif; ?>
          </div> <!-- .row -->
        </div>
      </div>
    </div> <!-- .best-deal -->
  </section>
<?php elseif($featured_items): ?>
  <section>
    <div class="neckbands">
      <div class="container">
        <div class="neckbands__inner">
          <div class="neckbands__header">
            <div class="sell-header sell-header--bold">
              <div class="sell-header__title">
                <h2><?php echo e(trans('theme.featured'), false); ?></h2>
              </div>
              <div class="header-line">
                <span></span>
              </div>
              <div class="best-deal__arrow">
                <ul>
                  <li><button class="left-arrow slider-arrow slick-arrow neckbands-left"><i class="fal fa-chevron-left"></i></button></li>
                  <li><button class="right-arrow slider-arrow slick-arrow neckbands-right"><i class="fal fa-chevron-right"></i></button></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="neckbands__items">
            <div class="neckbands__items-inner">
              <?php echo $__env->make('theme::partials._product_horizontal', ['products' => $featured_items], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/sections/deal_of_the_day.blade.php ENDPATH**/ ?>