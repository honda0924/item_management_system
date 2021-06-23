<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('You are logged in!')); ?>

                </div>
            </div>
            <div class="card">
                <div class="card-header">メニュー</div>
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="<?php echo e(url('/items')); ?>">商品一覧</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/item/create')); ?>">商品登録</a>
                        </li>
                        <li>
                            <a href="/inquiry">お問い合わせ</a>
                        </li>
                        <li>
                            <a href="/mypage">マイページ</a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/home.blade.php ENDPATH**/ ?>