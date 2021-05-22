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
              <button type="button" class="cart_delete_btn mr-3" data-id="{{$cart->id}}" data-url="/cart/delete/{{$cart->id}}">削除</button>
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
        $(".cart_delete_btn").click(function () {
          const target_id = $(this).data('id');
          console.log(target_id);
          const url = $(this).data('url');
          $.ajax({
            url: url,
            type: "GET",
          }).done(function (data) {
            $("tr").filter(
              function(){
                return ($(this).data('item') === target_id);
              }
            ).remove();
            set_calc_total();
          });
        });
      }
    </script>

  </div>

@endsection
