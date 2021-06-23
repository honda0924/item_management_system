<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード変更</div>

                <div class="card-body">
                    <?php if(session('warning')): ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo e(session('warning')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.confirm')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo e(method_field('patch')); ?>


                        <input class="form-control" type="hidden" name="id" value="<?php echo e($user->id); ?>">
                        <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
                            <label for="current_password" class="col-md-6 col-form-label">現在のパスワード</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>

                                <?php if($errors->has('current_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('current_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>


                        </div>
                        <div class="form-group<?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
                            <label for="new_password" class="col-md-6 control-label">新しいパスワード</label>
 
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>
 
                                <?php if($errors->has('new_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('new_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('new_password_confirmation') ? ' has-error' : ''); ?>">
                            <label for="new_password-confirm" class="col-md-6 control-label">新しいパスワード（確認）</label>
                            <div class="col-md-6">
                                <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" required>
 
                                <?php if($errors->has('new_password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('new_password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 ml-3">
                                <button type="submit" class="btn btn-primary">
                                    パスワードの変更
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/auth/passwords/edit.blade.php ENDPATH**/ ?>