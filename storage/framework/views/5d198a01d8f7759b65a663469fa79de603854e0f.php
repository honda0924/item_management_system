<?php $__env->startSection('content'); ?>
  <h4>ユーザー情報変更</h4>
  <h6>以下の内容で変更します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="<?php echo e(route('user.update', $input["id"])); ?>">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label>ログイン名</label>
        <div><?php echo e($input["login_id"]); ?></div>
      </div>      
      <div class="form-group">
        <label>ユーザー名</label>
        <div><?php echo e($input["name"]); ?></div>
      </div>
      <div class="form-group">
        <label>メールアドレス</label>
        <div><?php echo e($input["email"]); ?></div>
      </div>

      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">変更</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/user/edit_confirm.blade.php ENDPATH**/ ?>