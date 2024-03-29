
<button type="button" id="filterBtn">
  <span class="sr-only">Filters</span>
  <i class="fas fa-filter"></i>
</button>

<aside class="category-filters mb-4">

  <?php echo $__env->make('theme::partials._categories_filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php if(config('system_settings.show_item_conditions')): ?>
    <div class="category-filters-section">
      <h3>
        <?php echo e(trans('theme.condition'), false); ?>

      </h3>

      <div class="checkbox">
        <label>
          <input name="condition[New]" class="i-check filter_opt_checkbox" type="checkbox" <?php echo e(Request::has('condition.New') ? 'checked' : '', false); ?>> <?php echo app('translator')->get('theme.new'); ?> <span class="small">(<?php echo e($products->where('condition', trans('app.new'))->count(), false); ?>)</span>
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input name="condition[Used]" class="i-check filter_opt_checkbox" type="checkbox" <?php echo e(Request::has('condition.Used') ? 'checked' : '', false); ?>> <?php echo app('translator')->get('theme.used'); ?> <span class="small">(<?php echo e($products->where('condition', trans('app.used'))->count(), false); ?>)</span>
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input name="condition[Refurbished]" class="i-check filter_opt_checkbox" type="checkbox" <?php echo e(Request::has('condition.Refurbished') ? 'checked' : '', false); ?>> <?php echo app('translator')->get('theme.refurbished'); ?> <span class="small">(<?php echo e($products->where('condition', trans('app.refurbished'))->count(), false); ?>)</span>
        </label>
      </div>
    </div>
  <?php endif; ?>

  
  <?php if (! (Request::is('search*'))): ?>
    <div class="category-filters-section">
      <h3>
        <?php echo e(trans('theme.rating'), false); ?>


        <?php if(Request::has('rating')): ?>
          <a href="javascript::void(0)" data-name="rating" class="clear-filter small text-lowercase pull-right"><?php echo app('translator')->get('theme.button.clear'); ?></a>
        <?php endif; ?>
      </h3>
      <ul class="cateogry-filters-list">
        <?php for($i = 4; $i > 0; $i--): ?>
          <li>
            <a href="javascript::void(0)" data-name="rating" data-value="<?php echo e($i, false); ?>" class="link-filter-opt product-info-rating">
              <?php for($j = 0; $j < 5; $j++): ?>
                <?php if($j < $i): ?>
                  <span class="rated">&#9733;</span>
                <?php else: ?>
                  <span>&#9734;</span>
                <?php endif; ?>
              <?php endfor; ?>
              <span class="small <?php echo e(Request::get('rating') == $i ? 'active' : '', false); ?>">&amp; <?php echo app('translator')->get('theme.up'); ?></span>
            </a>
          </li>
        <?php endfor; ?>
      </ul>
    </div>
  <?php endif; ?>

  
  <?php if($priceRange['max'] - $priceRange['min'] > 0): ?>
    <div class="category-filters-section">
      <h3>
        <?php echo e(trans('theme.price'), false); ?>


        <?php if(Request::has('price')): ?>
          <a href="javascript::void(0)" data-name="price" class="clear-filter small text-lowercase pull-right"><?php echo app('translator')->get('theme.button.clear'); ?></a>
        <?php endif; ?>
      </h3>
      <ul class="cateogry-filters-list space20">
        <?php $__currentLoopData = generate_ranges($priceRange['min'], $priceRange['max'], 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ranges): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <a href="javascript::void(0)" data-name="price" data-value="<?php echo e($ranges['lower'] . '-' . $ranges['upper'], false); ?>" class="link-filter-opt <?php echo e(Request::get('price') == $ranges['lower'] . '-' . $ranges['upper'] ? 'active' : '', false); ?>">
              <?php if($loop->first): ?>
                <?php echo e(trans('theme.price_under', ['value' => get_formated_currency($ranges['upper'])]), false); ?>

              <?php elseif($loop->last): ?>
                <?php echo e(trans('theme.price_above', ['value' => get_formated_currency($ranges['lower'])]), false); ?>

              <?php else: ?>
                <span class="text-lowercase">
                  <?php echo e(get_formated_currency($ranges['lower']) .' ' .trans('theme.to') .' ' .get_formated_currency($ranges['upper']), false); ?>

                </span>
              <?php endif; ?>
            </a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <input type="text" id="price-slider" />
    </div>
  <?php endif; ?>

  
  <?php if(isset($category->attrsList)): ?>
    <?php $__currentLoopData = $category->attrsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="category-filters-section">
        <h3>
          <?php echo e($attribute->name, false); ?>


          <?php if(Request::has('attribute.' . $attribute->attributeValues->first()->id)): ?>
            <a href="javascript::void(0)" data-name="attribute[<?php echo e($attribute->attributeValues->first()->id, false); ?>]" class="clear-filter small text-lowercase pull-right"><?php echo app('translator')->get('theme.button.clear'); ?></a>
          <?php endif; ?>
        </h3>
        <?php $__currentLoopData = $attribute->attributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="checkbox">
            <label>
              <input type="checkbox" value="<?php echo e($attribute->id, false); ?>" name="attribute[<?php echo e($attributeValue->id, false); ?>]" class="i-check filter_opt_checkbox" <?php echo e(Request::has('attribute.' . $attributeValue->id) ? 'checked' : '', false); ?>> <?php echo e(\Str::title(\Str::limit($attributeValue->value, 30)), false); ?>

            </label>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>

  
  <?php if(count($brands)): ?>
    <div class="category-filters-section">
      <h3>
        <?php echo e(trans('theme.brand'), false); ?>

      </h3>

      <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="checkbox">
          <label>
            <input name="brand[<?php echo e(str_replace(' ', '%20', $brand), false); ?>]" class="i-check filter_opt_checkbox" type="checkbox" <?php echo e(Request::has('brand.' . $brand) ? 'checked' : '', false); ?>> <?php echo e(\Str::title(\Str::limit($brand, 30)), false); ?>

          </label>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  <?php endif; ?>

</aside>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/public/themes/default/views/contents/product_list_sidebar_filters.blade.php ENDPATH**/ ?>