 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('massDelete', \App\Models\Inventory::class)): ?>
   <td>
     <input id="<?php echo e($inventory->id, false); ?>" type="checkbox" class="massCheck">
   </td>
 <?php endif; ?>
<?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/inventory/partials/checkbox.blade.php ENDPATH**/ ?>