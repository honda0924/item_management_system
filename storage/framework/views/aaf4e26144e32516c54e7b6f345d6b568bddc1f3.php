<?php $__env->startSection('content'); ?>
  <div class="d-flex">
    <h4>商品一覧</h4>
    <button onclick="location.href='/cart/show/<?php echo e(Auth::user()["id"]); ?>'">カートを見る</button>
  </div>
  
  <div id="err_info"></div>
  <div>
    <div class="d-flex w-50">
      <input class="form-control" type="text" id="item_search_input"  placeholder="フリーワードで検索">
      <button class="btn btn-primary" id="item_search_btn">検索</button>
    </div>
    <table class="table col">
      <thead>
        <tr>
          <th scope="col">
            <div class="d-flex">
              <p>id</p>
              <button class="sort btn btn-secondary ml-1" id="sort-id-asc">↑</button>
              <button class="sort btn btn-secondary ml-1" id="sort-id-desc">↓</button>
            </div>
          </th>
          <th scope="col">
            <div class="d-flex">
              <p>商品名</p>
              <button class="sort btn btn-secondary ml-1" id="sort-product_name-asc">↑</button>
              <button class="sort btn btn-secondary ml-1" id="sort-product_name-desc">↓</button>
            </div>
          </th>
          <th scope="col">
            <div class="d-flex">
              <p>入荷元</p>
              <button class="sort btn btn-secondary ml-1" id="sort-arrival_source-asc">↑</button>
              <button class="sort btn btn-secondary ml-1" id="sort-arrivel_source-desc">↓</button>
            </div>
          </th>
          <th scope="col">
            <div class="d-flex">
              <p>製造元</p>
              <button class="sort btn btn-secondary ml-1" id="sort-manufacturer-asc">↑</button>
              <button class="sort btn btn-secondary ml-1" id="sort-manufacturer-desc">↓</button>
            </div>
          </th>
          <th scope="col">
            <div class="d-flex">
              <p>単価</p>
              <button class="sort btn btn-secondary ml-1" id="sort-price-asc">↑</button>
              <button class="sort btn btn-secondary ml-1" id="sort-price-desc">↓</button>
            </div>
          </th>
          <th scope="col">
            <div class="d-flex">
              <p>作成日</p>
              <button class="sort btn btn-secondary ml-1" id="sort-created_at-asc">↑</button>
              <button class="sort btn btn-secondary ml-1" id="sort-created_at-desc">↓</button>
            </div>
          </th>
          
          <th scope="col">お気に入り</th>
          <th scope="col">アクション</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th scope="row"><?php echo e($item->id); ?></th>
            <td class="product_name"><?php echo e($item->product_name); ?></td>
            <td class="arrival_source"><?php echo e($item->arrival_source); ?></td>
            <td class="manufacturer"><?php echo e($item->manufacturer); ?></td>
            <td class="price"><?php echo e($item->price); ?></td>
            <td class="created_at"><?php echo e($item->created_at); ?></td>
            
            <td class="is_favorite"><?php echo e($item->is_favorite==1 ? '○' : '×'); ?></td>
            <td class="d-flex">
              <button type="button" class="item_delete_btn mr-3" data-toggle="modal" data-target="#modal_delete" data-name="<?php echo e($item->product_name); ?>" data-url="item/delete/<?php echo e($item->id); ?>">削除</button>
              <button type="button" class="mr-3" onclick="location.href='item/edit/<?php echo e($item->id); ?>'">編集</button>
              <?php if($item->is_favorite==0): ?>
                <button type="button" class="mr-3" onclick="location.href='<?php echo e(route('favorite.add', ['id' => $item->id])); ?>'">お気に入り追加</button>  
              <?php else: ?>
                <button type="button" class="mr-3" onclick="location.href=''<?php echo e(route('favorite.delete', ['id' => $item->id])); ?>'">お気に入り削除</button>
              <?php endif; ?>
              <input type="number" class="mr-3 item_num" name="item_num" min="0">
              <button type="button" data-id="<?php echo e($item->id); ?>" class="add_cart">カートに追加</button>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <div class="modal" tabindex="-1" role="dialog" id="modal_delete">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p>本当に<span id="item_delete_candidate_name"></span>を削除してもよろしいですか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            <button type="button" class="btn btn-danger" id="item_delete_execute">削除</button>
          </div>
        </div>
      </div>
    </div>

    <div>
      <?php echo e($items->appends(request()->query())->links()); ?>

    </div>
  </div>

<?php $__env->stopSection(); ?>
<script>
  window.onload = function(){
    headerMenu();
    function getParam(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    $("#item_search_btn").on("click", function () {
      const search_keyword=$("#item_search_input").val();
      location.href=`/items?keyword=${search_keyword}`;
    });
    $(".sort").on("click",function () { 
      const sort_key = $(this).attr('id').substr(5);
      const url = getParam('keyword') ? `${location.pathname}?keyword=${getParam('keyword')}&sort=${sort_key}` : `${location.pathname}&sort=${sort_key}`;
      location.href = url;
    });
    $("#modal_delete").on('shown.bs.modal', function(event){
      const button = $(event.relatedTarget);
      const product_name = button.data('name');
      const url = button.data('url');
      $('#item_delete_candidate_name').text(product_name);
      $('#item_delete_execute').on('click', function(){
        location.href = url;
      });
    });
    $(".add_cart").click(function(){
      const target_num = $(this).parent().children(".item_num");
      if (!target_num.val()){
        target_num.val(1);
      }
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/cart/add",
        type: "POST",
        data:{
          'user_id': <?php echo e(Auth::user()["id"]); ?>,
          'product_id': $(this).data('id'),
          'item_num': target_num.val()
        }
      }).done(function (data) {
        $("#err_info").text(data);
        target_num.val("");
      }).fail(function(data){
        $("#err_info").text(data);
      });
      
    });
  }


</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/items/index.blade.php ENDPATH**/ ?>