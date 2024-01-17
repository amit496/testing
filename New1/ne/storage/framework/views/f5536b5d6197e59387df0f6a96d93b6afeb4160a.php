<!-- Left side column. contains the logo and sidebar -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <?php if(Auth::user()->isMerchant()): ?>
            <ul class="sidebar-menu">
                <li class="treeview <?php echo e(Request::is('admin/stylist/post_dashboard') ? 'active' : '', false); ?>">
                    <a href="<?php echo e(url('admin/stylist/post_dashboard'), false); ?>">
                        <i class="fa-solid fa-signs-post"></i>
                        <span>&nbsp;&nbsp;DASHBOARD</span>
                    </a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/stylist/customer_request') ? 'active' : '', false); ?>">
                    <a href="<?php echo e(url('admin/stylist/customer_request'), false); ?>">
                        <i class="fa-solid fa-list"></i><span>&nbsp;&nbsp;&nbsp;CLIENTS</span>
                    </a>
                </li>

                <li class="treeview <?php echo e(Request::is('admin/stylist/booking_dates') ? 'active' : '', false); ?>">
                    <a href="<?php echo e(url('admin/stylist/booking_dates'), false); ?> "><i
                            class="fa fa-calendar"></i><span>&nbsp;SCHEDULE</span></a>
                </li>

                <li class="treeview <?php echo e(Request::is('admin/stylist/availability') ? 'active' : '', false); ?>">
                    <a href="<?php echo e(url('admin/stylist/availability'), false); ?>"><i class="fa fa-calendar-check"></i><span>&nbsp;MY
                            AVAILABILITY</span></a>
                </li>
                <li class="treeview <?php echo e(Request::is('admin/stock/inventory') ? 'active' : '', false); ?>">
                    <a href="<?php echo e(url('admin/stock/inventory'), false); ?>">
                        <i class="fa fa-cubes"></i>
                        <span>&nbsp;Inventory</span>
                    </a>
                </li>
            </ul>
        <?php else: ?>
            <ul class="sidebar-menu">
                <li class="<?php echo e(Request::is('admin/dashboard*') ? 'active' : '', false); ?>">
                    <a href="<?php echo e(url('admin/dashboard'), false); ?>">
                        <i class="fa fa-dashboard"></i> <span><?php echo e(trans('nav.dashboard'), false); ?></span>
                    </a>
                </li>

                <?php if(Gate::allows('index', \App\Models\Category::class) ||
                        Gate::allows('index', \App\Models\Attribute::class) ||
                        Gate::allows('index', \App\Models\Product::class) ||
                        Gate::allows('index', \App\Models\Manufacturer::class) ||
                        Gate::allows('index', \App\Models\CategoryGroup::class) ||
                        Gate::allows('index', \App\Models\CategorySubGroup::class)): ?>
                    <?php if(Auth::user()->isMerchant()): ?>
                    <?php else: ?>
                        <li class="treeview <?php echo e(Request::is('admin/catalog*') ? 'active' : '', false); ?>">
                            <a href="javascript:void(0)">
                                <i class="fa fa-tags"></i>
                                <span><?php echo e(trans('nav.catalog'), false); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php if(Gate::allows('index', \App\Models\Category::class) ||
                                        Gate::allows('index', \App\Models\CategoryGroup::class) ||
                                        Gate::allows('index', \App\Models\CategorySubGroup::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/catalog/category*') ? 'active' : '', false); ?>">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-angle-double-right"></i>
                                            <?php echo e(trans('nav.categories'), false); ?>

                                            <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\CategoryGroup::class)): ?>
                                                <li
                                                    class="<?php echo e(Request::is('admin/catalog/categoryGroup*') ? 'active' : '', false); ?>">
                                                    <a href="<?php echo e(route('admin.catalog.categoryGroup.index'), false); ?>">
                                                        <i class="fa fa-angle-right"></i><?php echo e(trans('nav.groups'), false); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\CategorySubGroup::class)): ?>
                                                <li
                                                    class="<?php echo e(Request::is('admin/catalog/categorySubGroup*') ? 'active' : '', false); ?>">
                                                    <a href="<?php echo e(route('admin.catalog.categorySubGroup.index'), false); ?>">
                                                        <i class="fa fa-angle-right"></i><?php echo e(trans('nav.sub-groups'), false); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Category::class)): ?>
                                                <li class="<?php echo e(Request::is('admin/catalog/category') ? 'active' : '', false); ?>">
                                                    <a href="<?php echo e(url('admin/catalog/category'), false); ?>">
                                                        <i class="fa fa-angle-right"></i><?php echo e(trans('nav.categories'), false); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Attribute::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/catalog/attribute*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/catalog/attribute'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.attributes'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Product::class)): ?>
                                    <?php if(!Auth::user()->isSuperAdmin()): ?>
                                        <!-- stylist edit -->
                                        <li class="<?php echo e(Request::is('admin/catalog/product*') ? 'active' : '', false); ?>">
                                            <a href="<?php echo e(url('admin/catalog/product'), false); ?>">
                                                <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.products'), false); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Manufacturer::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/catalog/manufacturer*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/catalog/manufacturer'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.manufacturers'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                
                <?php if(Gate::allows('index', \App\Models\Inventory::class) ||
                        Gate::allows('index', \App\Models\Warehouse::class) ||
                        Gate::allows('index', \App\Models\Supplier::class) ||
                        Auth::user()->isSuperAdmin()): ?>
                    <li class="treeview <?php echo e(Request::is('admin/stock*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-cubes"></i>
                            <span><?php echo e(trans('nav.stock'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(Gate::allows('index', \App\Models\Inventory::class) || Auth::user()->isSuperAdmin()): ?>
                                <li class="<?php echo e(Request::is('admin/stock/inventory*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/stock/inventory'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.inventories'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::allows('index', \App\Models\Warehouse::class) || Auth::user()->isSuperAdmin()): ?>
                                <li class="<?php echo e(Request::is('admin/stock/warehouse*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/stock/warehouse'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.warehouses'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::allows('index', \App\Models\Supplier::class) || Auth::user()->isSuperAdmin()): ?>
                                <li class="<?php echo e(Request::is('admin/stock/supplier*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/stock/supplier'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.suppliers'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(Gate::allows('index', \App\Models\Order::class) || Gate::allows('index', \App\Models\Cart::class)): ?>
                    <li class="treeview <?php echo e(Request::is('admin/order*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-cart-plus"></i>
                            <span><?php echo e(trans('nav.orders'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Order::class)): ?>
                                <li class="<?php echo e(Request::is('admin/order/order*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/order/order'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.orders'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Cart::class)): ?>
                                <li class="<?php echo e(Request::is('admin/order/cart*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/order/cart'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.carts'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cancelAny', \App\Models\Order::class)): ?>
                                <li class="<?php echo e(Request::is('admin/order/cancellation*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/order/cancellation'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.cancellations'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            
                            
                            
                        </ul>
                    </li>
                <?php endif; ?>

                <?php
                    $stf_show_extra_menu = 1;
                    if (Auth::user()->isMerchant()) {
                        $stf_show_extra_menu = 0;
                    }
                ?>

                <?php if(
                    ($stf_show_extra_menu && Gate::allows('index', \App\Models\User::class)) ||
                        Gate::allows('index', \App\Models\Customer::class)): ?>
                    <li
                        class="treeview <?php echo e(Request::is('admin/admin*') || Request::is('address/addresses/customer*') || Request::is('admin/inspector*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-user-secret"></i>
                            <span><?php echo e(trans('nav.admin'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\User::class)): ?>
                                <li class="<?php echo e(Request::is('admin/admin/user*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/admin/user'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.users'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isMerchant()): ?>
                                <li class="<?php echo e(Request::is('admin/admin/deliveryboys*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route('admin.admin.deliveryboy.index'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.delivery_boys'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Customer::class)): ?>
                                <li
                                    class="<?php echo e(Request::is('admin/admin/customer*') || Request::is('address/addresses/customer*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/admin/customer'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.customers'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isAdmin() && is_incevio_package_loaded('inspector')): ?>
                                <li class="<?php echo e(Request::is('admin/inspector/inspectables*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/inspector/inspectables'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('inspector::lang.inspectables'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(Gate::allows('index', \App\Models\Merchant::class) || Gate::allows('index', \App\Models\Shop::class)): ?>
                    <li class="treeview <?php echo e(Request::is('admin/vendor*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-map-marker"></i>
                            <span><?php echo e(trans('nav.vendors'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Shop::class)): ?>
                                <li class="<?php echo e(Request::is('admin/vendor/merchant*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/vendor/merchant'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.merchants'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Shop::class)): ?>
                                <li class="<?php echo e(Request::is('admin/vendor/shop*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/vendor/shop'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.shops'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(is_incevio_package_loaded('wallet')): ?>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <li
                            class="treeview <?php echo e(Request::is('admin/payouts*') || Request::is('admin/payout*') ? 'active' : '', false); ?>">
                            <a href="javascript:void(0)">
                                <i class="fa fa-money"></i>
                                <span><?php echo e(trans('wallet::lang.wallet'), false); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo e(Request::is('admin/payouts*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/payouts'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('wallet::lang.payouts'), false); ?>

                                    </a>
                                </li>

                                <li class="<?php echo e(Request::is('admin/payout/requests*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/payout/requests'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('wallet::lang.payout_requests'), false); ?>

                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php elseif(Auth::user()->isMerchant()): ?>
                        <li class="<?php echo e(Request::is('admin/wallet*') ? 'active' : '', false); ?>">
                            <a href="<?php echo e(route('merchant.wallet'), false); ?>">
                                <i class="fa fa-money"></i> <span><?php echo e(trans('wallet::lang.wallet'), false); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Gate::allows('index', \App\Models\Carrier::class) || Gate::allows('index', \App\Models\Packaging::class)): ?>
                    <li class="treeview <?php echo e(Request::is('admin/shipping*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-truck"></i>
                            <span><?php echo e(trans('nav.shipping'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Carrier::class)): ?>
                                <li class="<?php echo e(Request::is('admin/shipping/carrier*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/shipping/carrier'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.carriers'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Packaging::class)): ?>
                                <li class="  <?php echo e(Request::is('admin/shipping/packaging*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/shipping/packaging'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.packaging'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\ShippingZone::class)): ?>
                                <li class="<?php echo e(Request::is('admin/shipping/shippingZone*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/shipping/shippingZone'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.shipping_zones'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                

                
                <?php if($stf_show_extra_menu && Auth::user()->isFromMerchant()): ?>
                    <?php if(Gate::allows('index', \App\Models\Coupon::class) || Gate::allows('index', \App\Models\GiftCard::class)): ?>
                        <li class="treeview <?php echo e(Request::is('admin/promotion*') ? 'active' : '', false); ?>">
                            <a href="javascript:void(0)">
                                <i class="fa fa-paper-plane"></i>
                                <span><?php echo e(trans('nav.promotions'), false); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Coupon::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/promotion/coupon*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/promotion/coupon'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.coupons'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(
                    ($stf_show_extra_menu && Gate::allows('index', \App\Models\Message::class)) ||
                        ($stf_show_extra_menu && Gate::allows('index', \App\Models\Ticket::class)) ||
                        ($stf_show_extra_menu && Gate::allows('index', \App\Models\Dispute::class)) ||
                        ($stf_show_extra_menu && Gate::allows('index', \App\Models\Refund::class))): ?>
                    <li class="treeview <?php echo e(Request::is('admin/support*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-support"></i>
                            <span><?php echo e(trans('nav.support'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\ChatConversation::class)): ?>
                                <li class="<?php echo e(Request::is('admin/support/chat*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/support/chat'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.chats'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Message::class)): ?>
                                <li class="<?php echo e(Request::is('admin/support/message*') ? 'active' : '', false); ?>">
                                    <a
                                        href="<?php echo e(url('admin/support/message/labelOf/' . \App\Models\Message::LABEL_INBOX), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.support_messages'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isFromPlatform()): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Ticket::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/support/ticket*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/support/ticket'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.support_tickets'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Dispute::class)): ?>
                                <li class="<?php echo e(Request::is('admin/support/dispute*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/support/dispute'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.disputes'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Refund::class)): ?>
                                <li class="<?php echo e(Request::is('admin/support/refund*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/support/refund'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.refunds'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if((new \App\Helpers\Authorize(Auth::user(), 'customize_appearance'))->check()): ?>
                    <li class="treeview <?php echo e(Request::is('admin/appearance*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-paint-brush"></i>
                            <span><?php echo e(trans('nav.appearance'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('admin/appearance/theme') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/appearance/theme'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.themes'), false); ?>

                                </a>
                            </li>

                            <li class="<?php echo e(Request::is('admin/appearance/banner*') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/appearance/banner'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.banners'), false); ?>

                                </a>
                            </li>

                            <li class="<?php echo e(Request::is('admin/appearance/slider*') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/appearance/slider'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.sliders'), false); ?>

                                </a>
                            </li>

                            <li class="<?php echo e(Request::is('admin/appearance/custom_css*') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(route('admin.appearance.custom_css'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.custom_css'), false); ?>

                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                
                
                <?php if(Auth::user()->isAdmin()): ?>
                    <li
                        class="treeview <?php echo e(Request::is('admin/promotions*') || Request::is('admin/flashdeal*') || Request::is('admin/promotion*')? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-bullhorn"></i>
                            <span><?php echo e(trans('nav.promotions'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('admin/promotions*') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/promotions'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i>
                                    <span><?php echo e(trans('nav.promotions'), false); ?></span>
                                </a>
                            </li>
                            <li class="<?php echo e(Request::is('admin/promotion/coupon*') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/promotion/coupon'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.coupons'), false); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(Request::is('admin/promotion/coupon*') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/promotion/couponUsed'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.usedcoupons'), false); ?>

                                </a>
                            </li>
                            <?php if(Auth::user()->isAdmin() && is_incevio_package_loaded('flashdeal')): ?>
                                <li class="<?php echo e(Request::is('admin/flashdeal*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route('admin.flashdeal'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('flashdeal::lang.flashdeal'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()->isAdmin()): ?>
                    <li class="<?php echo e(Request::is('admin/packages*') ? 'active' : '', false); ?>">
                        <a href="<?php echo e(url('admin/packages'), false); ?>">
                            <i class="fa fa-plug"></i> <span><?php echo e(trans('nav.packages'), false); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(1): ?>
                    <li class="treeview <?php echo e(Request::is('admin/setting*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-gears"></i>
                            <span><?php echo e(trans('nav.settings'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(is_subscription_enabled()): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\SubscriptionPlan::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/setting/subscriptionPlan*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/setting/subscriptionPlan'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i>
                                            <?php echo e(trans('nav.subscription_plans'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Role::class)): ?>
                                <li class="<?php echo e(Request::is('admin/setting/role*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/role'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.user_roles'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Tax::class)): ?>
                                <li class="<?php echo e(Request::is('admin/setting/tax*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/tax'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.taxes'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', \App\Models\Config::class)): ?>
                                <li class="<?php echo e(Request::is('admin/setting/general*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/general'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.general'), false); ?>

                                    </a>
                                </li>

                                <li
                                    class="<?php echo e(Request::is('admin/setting/config*') || Request::is('admin/setting/verify*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/config'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.config'), false); ?>

                                    </a>
                                </li>

                                <?php if(vendor_get_paid_directly() || vendor_can_on_off_payment_method()): ?>
                                    <li class=" <?php echo e(Request::is('admin/setting/paymentMethod*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/setting/paymentMethod'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.payment_methods'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', \App\Models\System::class)): ?>
                                <li class="<?php echo e(Request::is('admin/setting/system/general*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/system/general'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.system_settings'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', \App\Models\SystemConfig::class)): ?>
                                <li class="<?php echo e(Request::is('admin/setting/system/config*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/system/config'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.config'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isAdmin()): ?>
                                <li class="<?php echo e(Request::is('admin/setting/announcement*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/announcement'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.announcements'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isAdmin()): ?>
                                <li class="<?php echo e(Request::is('admin/setting/country*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/country'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.countries'), false); ?>

                                    </a>
                                </li>

                                <li class="<?php echo e(Request::is('admin/setting/currency*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/currency'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.currencies'), false); ?>

                                    </a>
                                </li>

                                <li class="<?php echo e(Request::is('admin/setting/language*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/language'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('app.languages'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isSuperAdmin() && is_incevio_package_loaded('wallet')): ?>
                                <li class="<?php echo e(Request::is('admin/setting/wallet*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/setting/wallet'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('wallet::lang.wallet_settings'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isSuperAdmin() && is_incevio_package_loaded('inspector')): ?>
                                <li class="<?php echo e(Request::is('admin/setting/inspector*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route(config('inspector.routes.settings')), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('inspector::lang.inspector_settings'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isSuperAdmin() && is_incevio_package_loaded('zipcode')): ?>
                                <li class="<?php echo e(Request::is('admin/setting/zipcode*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route(config('zipcode.routes.settings')), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('zipcode::lang.zipcode_setting'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Auth::user()->isSuperAdmin() && is_incevio_package_loaded('dynamicCommission')): ?>
                                <li class="<?php echo e(Request::is('admin/setting/dynamicCommission*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route(config('dynamicCommission.routes.settings')), false); ?>">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('dynamicCommission::lang.commissions_settings'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(Gate::allows('index', \App\Models\Page::class) ||
                        Gate::allows('index', \App\Models\EmailTemplate::class) ||
                        Gate::allows('index', \App\Models\Blog::class) ||
                        Gate::allows('index', \Incevio\Package\Eventy\Models\Event::class) ||
                        Gate::allows('index', \App\Models\Faq::class)): ?>
                    <li class="treeview <?php echo e(Request::is('admin/utility*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-asterisk"></i>
                            <span><?php echo e(trans('nav.utilities'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\EmailTemplate::class)): ?>
                                <li class="<?php echo e(Request::is('admin/utility/emailTemplate*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/utility/emailTemplate'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.email_templates'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Page::class)): ?>
                                <li class="<?php echo e(Request::is('admin/utility/page*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/utility/page'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.pages'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Blog::class)): ?>
                                <li class="<?php echo e(Request::is('admin/utility/blog*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/utility/blog'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <span><?php echo e(trans('nav.blogs'), false); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(is_incevio_package_loaded('eventy')): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \Incevio\Package\Eventy\Models\Event::class)): ?>
                                    <li class="<?php echo e(Request::is('admin/utility/event*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(url('admin/utility/event'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i>
                                            <span><?php echo e(trans('eventy::lang.events'), false); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('index', \App\Models\Faq::class)): ?>
                                <li class="<?php echo e(Request::is('admin/utility/faq*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(url('admin/utility/faq'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.faqs'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(($stf_show_extra_menu && Auth::user()->isAdmin()) || ($stf_show_extra_menu && Auth::user()->isMerchant())): ?>
                    <li
                        class="treeview <?php echo e(Request::is('admin/report*') || Request::is('admin/shop/report*') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-map"></i>
                            <span><?php echo e(trans('nav.reports'), false); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(Auth::user()->isAdmin()): ?>
                                <?php if(is_incevio_package_loaded('wallet')): ?>
                                    <li class="<?php echo e(Request::is('admin/report/payout*') ? 'active' : '', false); ?>">
                                        <a href="<?php echo e(route('admin.wallet.payout.report'), false); ?>">
                                            <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.payout'), false); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="<?php echo e(Request::is('admin/report/kpi*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route('admin.kpi'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.performance'), false); ?>

                                    </a>
                                </li>
                                <li class="<?php echo e(Request::is('admin/report/visitors*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route('admin.report.visitors'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.visitors'), false); ?>

                                    </a>
                                </li>
                                <li class="<?php echo e(Request::is('admin/report/sales*') ? 'active' : '', false); ?>">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-angle-double-right"></i>
                                        <?php echo e(trans('nav.sales'), false); ?>

                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="<?php echo e(Request::is('admin/report/sales/orders*') ? 'active' : '', false); ?>">
                                            <a href="<?php echo e(route('admin.sales.orders'), false); ?>">
                                                <i class="fa fa-angle-right"></i><?php echo e(trans('nav.orders'), false); ?>

                                            </a>
                                        </li>
                                        <li
                                            class="<?php echo e(Request::is('admin/report/sales/products*') ? 'active' : '', false); ?>">
                                            <a href="<?php echo e(route('admin.sales.products'), false); ?>">
                                                <i class="fa fa-angle-right"></i><?php echo e(trans('nav.products'), false); ?>

                                            </a>
                                        </li>
                                        <li class="<?php echo e(Request::is('admin/report/sales/payment*') ? 'active' : '', false); ?>">
                                            <a href="<?php echo e(route('admin.sales.payments'), false); ?>">
                                                <i class="fa fa-angle-right"></i><?php echo e(trans('nav.payments'), false); ?>

                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php elseif(Auth::user()->isMerchant()): ?>
                                <li class="<?php echo e(Request::is('admin/shop/report/kpi*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route('admin.shop-kpi'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.performance'), false); ?>

                                    </a>
                                </li>

                                <li class="<?php echo e(Request::is('admin/shop/report/kpi*') ? 'active' : '', false); ?>">
                                    <a href="<?php echo e(route('admin.shop-kpi'), false); ?>">
                                        <i class="fa fa-angle-double-right"></i> <?php echo e(trans('nav.performance'), false); ?>

                                    </a>
                                </li>

                            <?php endif; ?>
                        </ul>



                    </li>
                <?php endif; ?>


                <?php if(Auth::user()->isSuperAdmin()): ?>
                    <li
                        class="treeview <?php echo e(Request::is('admin/stylist/employer_onboarding_questionnaire') || Request::is('admin/stylist/super-admin/products') ? 'active' : '', false); ?>">
                        <a href="javascript:void(0)">
                            <i class="fa fa-paper-plane"></i>
                            <span>Add Product</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="<?php echo e(Request::is('admin/stylist/super-admin/products') ? 'active' : '', false); ?>">
                                <a href="<?php echo e(url('admin/stylist/super-admin/products'), false); ?>">
                                    <i class="fa fa-angle-double-right"></i> Add Product
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="treeview <?php echo e(Request::is('admin/employer_onboarding_questionnaire') ? 'active' : '', false); ?>">
                        <a href="<?php echo e(url('admin/employer_onboarding_questionnaire'), false); ?>">
                            <i class="fa fa-file"></i>
                            <span>Employer Onboarding</span>
                        </a>
                    </li>

                    <li class="treeview <?php echo e(Request::is('admin/stylist/manage_questions') ? 'active' : '', false); ?>">
                        
                        <a href="<?php echo e(url('admin/stylist/manage_questions'), false); ?>">
                            <i class="fa-solid fa-book"></i>
                            <span>Manage Questions</span>
                        </a>
                    </li>
                <?php endif; ?>


                <!--
        <li class="header">LABELS</li>
        <li><a href="javascript:void(0)">
        <i class="fa fa-circle-o text-red"></i> <span>Important</span></a>
        </li>
        <li><a href="javascript:void(0)">
        <i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a>
        </li>
        <li><a href="javascript:void(0)">
        <i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a>
        </li>
        -->


            </ul>
        <?php endif; ?>
    </section> <!-- /.sidebar -->
</aside><?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/admin/sidebar.blade.php ENDPATH**/ ?>