<section class="my-5">
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#description_tab" data-toggle="tab">
                <?php echo e(trans('theme.profile'), false); ?>

              </a></li>
            <?php if($shop->config->return_refund): ?>
              <li><a href="#refund_policy_tab" data-toggle="tab">
                  <?php echo e(trans('theme.return_and_refund_policy'), false); ?>

                </a></li>
            <?php endif; ?>
            <li><a href="#shop_reviews_tab" data-toggle="tab">
                <?php echo e(trans('theme.latest_reviews'), false); ?>

              </a></li>
            <li><a href="<?php echo e(route('shop.products', $shop->slug), false); ?>">
                <?php echo e(trans('theme.products'), false); ?>

              </a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="description_tab">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo e(get_avatar_src($shop->owner, 'avatar'), false); ?>" class="img-rounded" width="100%">
                </div>
                <div class="col-sm-9">
                  <span>
                    <i class="far fa-user mr-2 text-muted"></i> <?php echo $shop->owner->name; ?>

                  </span>
                  <br />
                  <span>
                    <i class="far fa-map-marker-alt mr-2 text-muted"></i> <?php echo $shop->address->toShortString(); ?>

                  </span>
                  <br />
                  <?php if($shop->config->support_phone): ?>
                    <span>
                      <i class="far fa-phone-square-alt mr-2 text-muted"></i> <?php echo $shop->config->support_phone; ?>

                    </span>
                    <br />
                  <?php endif; ?>
                  <?php if($shop->config->support_email): ?>
                    <span>
                      <i class="far fa-envelope mr-2 text-muted"></i> <?php echo $shop->config->support_email; ?>

                    </span>
                    <br />
                  <?php endif; ?>
                  <span>
                    <i class="far fa-shopping-cart mr-2 text-muted"></i> <?php echo e(trans('theme.items_sold'), false); ?> <?php echo e(\App\Helpers\Statistics::sold_items_count($shop->id), false); ?>

                  </span>
                  <br />
                  <p class="mt-2">
                    <i class="far fa-store mr-2 text-muted"></i> <?php echo $shop->description; ?>

                  </p>
                  <a href="<?php echo e(route('shop.products', $shop->slug), false); ?>" class="btn btn-primary my-3"><?php echo e(trans('theme.products'), false); ?> (<?php echo e($shop->inventories_count, false); ?>)</a>
                </div>
              </div> <!-- /.row -->
            </div> <!-- /.tab-pane -->

            <div class="tab-pane" id="refund_policy_tab">
              <?php echo $shop->config->return_refund; ?>

            </div> <!-- /.tab-pane -->

            <div class="tab-pane" id="shop_reviews_tab">
              <?php $__empty_1 = true; $__currentLoopData = $shop->feedbacks->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <p>
                  <b><?php echo e($feedback->customer->nice_name ?? $feedback->customer->name, false); ?></b>

                  <span class="pull-right small">
                    <b class="text-success"><?php echo app('translator')->get('theme.verified_purchase'); ?></b>
                    <span class="text-muted"> | <?php echo e($feedback->created_at->diffForHumans(), false); ?></span>
                  </span>
                </p>

                <p><?php echo e($feedback->comment, false); ?></p>

                <?php echo $__env->make('theme::layouts.ratings', ['ratings' => $feedback->rating], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if (! ($loop->last)): ?>
                  <div class="sep"></div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="space20"></div>
                <p class="lead text-center text-muted"><?php echo app('translator')->get('theme.no_reviews'); ?></p>
              <?php endif; ?>
            </div> <!-- /.tab-pane -->
          </div> <!-- /.tab-content -->
        </div> <!-- /.nav-tabs-custom -->
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/contents/shop_page.blade.php ENDPATH**/ ?>