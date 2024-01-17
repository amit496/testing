<?php $__env->startSection('content'); ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.promotions'), false); ?></h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-stripe">
        <thead>
          <tr>
            <th width="45%"><?php echo app('translator')->get('app.options'); ?></th>
            <th><?php echo app('translator')->get('app.values'); ?></th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.promotional_tagline'); ?></h4>
              <small class="text-muted">
                <?php echo e(trans('help.promotional_tagline'), false); ?>

              </small>
            </th>
            <td>
              <?php echo e(trans('app.form.text') . ' : ', false); ?><strong><?php echo e(empty($tagline['text']) ? '' : $tagline['text'], false); ?></strong>
              <br />
              <?php echo e(trans('app.action_url') . ' : ', false); ?><strong><?php echo e(!empty($tagline['action_url']) ? $tagline['action_url'] : '', false); ?></strong>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.tagline'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            </td>
          </tr>

          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.best_finds_under'); ?></h4>
              <small class="text-muted">
                <?php echo trans('help.best_finds_under'); ?>

              </small>
            </th>
            <td>
              <?php if (! (empty(get_from_option_table('best_finds_under', 99)))): ?>
                <strong>
                  <?php echo e(get_formated_currency(get_from_option_table('best_finds_under')), false); ?>

                </strong>
              <?php endif; ?>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.bestFindsUnder'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            </td>
          </tr>

          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.deal_of_the_day'); ?></h4>
              <small class="text-muted">
                <?php echo trans('help.deal_of_the_day'); ?>

              </small>
            </th>
            <td>
              <?php if($deal_of_the_day): ?>
                <span class="label label-outline"><?php echo e($deal_of_the_day->title . ' | ' . $deal_of_the_day->sku . ' | ' . get_formated_currency($deal_of_the_day->current_sale_price()), false); ?></span>
              <?php endif; ?>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.dealOfTheDay'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            </td>
          </tr>

          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.featured_categories'); ?></h4>
              <small class="text-muted">
                <?php echo trans('help.featured_categories'); ?>

              </small>
            </th>
            <td>
              <?php $__currentLoopData = $featured_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="label label-outline"><?php echo e($category, false); ?></span>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.featuredCategories.edit'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            </td>
          </tr>

          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.featured_items'); ?></h4>
              <small class="text-muted">
                <?php echo trans('help.featured_items'); ?>

              </small>
            </th>
            <td>
              <?php if($featured_items): ?>
                <?php $__currentLoopData = $featured_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span class="label label-outline"><?php echo $item->title . ' | ' . $item->sku . ' | ' . get_formated_currency($item->current_sale_price()); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.featuredItems.edit'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            </td>
          </tr>

          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.trending_now_categories'); ?></h4>
              <small class="text-muted">
                <?php echo trans('help.trending_now_categories'); ?>

              </small>
            </th>
            <td>
              <?php $__currentLoopData = $trending_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="label label-outline"><?php echo e($category, false); ?></span>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.promotion.trendingNow.edit'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>
            </td>
          </tr>

          <tr>
            <th>
              <h4><?php echo app('translator')->get('app.featured_brands'); ?></h4>
              <small class="text-muted">
                <?php echo trans('help.featured_brands'); ?>

              </small>
            </th>
            <td>
              <?php $__currentLoopData = $featured_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="label label-outline"><?php echo e($brand->name, false); ?></span>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td class="text-right">
              <a href="javascript:void(0)" data-link="<?php echo e(route('admin.featuredBrands.edit'), false); ?>" class="ajax-modal-btn btn btn-sm btn-link flat"><i class="fa fa-edit"></i> <?php echo app('translator')->get('app.edit'); ?></a>

              
            </td>
          </tr>
        </tbody>
      </table>
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/promotions/options.blade.php ENDPATH**/ ?>