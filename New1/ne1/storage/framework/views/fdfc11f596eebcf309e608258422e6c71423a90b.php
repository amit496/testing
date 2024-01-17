<style>
    #content-wrapper {
    min-height: 680px;
}
</style>
<?php
 $stylist_body_class = ' order_complete_place  ';
?>


<section>
    <div class="row">
        <div class="col-6 nopadding-right ">
            <?php

            $stylist_back_reveal_url = Session::get('stylist_back_reveal_url');
            if(isset($stylist_back_reveal_url) && $stylist_back_reveal_url != ''){

            echo '<a href="'.$stylist_back_reveal_url.'"
                class="btn Sbtn-black back_reveal_btn"><i class="fas fa-angle-left px-2"></i>'.trans('theme.button.stylist_back_to_reveal').'</a>';
            }

            ?>
        </div>
        <div class="col-6 nopadding-left text-right">
            <?php if(is_incevio_package_loaded('checkout')): ?>
            <?php echo $__env->make('checkout::_checkout_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <?php if($carts->count() > 0): ?>
        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $cart_total = 0;
        $packaging_options = optional($cart->shop)->packagings;

        if ($cart->shop) {
        $default_packaging =
        $cart->shippingPackage ??
        (optional($cart->shop->packagings)
        ->where('default', 1)
        ->first() ??
        $platformDefaultPackaging);
        } else {
        $default_packaging = $cart->shippingPackage ?? $platformDefaultPackaging;
        }
        ?>

        <div class="row shopping-cart-table-wrap mb-5 mt-3 <?php echo e($expressId == $cart->id ? 'selected' : '', false); ?>"
            id="cartId<?php echo e($cart->id, false); ?>" data-cart="<?php echo e($cart->id, false); ?>">
            <div class="col-md-9">
                <?php echo Form::model($cart, ['method' => 'PUT', 'route' => ['cart.checkout', $cart->id], 'id' => 'formId' .
                $cart->id]); ?>

                <?php echo e(Form::hidden('cart_id', $cart->id, ['id' => 'cart-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('shop_id', $cart->shop->id, ['id' => 'shop-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('tax_id', isset($shipping_zones[$cart->id]->id) ? $shipping_zones[$cart->id]->tax_id :
                null, ['id' => 'tax-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('taxrate', null, ['id' => 'cart-taxrate' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('packaging_id', $default_packaging ? $default_packaging->id : null, ['id' =>
                'packaging-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('ship_to', $cart->ship_to, ['id' => 'ship-to' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('shipping_zone_id',isset($shipping_zones[$cart->id]->id) ?
                $shipping_zones[$cart->id]->id : null,['id' => 'zone-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('shipping_rate_id', $cart->shipping_rate_id, ['id' => 'shipping-rate-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('ship_to_country_id', $cart->ship_to_country_id, ['id' => 'shipto-country-id' .
                $cart->id]), false); ?>

                <?php echo e(Form::hidden('ship_to_state_id', $cart->ship_to_state_id, ['id' => 'shipto-state-id' . $cart->id]), false); ?>

                <?php echo e(Form::hidden('coupon_raw', json_encode($cart->coupon), ['id' => 'coupon-raw' . $cart->id]), false); ?>

                
                <?php echo e(Form::hidden('handling_cost', optional($cart->shop->config)->order_handling_cost, ['id' =>
                'handling-cost' . $cart->id]), false); ?>


                <div class="shopping-cart-header-section">
                    <div class="row">
                        <div class="col-6">
                            <span><?php echo app('translator')->get('theme.store'); ?>:</span>
                            <?php if($cart->shop->slug): ?>
                            <a href="<?php echo e(route('show.store', $cart->shop->slug), false); ?>"> <?php echo e($cart->shop->name, false); ?></a>
                            <?php else: ?>
                            <?php echo app('translator')->get('theme.store_not_available'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <span class="pull-right">
                                <?php echo app('translator')->get('theme.ship_to'); ?>:
                                <a href="javascript:void(0)" id="shipTo<?php echo e($cart->id, false); ?>" class="ship_to"
                                    data-cart="<?php echo e($cart->id, false); ?>" data-country="<?php echo e($cart->ship_to_country_id, false); ?>"
                                    data-state="<?php echo e($cart->ship_to_state_id, false); ?>">
                                    <?php echo e($cart->ship_to_state_id ? $cart->state->name : $cart->country->name, false); ?>

                                </a>
                            </span>
                        </div>
                    </div>
                </div>

                <table class="table table shopping-cart-item-table" id="table<?php echo e($cart->id, false); ?>">
                    <thead>
                        <tr>
                            <th width="65px">Item</th>
                            <th width="52%" class="hidden-sm hidden-xs"><?php echo e(trans('theme.description'), false); ?></th>
                            <th><?php echo e(trans('theme.price'), false); ?></th>
                            <th><?php echo e(trans('theme.quantity'), false); ?></th>
                            <th><?php echo e(trans('theme.total'), false); ?></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $cart->inventories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $unit_price = $item->current_sale_price();
                        $item_total = $unit_price * $item->pivot->quantity;
                        $cart_total += $item_total;
                       
                        ?>

                        <tr class="cart-item-tr">
                            <td>
                                <input type="hidden" class="freeShipping<?php echo e($cart->id, false); ?>"
                                    value="<?php echo e($item->free_shipping, false); ?>">

                                <input type="hidden" id="unitWeight<?php echo e($item->id, false); ?>"
                                    value="<?php echo e($item->shipping_weight, false); ?>">

                                <?php echo e(Form::hidden('shipping_weight[' . $item->id . ']', $item->shipping_weight *
                                $item->pivot->quantity, ['id' => 'itemWeight' . $item->id,'class' => 'itemWeight' .
                                $cart->id]), false); ?>


                                <img src="<?php echo e(get_product_img_src($item, 'mini'), false); ?>" class="img-mini"
                                    alt="<?php echo e($item->slug, false); ?>" title="<?php echo e($item->slug, false); ?>" />
                            </td>

                            <td class="hidden-sm hidden-xs">
                                <div class="shopping-cart-item-title">
                                    <a href="<?php echo e(route('show.product', $item->slug), false); ?>" class="product-info-title">
                                        <?php echo e(str_replace(',', ' - ',$item->pivot->item_description), false); ?>

                                    </a>
                                </div>
                            </td>

                            <td class="shopping-cart-item-price">
                                <span>
                                    <?php echo e(get_currency_prefix(), false); ?>

                                    <span id="item-price<?php echo e($cart->id . '-' . $item->id, false); ?>"
                                        data-value="<?php echo e($unit_price, false); ?>">
                                        <?php echo e(number_format($unit_price, 2, '.', ''), false); ?>

                                    </span>
                                    <?php echo e(get_currency_suffix(), false); ?>

                                </span>
                            </td>

                            <td>
                                <div class="product-info-qty-item"
                                    style="border:none; pointer-events: none; outline:none;">
                                    

                                    <input name="quantity[<?php echo e($item->id, false); ?>]" id="itemQtt<?php echo e($item->id, false); ?>"
                                        class="product-info-qty product-info-qty-input" data-cart="<?php echo e($cart->id, false); ?>"
                                        data-item="<?php echo e($item->id, false); ?>" data-min="<?php echo e($item->min_order_quantity, false); ?>"
                                        data-max="<?php echo e($item->stock_quantity, false); ?>" type="text"
                                        value="<?php echo e($item->pivot->quantity, false); ?>" readonly
                                        style="border:none; pointer-events: none; outline:none;">

                                    
                                </div>
                            </td>

                            <td>
                                <span>
                                    <?php echo e(get_currency_prefix(), false); ?>

                                    <span id="item-total<?php echo e($cart->id . '-' . $item->id, false); ?>"
                                        class="item-total<?php echo e($cart->id, false); ?>">
                                        <?php echo e(number_format($item_total, 2, '.', ''), false); ?>

                                    </span>
                                    <?php echo e(get_currency_suffix(), false); ?>

                                </span>
                            </td>

                            <td>
                                <a href="javascript:void(0)" class="cart-item-remove" data-cart="<?php echo e($cart->id, false); ?>"
                                    data-item="<?php echo e($item->id, false); ?>" data-toggle="tooltip"
                                    title="<?php echo app('translator')->get('theme.remove_item'); ?>">&times;</a>
                            </td>
                        </tr> <!-- /.order-body -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <td colspan="6">
                            <div class="input-group full-width">
                                <span class="input-group-addon flat">
                                <i class="fa fa-ticket"></i>
                                </span>
                                
                                
                                <input name="coupon" value="" id="coupon<?php echo e($cart->id, false); ?>" class="form-control flat" type="text" placeholder="<?php echo app('translator')->get('theme.placeholder.have_coupon_from_seller'); ?>" readonly>
        
                                <span class="input-group-btn">
                                <button class="btn btn-default flat apply_seller_coupon" type="button" data-cart="<?php echo e($cart->id, false); ?>"><?php echo app('translator')->get('theme.button.apply'); ?></button>
                                </span>
                            </div><!-- /input-group -->
                            </td>
                        </tr>
                        </tfoot>

                       
                </table>
                <?php echo Form::close(); ?>


                <div class="notice notice-warning notice-sm hidden" id="shipping-notice<?php echo e($cart->id, false); ?>">
                    <strong><?php echo e(trans('theme.warning'), false); ?></strong> <?php echo app('translator')->get('theme.notify.seller_doesnt_ship'); ?>
                </div>

                <div class="notice notice-danger notice-sm hidden" id="store-unavailable-notice<?php echo e($cart->id, false); ?>">
                    <strong><?php echo e(trans('theme.warning'), false); ?></strong> <?php echo app('translator')->get('theme.notify.store_not_available'); ?>
                </div>
            </div><!-- /.col-md-9 -->

            <div class="col-md-3 space20">
                <div class="side-widget" id="cart-summary<?php echo e($cart->id, false); ?>">
                    <h3 class="side-widget-title">
                        <span><?php echo e(trans('theme.cart_summary'), false); ?></span>
                    </h3>
                    <?php
                        // echo $cart_total;
                        // $gst_amount = number_format($cart_total - ($cart_total * 100)/(100 + config('app.gst_percentage')),2);
                        // $sub_total = $cart_total - $gst_amount;
                        // if($cart->discount > 0){
                        //     $gst_amount = number_format((($sub_total-$cart->discount)*10)/100,2);
                        //     $contribution_amount =  $sub_total - $cart->discount + $gst_amount;
                        // }else{
                        //     $contribution_amount =  $cart_total - $cart->discount;
                        // }
                       
                            // new calculation \
                            // $sub_total = '';
                            
                        $sub_total_1 = $cart_total - $cart->discount;
                        // $gst_amount = number_format($sub_total_1 - ($sub_total_1 * 100)/(100 + config('app.gst_percentage')),2);
                        $gst_amount = number_format($sub_total_1 - ($sub_total_1 * 100)/(100 + config('app.gst_percentage')),2);
                        $sub_total_2 = $sub_total_1 - $gst_amount;
                        $order_total =  $sub_total_1;
                    ?>
                    <ul class="shopping-cart-summary">
                        <li>
                            <span><?php echo e(trans('theme.total_amount'), false); ?></span>
                            <span>
                                <?php echo e(get_currency_prefix(), false); ?>

                                <span id="summary-total<?php echo e($cart->id, false); ?>">
                                    <?php echo e(number_format($cart_total, 2, '.', ''), false); ?>

                                </span>
                                <?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        </li>

                        <li id="discount-section-li<?php echo e($cart->id, false); ?>">
                            <span><?php echo e(trans('theme.company_contribution'), false); ?>

                                
                            </span>
                            <span><?php echo e(get_currency_prefix(), false); ?>

                            <span id="summary-discount<?php echo e($cart->id, false); ?>"><?php echo e($cart->coupon ?
                                    number_format($cart->discount, 2) : number_format(0, 2,), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        </li>


                        <li>
                            <span><?php echo e(trans('theme.subtotal'), false); ?></span>
                            <span>
                                <?php echo e(get_currency_prefix(), false); ?>

                                <span id="summary-total<?php echo e($cart->id, false); ?>">
                                    <?php echo e(number_format($sub_total_2, 2, '.', ''), false); ?>

                                </span>
                                <?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        </li>

                        <li>
                            <span>GST</span>
                            <span><?php echo e(get_currency_prefix(), false); ?>

                                <span id="gst_amount<?php echo e($cart->id, false); ?>"><?php echo e($gst_amount, false); ?></span><?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        </li>

                        <li>
                            <span>
                                <a class="dynamic-shipping-rates" href="javascript:void(0)" data-toggle="popover"
                                    data-cart="<?php echo e($cart->id, false); ?>" data-options="<?php echo e($shipping_options[$cart->id], false); ?>"
                                    id="shipping-options<?php echo e($cart->id, false); ?>" title="<?php echo e(trans('theme.shipping'), false); ?>">
                                    <u><?php echo e(trans('theme.shipping'), false); ?></u>
                                </a>
                                
                            </span>
                            <span>
                                
                                
                                Free 
                            </span>
                        </li>

                        

                        
                        

                        <li id="tax-section-li<?php echo e($cart->id, false); ?>" style="display: none;">
                            <span><?php echo e(trans('theme.taxes'), false); ?></span>
                            <span><?php echo e(get_currency_prefix(), false); ?>

                                <span id="summary-taxes<?php echo e($cart->id, false); ?>"><?php echo e(number_format(0, 2, '.', ''), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        </li>

                        
                        <li>
                            <span><?php echo e(trans('theme.order_total'), false); ?></span>
                            <span><?php echo e(get_currency_prefix(), false); ?>

                                <span id="summary-grand-total<?php echo e($cart->id, false); ?>total"><?php echo e(number_format($order_total, 2), false); ?></span><?php echo e(get_currency_suffix(), false); ?>

                            </span>
                        </li>
                    </ul>
                </div>

                <?php if(allow_checkout()): ?>
                <button type="submit" form="formId<?php echo e($cart->id, false); ?>" id="checkout-btn<?php echo e($cart->id, false); ?>"
                    class="btn btn-primary btn-sm flat pull-right" style="background: #6DBCD4">
                    <i class="fa fa-shopping-cart"></i> <?php echo e(trans('theme.button.buy_from_this_seller'), false); ?>

                </button>
                <?php else: ?>
                <a href="#nav-login-dialog" data-toggle="modal" data-target="#loginModal"
                    class="btn btn-primary btn-sm flat pull-right">
                    <i class="fa fa-shopping-cart"></i> <?php echo e(trans('theme.button.buy_from_this_seller'), false); ?>

                </a>
                <?php endif; ?>
            </div> <!-- /.col-md-3 -->
        </div> <!-- /.row -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row">
            <div class="col-6 nopadding-right ">
                <!--a href="<?php echo e(url('/'), false); ?>" class="btn btn-black flat"><?php echo e(trans('theme.button.continue_shopping'), false); ?></a-->
                <?php

                // $stylist_back_reveal_url = Session::get('stylist_back_reveal_url');
                // if(isset($stylist_back_reveal_url) && $stylist_back_reveal_url != ''){

                // echo '<a href="'.$stylist_back_reveal_url.'"
                //     class="btn btn-black flat">'.trans('theme.button.stylist_back_to_reveal').'</a>';
                // }

                ?>
            </div>
            <div class="col-6 nopadding-left text-right">
                <?php if(is_incevio_package_loaded('checkout')): ?>
                <?php echo $__env->make('checkout::_checkout_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
        <div class="row">
            <div class="col-12">
                <p class="lead text-center my-5">
                    <?php echo e(trans('theme.empty_cart'), false); ?><br /><br />
                    
                </p>
            </div>
        </div>
        <?php endif; ?>
        
    </div> <!-- /.container -->
</section>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/contents/cart_page.blade.php ENDPATH**/ ?>