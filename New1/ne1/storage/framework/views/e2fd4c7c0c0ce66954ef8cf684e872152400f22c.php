<div id="primary-navigation" style='margin-top:40px;'>
    <div class="header__top">
        <div class="container">
            <div class="header__top-inner">
                <div class="header__top-welcome">
                    
                    <?php if(is_incevio_package_loaded('zipcode') && Session::has('zipcode_default')): ?>
                    <a class="modalAction" href="<?php echo e(route(config('zipcode.routes.shipTo')), false); ?>">
                        <i class="fal fa-location-arrow"></i> <?php echo e(trans('theme.ship_to') . ' ' .
                        Session::get('zipcode_default'), false); ?>

                    </a>
                    <?php else: ?>
                    <h3><?php echo e(trans('theme.welcome') . ' ' . config('theme.name'), false); ?></h3>
                    <?php endif; ?>
                </div>

                <div class="header__top-utility">
                    <ul>
                        <?php if(auth()->guard('customer')->check()): ?>
                        <li class="image-icon">
                            <a href="<?php echo e(route('account', 'dashboard'), false); ?>">
                                <i class="fal fa-user"></i>
                                <span><?php echo e(trans('theme.hello') .
                                    ', ' .
                                    Auth::guard('customer')->user()->getName(), false); ?></span>
                            </a>
                        </li>

                        <li class="image-icon">
                            <a href="<?php echo e(route('customer.logout'), false); ?>">
                                <i class="fal fa-power-off"></i>
                                <span><?php echo e(trans('theme.logout'), false); ?></span>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="image-icon">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal">
                                <i class="fal fa-user"></i>
                                <span><?php echo e(trans('theme.sing_in'), false); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(Auth::guard('customer')->check() && is_wallet_configured_for('customer')): ?>
                        <li class="image-icon">
                            <a href="<?php echo e(route('customer.account.wallet'), false); ?>">
                                <i class="fal fa-wallet"></i>
                                <strong><?php echo e(get_formated_currency(Auth::guard('customer')->user()->balance), false); ?></strong>
                            </a>
                        </li>
                        <?php endif; ?>

                        

                        <li class="image-icon">
                            <a href="<?php echo e(route('account', 'orders'), false); ?>">
                                <!-- <img src="images/truck.svg" alt=""> -->
                                <i class="fal fa-map-marker-alt"></i> <?php echo e(trans('theme.track_your_order'), false); ?>

                            </a>
                        </li>
                        <li class="image-icon">
                            <a href="<?php echo e(get_page_url(\App\Models\Page::PAGE_CONTACT_US), false); ?>">
                                <i class="fal fa-life-ring"></i> <?php echo e(trans('theme.support'), false); ?>

                            </a>
                        </li>

                        

                        <li class="language">
                            <select name="lang" id="languageChange">
                                <?php $__currentLoopData = config('active_locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option dd-link="<?php echo e(route('locale.change', $lang->code), false); ?>" value="<?php echo e($lang->code, false); ?>"
                                    data-imagesrc="<?php echo e(get_flag_img_by_code(array_slice(explode('_', $lang->php_locale_code), -1)[0], true), false); ?>"
                                    <?php echo e($lang->code == \App::getLocale() ? 'selected' : '', false); ?>>
                                    <?php echo e($lang->language, false); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    

                

                        
                                
                                    
                                    
                            
                                
                                <!-- <img src="images/big-heart.svg" alt=""> -->
                                
                            
                                <!-- <img src="images/shopping-bag.svg" alt=""> -->
                                
                        
                    

    <div class="header__navigation">
        <div class="container">
            <div class="header__navigation-inner">
                <ul class="menu-dropdown-list header__navigation-category">
                    <li>
                        <a href="<?php echo e(route('categories'), false); ?>" class="menu-link" data-menu-link>
                            <i class="fas fa-stream" style="margin-right: 10px;"></i>
                            <?php echo e(trans('theme.categories'), false); ?>

                            
                        </a>

                        <ul class="menu-cat" data-menu-toggle>
                            <?php $__currentLoopData = $all_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($catGroup->subGroups->count()): ?>
                            <?php
                            $categories_count = $catGroup->subGroups->sum('categories_count');
                            $cat_counter = 0;
                            ?>
                            <li>
                                <a href="<?php echo e(route('categoryGrp.browse', $catGroup->slug), false); ?>">
                                    <?php if($catGroup->logoImage && Storage::exists($catGroup->logoImage->path)): ?>
                                    <img src="<?php echo e(get_storage_file_url($catGroup->logoImage->path, 'tiny_thumb'), false); ?>"
                                        alt="<?php echo e($catGroup->name, false); ?>">
                                    <?php else: ?>
                                    <i class="fal <?php echo e($catGroup->icon ?? 'fa-cube', false); ?>"></i>
                                    <?php endif; ?>

                                    <span><?php echo e($catGroup->name, false); ?></span>
                                    <i class="fal fa-chevron-right"></i>
                                </a>

                                <div class="mega-dropdown"
                                    style="background-image:url(<?php echo e($catGroup->backgroundImage ? get_storage_file_url(optional($catGroup->backgroundImage)->path, 'full') : '', false); ?>); background-position: right bottom; background-repeat: no-repeat;margin-right: 0; background-size: contain;">

                                    <div class="row">
                                        <?php $__currentLoopData = $catGroup->subGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-<?php echo e($categories_count > 15 ? '4' : '6', false); ?>">
                                            <?php
                                            $cat_counter = 0; //Reset the counter
                                            ?>

                                            <div class="mega-dropdown__item">
                                                <h3>
                                                    <a href="<?php echo e(route('categories.browse', $subGroup->slug), false); ?>"><?php echo e($subGroup->name, false); ?></a>
                                                </h3>
                                                <ul>
                                                    <?php $__currentLoopData = $subGroup->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('category.browse', $cat->slug), false); ?>"><?php echo e($cat->name, false); ?></a>
                                                        <?php if($cat->description): ?>
                                                        <p class="text-muted"><?php echo $cat->description; ?></p>
                                                        <?php endif; ?>
                                                    </li>
                                                    <?php
                                                    $cat_counter++; //Increase the counter value by 1
                                                    ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                </ul>

                <ul class="header__menu">
                    <li>
                        <a class="menu-link" href="<?php echo e(route('brands'), false); ?>">
                            <i class="fal fa-crown menu-icon"></i> <?php echo e(trans('theme.brands'), false); ?>

                        </a>
                    </li>

                    <li>
                        <a class="menu-link" href="<?php echo e(route('shops'), false); ?>">
                            <i class="fal fa-store menu-icon"></i> <?php echo e(trans('theme.vendors'), false); ?>

                        </a>
                    </li>

                    <?php if(is_incevio_package_loaded('eventy')): ?>
                    <li>
                        <a class="menu-link" href="<?php echo e(route('events'), false); ?>">
                            <i class="fal fa-calendar-alt menu-icon"></i> <?php echo e(trans('theme.events'), false); ?>

                        </a>
                    </li>
                    <?php endif; ?>

                    <?php $__currentLoopData = $pages->where('position', 'main_nav'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(get_page_url($page->slug), false); ?>" class="menu-link">
                            <i class="fal fa-link menu-icon"></i> <?php echo e($page->title, false); ?>

                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <li>
                        <a class="menu-link" href="<?php echo e(url('/selling'), false); ?>">
                            <i class="fal fa-seedling menu-icon"></i>
                            <?php echo e(trans('theme.nav.sell_on', ['platform' => get_platform_title()]), false); ?>

                        </a>
                    </li>

                    

                    
                </ul>

                <div class="shale-text">
                    <a style="text-decoration: none"
                        href="<?php echo e($promotional_tagline['action_url'] ?? 'javascript:void(0)', false); ?>">
                        <p><?php echo e(!empty($promotional_tagline['text']) ? $promotional_tagline['text'] : '', false); ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/nav/main.blade.php ENDPATH**/ ?>