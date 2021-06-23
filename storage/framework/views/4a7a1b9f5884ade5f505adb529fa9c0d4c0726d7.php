<?php $__env->startSection('content'); ?>
  <h4>商品編集</h4>
  <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <?php
      $product_name = old('product_name');
      $arrival_source = old('arrival_source');
      $manufacturer = old('manufacturer');
    ?>  
  <?php endif; ?>
  <div class="w-50">
    <form method="post" action="<?php echo e(route('item.edit_post')); ?>">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="id" value="<?php echo e(old('id') ?? $item->id); ?>">
      <div class="form-group">
        <label for="product_name">商品名(必須)</label>
        <input id="product_name" class="form-control" type="text" name="product_name" value="<?php echo e(old('product_name') ?? $item->product_name); ?>">
      </div>
      <div class="form-group">
        <label for="arrival_source">入荷元</label>
        <input id="arrival_source" class="form-control" type="text" name="arrival_source" value="<?php echo e(old('arrival_source') ?? $item->arrival_source); ?>">
      </div>
      <div class="form-group">
        <label for="manufacturer">製造元</label>
        <input id="manufacturer" class="form-control" type="text" name="manufacturer" value="<?php echo e(old('manufacturer') ?? $item->manufacturer); ?>">
      </div>
      <div class="form-group">
        <label for="price">単価</label>
        <input id="price" class="form-control" type="text" name="price" value="<?php echo e(old('price') ?? $item->price); ?>">
      </div>

      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/items/edit.blade.php ENDPATH**/ ?>