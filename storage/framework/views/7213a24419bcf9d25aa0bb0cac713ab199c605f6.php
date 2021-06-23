<?php $__env->startSection('content'); ?>
  <h4>商品登録</h4>
  <h6>以下の内容で登録します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="<?php echo e(url('/item/send')); ?>">
      <?php echo csrf_field(); ?>
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
        <label>金額</label>
        <div><?php echo e($input["price"]); ?></div>
      </div>
      <div class="form-group">
        <label>メールアドレス</label>
        <div><?php echo e($input["email"]); ?></div>
      </div>
      <div class="form-group">
        <label>電話番号</label>
        <div><?php echo e($input["tel"]); ?></div>
      </div>
      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">登録</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/items/confirm.blade.php ENDPATH**/ ?>