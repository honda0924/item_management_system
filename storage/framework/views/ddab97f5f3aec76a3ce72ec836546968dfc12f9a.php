<?php $__env->startSection('content'); ?>
  <h4>商品更新</h4>
  <h6>以下の内容で更新します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="<?php echo e(route('shipping.update', $input["id"])); ?>">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label>id</label>
        <div><?php echo e($input["id"]); ?></div>
      </div>      
      <div class="form-group">
        <label>入荷先名</label>
        <div><?php echo e($input["name"]); ?></div>
      </div>
      <div class="form-group">
        <label>住所</label>
        <div><?php echo e($input["address"]); ?></div>
      </div>
      <div class="form-group">
        <label>TEL</label>
        <div><?php echo e($input["tel"]); ?></div>
      </div>
      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/shippings/edit_confirm.blade.php ENDPATH**/ ?>