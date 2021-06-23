<?php $__env->startSection('content'); ?>

  <div class="card">
    <div class="card-header">マイページ</div>
    <div class="card-body">
        <ul>
          <li>
            <div class="d-flex">
              <h4>ユーザー情報</h4>
              <button type="button" class="mr-3" data-toggle="modal" data-target="#modal_user_edit">ユーザー情報変更</button>
              <button type="button" onclick="location.href='password/change'">パスワード変更</button>
            </div>
            <div>login_id:<?php echo e($user["login_id"]); ?> </div>
            <div>ユーザー名:<?php echo e($user["name"]); ?> </div>
            <div>email:<?php echo e($user["email"]); ?> </div>
            <div class="modal" tabindex="-1" role="dialog" id="modal_user_edit">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <form method="post" action="<?php echo e(route('user.edit_post')); ?>">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" name="id" value="<?php echo e($user['id']); ?>">
                      <input type="hidden" name="login_id" value="<?php echo e($user['login_id']); ?>">
                    
                      <div class="form-group">
                        <label for="name">ユーザー名</label>
                        <input id="name" class="form-control" type="text" name="name" value="<?php echo e($user['name']); ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input id="email" class="form-control" type="text" name="email" value="<?php echo e($user['email']); ?>">
                      </div>
                
                      <button type="submit" class="btn btn-primary">変更</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                  </div>
                </div>
              </div>
            </div>

          </li>
            <li>
              <h4>ログ一覧</h4>
              <div>
                <table class="table col">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">email</th>
                      <th scope="col">tel</th>
                      <th scope="col">information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <th scope="row"><?php echo e($log->id); ?></th>
                        <td class="email"><?php echo e($log->email); ?></td>
                        <td class="tel"><?php echo e($log->tel); ?></td>
                        <td class="information"><?php echo e($log->information); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </li>

            <li>
              <h4>お気に入り一覧</h4>
              <div>
                <table class="table col">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">商品名</th>
                      <th scope="col">入荷元</th>
                      <th scope="col">製造元</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <th scope="row"><?php echo e($favorite->id); ?></th>
                        <td class="product_name"><?php echo e($favorite->product_name); ?></td>
                        <td class="arrival_source"><?php echo e($favorite->arrival_source); ?></td>
                        <td class="manufacturer"><?php echo e($favorite->manufacturer); ?></td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </li>
        </ul>
        
    </div>
</div>


<?php $__env->stopSection(); ?>
<script>
  window.onload = function(){
    headerMenu();
  }
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/mypage/index.blade.php ENDPATH**/ ?>