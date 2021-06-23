<?php $__env->startSection('content'); ?>
  <div class="d-flex">
    <h4>出荷先一覧</h4>
  </div>
  <div id="shippings_info"></div>
  <div>
    <table class="table col">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">出荷先名</th>
          <th scope="col">住所</th>
          <th scope="col">TEL</th>
          <th scope="col">アクション</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th scope="row"><?php echo e($shipping->id); ?></th>
            <td class="shippin_gname"><?php echo e($shipping->name); ?></td>
            <td class="shipping_address"><?php echo e($shipping->address); ?></td>
            <td class="shipping_tel"><?php echo e($shipping->tel); ?></td>
            <td class="d-flex">
              <button type="button" class="shipping_delete_btn mr-3" data-toggle="modal" data-target="#modal_delete" data-name="<?php echo e($shipping->name); ?>" data-url="/shipping/delete/<?php echo e($shipping->id); ?>">削除</button>
              <button type="button" class="mr-3" onclick="location.href='/shipping/edit/<?php echo e($shipping->id); ?>'">編集</button>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <div class="modal" tabindex="-1" role="dialog" id="modal_delete">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p>本当に<span id="shipping_delete_candidate_name"></span>を削除してもよろしいですか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            <button type="button" class="btn btn-danger" id="shipping_delete_execute">削除</button>
          </div>
        </div>
      </div>
    </div>

    <div>
      <?php echo e($shippings->links()); ?>

    </div>
  </div>

<?php $__env->stopSection(); ?>
<script>
  window.onload = function(){
    $("#modal_delete").on('shown.bs.modal', function(event){
      headerMenu();

      const button = $(event.relatedTarget);
      const shipping_name = button.data('name');
      const url = button.data('url');
      $('#shipping_candidate_name').text(shipping_name);
      $('#shipping_delete_execute').on('click', function(){
        location.href = url;
      });
    });
  }


</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/shippings/index.blade.php ENDPATH**/ ?>