<?php $__env->startSection('content'); ?>
  <h4>メール送信確認</h4>
  <h6>以下の内容で送信します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="<?php echo e(url('/inquiry/send')); ?>">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label>お名前</label>
        <div><?php echo e($input["inquirer_name"]); ?></div>
      </div>
      <div class="form-group">
        <label>メールアドレス</label>
        <div><?php echo e($input["email"]); ?></div>
      </div>
      <div class="form-group">
        <label>電話番号</label>
        <div><?php echo e($input["tel"]); ?></div>
      </div>
      <div class="form-group">
        <label>性別</label>
        <div><?php echo e($input["gender"]); ?></div>
      </div>
      <?php if($input["gender"]=="男性"): ?>
        <div class="form-group">
          <label>趣味</label>
          <div><?php echo e($input["hobby"]); ?></div>
        </div>
      <?php else: ?>
        <div class="form-group">
          <label>特技</label>
          <div><?php echo e($input["skill"]); ?></div>
        </div>
      <?php endif; ?>
      <div class="form-group">
        <label>お問い合わせ内容</label>
        <div><?php echo e($input["inquiry_text"]); ?></div>
      </div>
      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">登録</button>
    </form>
  </div>


<?php $__env->stopSection(); ?>
<script>
  window.onload = function(){
    headerMenu();
  }
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/inquiry/confirm.blade.php ENDPATH**/ ?>