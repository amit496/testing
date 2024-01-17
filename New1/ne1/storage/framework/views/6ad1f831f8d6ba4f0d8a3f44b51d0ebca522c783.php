<?php
    $stylist_body_class = ' order_complete_place  ';
?>

<style>
    .rb-text-box {
        position: absolute;
        left: 35%;
        top: 30%;
        transform: translate(-35%, -30%);
    }

    .sending_message {
        margin-top: 5%;
        text-align: left;
    }


    .header {
        display: none;
    }

    .back_btn_md a {
        text-decoration: none;
        color: #212121;
        font-weight: 600;
        /* display: block; */
    }
    .order_details_button a {
        text-decoration: none;
        color: #212121;
        font-weight: 600;
        display: block;
    }
    
    .thank_you_order_btns{
        display:flex;
        
    }
    .thank_you_order_btns .btn{
        width:250px;
    }
    @media  only screen and (max-width:991px) {
          .thank_you_order_btns{
            display:block;
            padding:0 20px;
            text-align: center;
            margin: auto;
        
        }
        .thank_you_order_btns .btn{
                text-align: center;
                width:80%;
                 margin-top: 20px !important;
        }
    .thank_you_order .rb-text-box {
        position: relative;
        left: inherit;
        top: inherit;
        transform: inherit;
        margin-bottom: 20px;
    }
    .thank_you_order_text{
        order:2;
        
    }
    .sending_message {
        margin-top: 0%;

    }
 
}
</style>




















<!-- <a class="btn btn-default flat  order_details_button" style="width: 225px;
                                


                    
                    <a class="btn btn-default flat  order_details_button" style="width: 225px;
                        
                    
                </p>
                </div>
            </div>

            <div class="col-md-6 p-0">
                <div class="rb-bg-img">
                    
                </div>
            </div>
        </div><!-- /.row -->






<section>
    <div class="container-fluid">
        <div class="row thank_you_order" >
            <div class="col-lg-6 pt-5 thank_you_order_text">
                <div class="rb-text-box">
                    <p class="lead sending_message"><b>Thank you for your order. </b></p>
                    <p class="lead sending_message">We'll get packing and get your order to you as soon as possible!</p>
                    <?php
                        $payment_instructions = null;
                        if (optional($order->paymentMethod)->type == \App\Models\PaymentMethod::TYPE_MANUAL) {
                            if (vendor_get_paid_directly()) {
                                $payment_method = $order->shop->config->manualPaymentMethods->where('id', $order->payment_method_id)->first();
                        
                                $payment_instructions = optional($payment_method)->pivot->payment_instructions;
                            } else {
                                $payment_instructions = get_from_option_table('wallet_payment_info_' . $order->paymentMethod->code);
                            }
                        }
                    ?>

                    
                    <p class="lead d-block space50 order_complete_button_section">
                        
                      
                       <div class="link thank_you_order_btns">
                        <?php if(\Auth::guard('customer')->check()): ?>
                        <a class="btn btn-default flat  order_details_button" style="" href="<?php echo e(route('order.detail', $order), false); ?>">VIEW ORDER</a>
                    <?php endif; ?>
                    <a class="btn btn-default flat  order_details_button" style="" href="<?php echo e(url('stylist/customer/info'), false); ?>">DASHBOARD</a>
                       </div>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="rb-bg-img">
                    <img src="<?php echo e(asset('images/stylist/questions/section/2121222.jpg'), false); ?>" width="100%">
                </div>
            </div>
        </div><!-- /.row -->
        
    </div> <!-- /.container -->
</section>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/contents/order_complete.blade.php ENDPATH**/ ?>