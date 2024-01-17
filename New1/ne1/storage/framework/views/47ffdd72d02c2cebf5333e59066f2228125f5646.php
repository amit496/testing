<?php
$geoip = geoip(get_visitor_IP());
$shipping_country = $business_areas->where('iso_code', $geoip->iso_code)->first();
$shipping_state = \DB::table('states')
    ->select('id', 'name', 'iso_code')
    ->where([['country_id', '=', $shipping_country->id], ['iso_code', '=', $geoip->state]])
    ->first();

$shipping_zone = get_shipping_zone_of($item->shop_id, $shipping_country->id, optional($shipping_state)->id);
$shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';
?>

<section>
  <div class="container mb-3">
    <div class="row sc-product-item" id="single-product-wrapper">
      <div class="col-md-5 col-sm-12">
        <?php echo $__env->make('theme::layouts.jqzoom', ['item' => $item, 'variants' => $variants], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div> <!-- /.col-md-5 col-sm-12 -->

      <div class="col-md-7 col-sm-12">
        <div class="row mb-4">
          <div class="col-md-7 col-sm-12 nopadding">
            <div class="product-single">
              <?php echo $__env->make('theme::layouts.product_info', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <div class="product-info-options my-4">
                <div class="select-box-wrapper">
                  <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row product-attribute">
                      <div class="col-sm-3 col-4">
                        <span class="info-label" id="attr-<?php echo e(Str::slug($attribute->name), false); ?>"><?php echo e($attribute->name, false); ?>:</span>
                      </div>
                      <div class="col-sm-9 col-8 nopadding-left">
                        <select class="product-attribute-selector <?php echo e($attribute->css_classes, false); ?>" id="attribute-<?php echo e($attribute->id, false); ?>" required="required">
                          <?php $__currentLoopData = $attribute->attributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($option->id, false); ?>" data-color="<?php echo e($option->color ?? $option->value, false); ?>" <?php echo e(in_array($option->id, $item_attrs) ? 'selected' : '', false); ?>><?php echo e($option->value, false); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block with-errors"></div>
                      </div><!-- /.col-sm-9 .col-6 -->
                    </div><!-- /.row -->
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div><!-- /.row .select-box-wrapper -->

                <div class="sep"></div>

                <div id="calculation-section">
                  <div class="row">
                    <div class="col-3">
                      <span class="info-label" data-options="<?php echo e($shipping_options, false); ?>" id="shipping-options"><?php echo app('translator')->get('theme.shipping'); ?>:</span>
                      <?php echo e(Form::hidden('shipping_zone_id', isset($shipping_zone->id) ? $shipping_zone->id : null, ['id' => 'shipping-zone-id']), false); ?>

                      <?php echo e(Form::hidden('shipping_rate_id', null, ['id' => 'shipping-rate-id']), false); ?>

                      <?php echo e(Form::hidden('shipto_country_id', $shipping_country->id, ['id' => 'shipto-country-id']), false); ?>

                      <?php echo e(Form::hidden('shipto_state_id', optional($shipping_state)->id, ['id' => 'shipto-state-id']), false); ?>

                    </div>

                    <div class="col-9 nopadding-left">
                      <span id="summary-shipping-cost" data-value="0"></span>
                      <div id="product-info-shipping-detail">
                        <span><?php echo e(strtolower(trans('theme.to')), false); ?>


                          <a id="shipTo" class="ship_to" data-country="<?php echo e($shipping_country->id, false); ?>" data-state="<?php echo e(optional($shipping_state)->id, false); ?>" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('theme.change_shipping_location'), false); ?>">
                            <?php echo e($shipping_state ? $shipping_state->name : $geoip->country, false); ?>

                          </a>

                          
                          <select id="width_tmp_select">
                            <option id="width_tmp_option"></option>
                          </select>
                        </span>

                        <span class="dynamic-shipping-rates" data-toggle="popover" title="<?php echo e(trans('theme.shipping_options'), false); ?>">
                          <span id="summary-shipping-carrier"></span>
                          <small class="ml-1 text-primary"><i class="fas fa-caret-circle-down"></i></small>
                        </span>
                      </div>
                      <small class="text-muted" id="delivery-time"></small>
                    </div><!-- /.col-sm-9 .col-6 -->
                  </div><!-- /.row -->

                  <div class="row">
                    <div class="col-3">
                      <span class="info-label qtt-label"><?php echo app('translator')->get('theme.quantity'); ?>:</span>
                    </div>
                    <div class="col-9 nopadding">
                      <div class="product-qty-wrapper">
                        <div class="product-info-qty-item">
                          <button class="product-info-qty product-info-qty-minus">-</button>
                          <input class="product-info-qty product-info-qty-input" data-name="product_quantity" data-min="<?php echo e($item->min_order_quantity, false); ?>" data-max="<?php echo e($item->stock_quantity, false); ?>" type="text" value="<?php echo e($item->min_order_quantity, false); ?>">
                          <button class="product-info-qty product-info-qty-plus">+</button>
                        </div>
                        <span class="available-qty-count"><?php echo app('translator')->get('theme.stock_count', ['count' => $item->stock_quantity]); ?></span>
                      </div>
                    </div><!-- /.col-sm-9 .col-6 -->
                  </div><!-- /.row -->

                  <div class="row" id="order-total-row">
                    <div class="col-3">
                      <span class="info-label"><?php echo app('translator')->get('theme.total'); ?>:</span>
                    </div>
                    <div class="col-9 nopadding">
                      <span id="summary-total" class="text-muted"><?php echo e(trans('theme.notify.will_calculated_on_select'), false); ?></span>
                    </div><!-- /.col-sm-9 .col-6 -->
                  </div><!-- /.row -->
                </div>
              </div><!-- /.product-option -->

              <div class="sep"></div>

              <a href="<?php echo e(route('direct.checkout', $item->slug), false); ?>" class="btn btn-warning btn-lg" id="buy-now-btn">
                <i class="fal fa-rocket-launch"></i> <?php echo app('translator')->get('theme.button.buy_now'); ?>
              </a>

              <a data-link="<?php echo e(route('cart.addItem', $item->slug), false); ?>" class="btn btn-lg add-to-card-now-btn sc-add-to-cart">
                <i class="fal fa-shopping-cart"></i> <?php echo app('translator')->get('theme.button.add_to_cart'); ?>
              </a>

              <?php if($item->product->inventories_count > 1): ?>
                <a href="<?php echo e(route('show.offers', $item->product->slug), false); ?>" class="d-none d-sm-inline-block btn btn-sm btn-link">
                  <?php echo app('translator')->get('theme.view_more_offers', ['count' => $item->product->inventories_count]); ?>
                </a>
              <?php endif; ?>
            </div><!-- /.product-single -->
          </div>

          <div class="col-md-5 col-sm-12">
            <div class="seller-info space20">
              <div class="text-muted small space10">
                <?php echo app('translator')->get('theme.sold_by'); ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#shopReviewsModal" class="btn-link pull-right">
                  <i class="far fa-store"></i> <?php echo e(trans('theme.button.quick_view'), false); ?>

                </a>
              </div>

              <img src="<?php echo e(get_storage_file_url(optional($item->shop->logoImage)->path, 'thumbnail'), false); ?>" class="seller-info-logo img-sm" alt="<?php echo e(trans('theme.logo'), false); ?>">

              <a href="<?php echo e(route('show.store', $item->shop->slug), false); ?>" class="seller-info-name">
                <?php echo $item->shop->getQualifiedName(); ?>

              </a>

              <div class="space10"></div>

              <?php echo $__env->make('theme::layouts.ratings', ['ratings' => $item->shop->ratings, 'count' => $item->shop->ratings_count, 'shop' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div><!-- /.seller-info -->

            

            

            

            <div class="clearfix space20"></div>

            <?php if($item->key_features): ?>
              <div>
                <div class="section-title">
                  <h4><?php echo trans('theme.section_headings.key_features'); ?></h4>
                </div>
                <ul class="key_feature_list" id="item_key_features">
                  <?php $__currentLoopData = unserialize($item->key_features); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo $key_feature; ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div><!-- /.row -->
      </div> <!-- /.col-md-7 col-sm-12 -->
    </div> <!-- /.row -->
  </div> <!-- /.container -->
</section>

<section id="item-desc-section mb-5">
  <div class="container">
    <div class="row">
      <?php if($linked_items->count()): ?>
        <div class="col-md-4 nopadding-right mb-3 pb-3">
          <div class="section-title">
            <h4 class="mb-4"><?php echo app('translator')->get('theme.section_headings.bought_together'); ?>:</h4>
          </div>
          <ul class="sidebar-product-list">
            <?php echo $__env->make('theme::partials._product_vertical', ['products' => $linked_items], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </ul>
        </div><!-- /.col-md-2 -->
      <?php endif; ?>

      <div class="col-md-<?php echo e($linked_items->count() ? '8' : '12', false); ?>" id="product_desc_section">
        <div role="tabpanel">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <a href="#desc_tab" aria-controls="desc_tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo app('translator')->get('theme.product_desc'); ?></a>
            </li>
            <li role="presentation">
              <a href="#seller_desc_tab" aria-controls="seller_desc_tab" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('theme.product_desc_seller'); ?></a>
            </li>
            <li role="presentation">
              <a href="#reviews_tab" aria-controls="reviews_tab" role="tab" data-toggle="tab" aria-expanded="false"><?php echo app('translator')->get('theme.customer_reviews'); ?></a>
            </li>
          </ul><!-- /.nav-tab -->

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="desc_tab">

              <?php echo $item->product->description; ?>


              

              <hr class="style4 muted my-4" />

              <h3 class="mb-3"><?php echo e(trans('theme.technical_details'), false); ?>: </h3>

              <table class="table table-striped noborder">
                <tbody>
                  <?php if($item->product->brand): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.brand'), false); ?>: </th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->brand, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->expiry_date): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('pharmacy::lang.expiry_date'), false); ?>: </th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->expiry_date, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->product->model_number): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.model_number'), false); ?>:</th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->model_number, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->product->gtin_type && $item->product->gtin): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e($item->product->gtin_type, false); ?>: </th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->gtin, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->product->mpn): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.mpn'), false); ?>: </th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->mpn, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->sku): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.sku'), false); ?>: </th>
                      <td class="noborder" id="item_sku" style="width: 65%;"><?php echo e($item->sku, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if(config('system_settings.show_item_conditions')): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.condition'), false); ?>: </th>
                      <td class="noborder" id="item_condition" style="width: 65%;">
                        <?php echo e($item->condition, false); ?>

                        <?php if($item->condition_note): ?>
                          <sup data-toggle="tooltip" data-placement="top" title="<?php echo $item->condition_note; ?>">
                            <i class="fas fa-question-circle" id="item_condition_note"></i>
                          </sup>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endif; ?>

                  <?php if(optional($item->product->manufacturer)->name): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.manufacturer'), false); ?>: </th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->manufacturer->name, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->product->origin): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.origin'), false); ?>: </th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->origin->name, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <tr class="noborder">
                    <th class="text-right noborder"><?php echo e(trans('theme.availability'), false); ?>: </th>
                    <td class="noborder" style="width: 65%;"><?php echo e($item->availability, false); ?></td>
                  </tr>

                  <?php if($item->min_order_quantity): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.min_order_quantity'), false); ?>: </th>
                      <td class="noborder" id="item_min_order_qtt" style="width: 65%;"><?php echo e($item->min_order_quantity, false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->shipping_weight): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.shipping_weight'), false); ?>: </th>
                      <td class="noborder" id="item_shipping_weight" style="width: 65%;"><?php echo e($item->shipping_weight . ' ' . config('system_settings.weight_unit'), false); ?></td>
                    </tr>
                  <?php endif; ?>

                  <?php if($item->product->created_at): ?>
                    <tr class="noborder">
                      <th class="text-right noborder"><?php echo e(trans('theme.first_listed_on', ['platform' => get_platform_title()]), false); ?>:</th>
                      <td class="noborder" style="width: 65%;"><?php echo e($item->product->created_at->toFormattedDateString(), false); ?></td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="seller_desc_tab">
              <div id="seller_seller_desc">
                <?php echo $item->description; ?>

              </div>

              <?php if($item->shop->config->show_shop_desc_with_listing): ?>
                <?php if($item->description): ?>
                  <br /><br />
                  <hr class="style4 muted" />
                <?php endif; ?>
                <br />
                <h4><?php echo e(trans('theme.seller_info'), false); ?>: </h4>
                <?php echo $item->shop->description; ?>

              <?php endif; ?>

              <?php if($item->shop->config->show_refund_policy_with_listing && $item->shop->config->return_refund): ?>
                <br /><br />
                <hr class="style4 muted" /><br />

                <h4 class="mb-4"><?php echo e(trans('theme.return_and_refund_policy'), false); ?>: </h4>
                <?php echo $item->shop->config->return_refund; ?>

              <?php endif; ?>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="reviews_tab">
              <div class="reviews-tab">
                <?php $__empty_1 = true; $__currentLoopData = $item->latestFeedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <p>
                    <b><?php echo e(optional($feedback->customer)->getName(), false); ?></b>

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
                  <p class="lead text-center text-muted my-4"><?php echo app('translator')->get('theme.no_reviews'); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div><!-- /.tab-content -->
        </div><!-- /.tabpanel -->
      </div><!-- /.col-md-9 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/contents/product_page.blade.php ENDPATH**/ ?>