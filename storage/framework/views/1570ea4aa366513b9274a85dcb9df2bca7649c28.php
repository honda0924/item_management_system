<?php $__env->startSection('content'); ?>
  <h4>出荷先編集</h4>
  <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <?php
      $name = old('name');
      $arrival_source = old('address');
      $tel = old('tel');
    ?>  
  <?php endif; ?>
  <div class="w-50">
    <form method="post" action="<?php echo e(route('shipping.edit_post')); ?>">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="id" value="<?php echo e(old('id') ?? $shipping->id); ?>">
      <div class="form-group">
        <label for="name">出荷先名</label>
        <input id="name" class="form-control" type="text" name="name" value="<?php echo e(old('name') ?? $shipping->name); ?>">
      </div>
      <div class="form-group">
        <label for="address">住所</label>
        <input id="address" class="form-control" type="text" name="address" value="<?php echo e(old('address') ?? $shipping->address); ?>">
      </div>
      <div class="form-group">
        <label for="tel">TEL</label>
        <input id="tel" class="form-control" type="text" name="tel" value="<?php echo e(old('tel') ?? $shipping->tel); ?>">
      </div>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/shippings/edit.blade.php ENDPATH**/ ?>