@extends('layouts.app')

@section('content')
  <h4>カート</h4>

  <div>
    <table class="table col">
      <thead>
        <tr>
          <th scope="col">商品名</th>
          <th scope="col">商品単価</th>
          <th scope="col">個数</th>
          <th scope="col">商品合計金額</th>
          <th scope="col">アクション</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($carts as $cart)
          <tr data-item={{$cart->id}}>
            <td class="product_name">{{$cart->product_name}}</td>
            <td class="item_num">{{$cart->item_num}}</td>
            <td class="price">{{$cart->price}}</td>
            <td class="amount" data-num={{$cart->item_num}} data-price={{$cart->price}}></td>
            <td class="d-flex">
              <button type="button" class="cart_delete_btn mr-3" data-toggle="modal" data-target="#modal_delete" data-id="{{$cart->id}}" data-name="{{$cart->product_name}}" data-url="/cart/delete/{{$cart->id}}">削除</button>
            </td>
          </tr>
        @endforeach
          <tr>
            <td>合計</td>
            <td id="item_num_sum"></td>
            <td></td>
            <td id="total_amount"></td>
            <td>
              <button type="button" id="btn-purchase" onclick="location.href='/cart/purchase'">購入</button>
            </td>
          </tr>
      </tbody>
    </table>
    <div class="modal" tabindex="-1" role="dialog" id="modal_delete">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p>本当に<span id="cart_delete_candidate_name"></span>を削除してもよろしいですか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            <button type="button" class="btn btn-danger" id="cart_delete_execute">削除</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      window.onload = function(){
        let item_num_sum = 0;
        function set_calc_total() {
          let item_num_sum = 0;
          let total_amount = 0;
          $(".amount").each(function(){
            item_num_sum = item_num_sum + $(this).data('num');
            total_amount = total_amount + $(this).data('num') * $(this).data('price');
          });
          $("#item_num_sum").text(item_num_sum);
          $("#total_amount").text(total_amount);
        }

        $(".amount").each(function(){
          const row_amount = $(this).data('num') * $(this).data('price')
          $(this).text(row_amount);
        });
        set_calc_total();
        $("#modal_delete").on('shown.bs.modal', function(event){
          const button = $(event.relatedTarget);
          const target_id = button.data('id');
          const product_name = button.data('name');
          const url = button.data('url');
          $('#cart_delete_candidate_name').text(product_name);
          $('#cart_delete_execute').on('click', function(){
            // location.href = url;
            $.ajax({
              url: url,
              type: "GET",
            }).done(function (data) {
              $("tr").filter(
                function(){
                  return ($(this).data('item') === target_id);
                }
              ) .remove();
              // $(this).parent().parent().remove();
              set_calc_total();
              $("#modal_delete").modal('hide');
             }).fail(function(data){
               console.log(data);
             });
          });
        });

      }
    </script>

  </div>

@endsection
