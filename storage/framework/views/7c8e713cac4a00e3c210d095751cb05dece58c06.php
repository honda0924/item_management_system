<?php $__env->startSection('content'); ?>
  <h4>商品更新</h4>
  <h6>以下の内容で更新します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="<?php echo e(route('item.update', $input["id"])); ?>">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label>id</label>
        <div><?php echo e($input["id"]); ?></div>
      </div>      
      <div class="form-group">
        <label>商品名</label>
        <div><?php echo e($input["product_name"]); ?></div>
      </div>
      <div class="form-group">
        <label>入荷元</label>
        <div><?php echo e($input["arrival_source"]); ?></div>
      </div>
      <div class="form-group">
        <label>製造元</label>
        <div><?php echo e($input["manufacturer"]); ?></div>
      </div>
      <div class="form-group">
        <label>単価</label>
        <div><?php echo e($input["price"]); ?></div>
      </div>

      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/items/edit_confirm.blade.php ENDPATH**/ ?>