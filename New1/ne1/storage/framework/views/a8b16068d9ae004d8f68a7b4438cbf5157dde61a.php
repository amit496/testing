<?php
$geoip = geoip(get_visitor_IP());
$geoip_country = $business_areas->where('iso_code', $geoip->iso_code)->first();

$shipping_country_id = $cart->ship_to_country_id ?? optional($geoip_country)->id;

if (!$cart->shipping_state_id) {
    $geoip_state = \DB::table('states')
        ->select('id', 'name', 'iso_code')
        ->where([['country_id', '=', $shipping_country_id], ['iso_code', '=', $geoip->state]])
        ->first();
}

$shipping_state_id = $cart->ship_to_state_id ?? optional($geoip_state)->id;

// $shipping_zone = get_shipping_zone_of($cart->shop_id, $shipping_country_id, $shipping_state_id);
// $shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';

$packaging_options = optional($cart->shop)->packagings;

$default_packaging =
    $cart->shippingPackage ??
    (optional($cart->shop->packagings)
        ->where('default', 1)
        ->first() ??
        $platformDefaultPackaging);
?>

<section>
  <div class="container">
    <?php if(Session::has('error')): ?>
      <div class="notice notice-danger notice-sm">
        <strong><?php echo e(trans('theme.error'), false); ?></strong> <?php echo e(Session::get('error'), false); ?>

      </div>
    <?php endif; ?>

    <div class="notice notice-warning notice-sm space20" id="checkout-notice" style="display: <?php echo e($cart->shipping_rate_id || $cart->is_free_shipping() ? 'none' : 'block', false); ?>;">
      <strong><?php echo e(trans('theme.warning'), false); ?></strong>
      <span id="checkout-notice-msg"><?php echo app('translator')->get('theme.notify.seller_doesnt_ship'); ?></span>
    </div>

    <?php echo Form::open(['route' => ['order.create', $cart], 'id' => 'formId' . $cart->id, 'name' => 'checkoutForm', 'files' => true, 'data-toggle' => 'validator', 'autocomplete' => 'off', 'novalidate']); ?>

    <div class="row shopping-cart-table-wrap space30" id="cartId<?php echo e($cart->id, false); ?>" data-cart="<?php echo e($cart->id, false); ?>">
      <div class="col-md-4 bg-light">
        <div class="seller-info my-3">
          <div class="text-muted small mb-3">
            
            
            <span><b><?php echo e(trans('theme.dappr_order'), false); ?></b></span>
          </div>

          

          
        </div><!-- /.seller-info -->

        <div class="input-group full-width space30">
          <span class="input-group-addon flat">
            <i class="fas fa-ticket"></i>
          </span>

          
          <input name="coupon" value="" id="coupon<?php echo e($cart->id, false); ?>" class="form-control flat" type="text" placeholder="<?php echo app('translator')->get('theme.placeholder.have_coupon_from_seller'); ?>">

          <span class="input-group-btn">
            <button class="btn btn-default flat apply_seller_coupon" type="button" data-cart="<?php echo e($cart->id, false); ?>" style="padding-left:40px;padding-right:40px;font-weight: 300;"><?php echo app('translator')->get('theme.button.apply'); ?></button>
          </span>
        </div><!-- /input-group -->

        <?php echo e(Form::hidden('cart_id', $cart->id, ['id' => 'checkout-id']), false); ?>

        <?php echo e(Form::hidden('cart_weight', $cart->shipping_weight, ['id' => 'cartWeight' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('free_shipping', $cart->is_free_shipping(), ['id' => 'freeShipping' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('shop_id', $cart->shop->id, ['id' => 'shop-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('tax_id', isset($shipping_zones[$cart->id]->i) ? $shipping_zones[$cart->id]->tax_id : null, ['id' => 'tax-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('taxrate', $cart->taxrate, ['id' => 'cart-taxrate' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('packaging_id', $cart->packaging_id ?? optional($default_packaging)->id, ['id' => 'packaging-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('shipping_zone_id', $cart->shipping_zone_id, ['id' => 'zone-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('shipping_rate_id', $cart->shipping_rate_id, ['id' => 'shipping-rate-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('ship_to_country_id', $cart->ship_to_country_id, ['id' => 'shipto-country-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('ship_to_state_id', $cart->ship_to_state_id, ['id' => 'shipto-state-id' . $cart->id]), false); ?>

        <?php echo e(Form::hidden('coupon_raw', json_encode($cart->coupon), ['id' => 'coupon-raw' . $cart->id]), false); ?>

        
        <?php echo e(Form::hidden('handling_cost',$cart->handling_cost > 0 ? $cart->handling_cost : optional($cart->shop->config)->order_handling_cost,['id' => 'handling-cost' . $cart->id]), false); ?>


        <h3 class="widget-title"><?php echo e(trans('theme.order_info'), false); ?></h3>
        <ul class="shopping-cart-summary ">
          <li>
            <span><?php echo e(trans('theme.item_count'), false); ?></span>
            <span><?php echo e($cart->inventories_count, false); ?></span>
          </li>

          
            
          <?php
          if($cart->total)
          {
            $gst_amount = number_format($cart->total - ($cart->total * 100)/(100 + config('app.gst_percentage')),2);
            $sub_total = $cart->total - $gst_amount + $cart->discount;
          }
        ?>

          <li>
            <span><?php echo e(trans('theme.subtotal'), false); ?></span>
            <span><?php echo e(get_currency_prefix(), false); ?>

              <span id="summary-total<?php echo e($cart->id, false); ?>" class="item-total<?php echo e($cart->id, false); ?>"><?php echo e(number_format($sub_total, 2, '.', ''), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

            </span>
          </li>
          <li>
            <span>
              <a class="dynamic-shipping-rates" data-toggle="popover" data-cart="<?php echo e($cart->id, false); ?>" data-options="<?php echo e($shipping_options[$cart->id], false); ?>" id="shipping-options<?php echo e($cart->id, false); ?>" title="<?php echo e(trans('theme.shipping'), false); ?>">
                <u><?php echo e(trans('theme.shipping'), false); ?></u>
              </a>
              <em id="summary-shipping-name<?php echo e($cart->id, false); ?>" class="small text-muted"></em>
            </span>

            <span><?php echo e(get_currency_prefix(), false); ?>

              <span id="summary-shipping<?php echo e($cart->id, false); ?>"><?php echo e(number_format($cart->get_shipping_cost(), 2, '.', ''), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

            </span>
          </li>

          <li id="discount-section-li<?php echo e($cart->id, false); ?>" style="display: <?php if($cart->discount > 0 ){ echo 'block !important' ; } else { echo 'none' ;}?>;">
            <span><?php echo e(trans('theme.company_contribution'), false); ?>

              
              <i><em id="summary-discount-name<?php echo e($cart->id, false); ?>" class="small text-muted">$<?php echo e($cart->coupon ? number_format($cart->discount, 0, '.', '') : number_format(0, 2, '.', ''), false); ?> off by company ($<?php echo e($cart->coupon ? number_format($cart->discount, 0, '.', '') : number_format(0, 2, '.', ''), false); ?>)</em></i>
            </span>
            
            <span><?php echo e(get_currency_prefix(), false); ?>

            <span id="summary-discount<?php echo e($cart->id, false); ?>"><?php echo e($cart->coupon ? number_format($cart->discount, 0, '.', '') : number_format(0, 2, '.', ''), false); ?></span>
            </span>
          </li>


          <li>
            <span>GST</span>
            <span><?php echo e(get_currency_prefix(), false); ?>

              <span id="summary-total<?php echo e($cart->id, false); ?>" class="item-total<?php echo e($cart->id, false); ?>"><?php echo e($gst_amount, false); ?></span><?php echo e(get_currency_suffix(), false); ?>

            </span>
          </li>
         

          

          

          

          <li id="tax-section-li<?php echo e($cart->id, false); ?>" style="display: <?php echo e($cart->taxes < 0 ? 'block' : 'none', false); ?>;">
            <span><?php echo e(trans('theme.taxes'), false); ?></span>

            <span><?php echo e(get_currency_prefix(), false); ?>

              <span id="summary-taxes<?php echo e($cart->id, false); ?>"><?php echo e(number_format($cart->taxes, 2, '.', ''), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

            </span>
          </li>

          <li>
            <span class="lead"><?php echo e(trans('theme.total'), false); ?></span>

            <span class="lead"><?php echo e(get_currency_prefix(), false); ?>

              <span id="summary-grand-total<?php echo e($cart->id, false); ?>total"><?php echo e(number_format($cart->total, 2, '.', ''), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

            </span>
          </li>
        </ul>

        <hr class="style1 muted" />
        <div class="clearfix"></div>

        <div class="text-center space20">
          <a class="btn btn-black flat" href="<?php echo e(route('cart.index'), false); ?>"><?php echo e(trans('theme.button.update_cart'), false); ?></a>
          <a class="btn btn-black flat" href="<?php echo e(url('/'), false); ?>"><?php echo e(trans('theme.button.continue_shopping'), false); ?></a>
        </div>
      </div> <!-- /.col-md-3 -->

      <div class="col-md-5">
        <h3 class="widget-title">
          
          <?php echo e(trans('theme.ship_to'), false); ?>

          
        </h3>

        <?php if(isset($customer)): ?>
          <div class="row customer-address-list">
            <?php
              $pre_select = null;
            ?>

            <?php $__currentLoopData = $customer->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $ship_to_this_address = null;
                
                // If any address not selected yet
                if ($pre_select == null) {
                    // Has onely address
                    if ($customer->addresses->count() == 1) {
                        $pre_select = 1;
                        $ship_to_this_address = true;
                    }
                    // Just created this address
                    elseif (Request::has('address')) {
                        if (Request::get('address') == $address->id) {
                            $pre_select = 1;
                            $ship_to_this_address = true;
                        }
                    }
                    // Zone selected at cart page
                    elseif ($cart->ship_to_country_id == $address->country_id && $cart->ship_to_state_id == $address->state_id) {
                        $pre_select = 1;
                        $ship_to_this_address = true;
                    }
                    // Customer's shipping address
                    elseif ($cart->ship_to == null && $address->address_type === 'Shipping') {
                        $pre_select = 1;
                        $ship_to_this_address = true;
                    }
                }
              ?>

              <div class="col-sm-12 col-md-6 nopadding-<?php echo e($loop->iteration % 2 == 1 ? 'right' : 'left', false); ?>">
                <div class="address-list-item <?php echo e($ship_to_this_address == true ? 'selected' : '', false); ?>">
                  <?php echo $address->toHtml('<br/>', false); ?>

                  <input type="radio" class="ship-to-address" name="ship_to" value="<?php echo e($address->id, false); ?>" <?php echo e($ship_to_this_address == true ? 'checked' : '', false); ?> data-country="<?php echo e($address->country_id, false); ?>" data-state="<?php echo e($address->state_id, false); ?>" required>
                </div>
              </div>

              <?php if($loop->iteration % 2 == 0): ?>
                <div class="clearfix"></div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          
          

          <small id="ship-to-error-block" class="text-danger pull-right"></small>

          <div class="space20"></div>

          <div class="col-sm-12 space20">
            <a href="<?php echo e(route('my.address.create'), false); ?>" class="modalAction btn btn-default btn-sm flat pull-right">
              <i class="fas fa-address-card-o"></i> <?php echo app('translator')->get('theme.button.add_new_address'); ?>
            </a>
          </div>
        <?php else: ?>
          <?php echo $__env->make('partials.checkout_shiping_address', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <hr class="style4 muted" />

        <?php if(is_incevio_package_loaded('pharmacy')): ?>
          <?php echo $__env->make('pharmacy::checkout_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <div class="form-group">
          <?php echo Form::label('buyer_note', trans('theme.leave_message_to_dappr')); ?>

          <?php echo Form::textarea('buyer_note', null, ['class' => 'form-control flat summernote-without-toolbar', 'placeholder' => trans('theme.placeholder.message_to_seller'), 'rows' => '2', 'maxlength' => '250']); ?>

          <div class="help-block with-errors"></div>
        </div>
      </div> <!-- /.col-md-5 -->

      <div class="col-md-3">
        <?php echo $__env->make('partials.payment_options', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div> <!-- /.col-md-4 -->

      <!-- /.col-md-4 -->
    </div><!-- /.row -->
    <?php echo Form::close(); ?>

  </div>
</section>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/public/themes/default/views/contents/checkout_page.blade.php ENDPATH**/ ?>