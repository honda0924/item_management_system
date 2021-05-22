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
          <tr>
            <td class="product_name">{{$cart->product_name}}</td>
            <td class="item_num">{{$cart->item_num}}</td>
            <td class="price">{{$cart->price}}</td>
            <td class="amount" data-num={{$cart->item_num}} data-price={{$cart->price}}></td>
            <td class="d-flex">
              <button type="button" class="cart_delete_btn mr-3" data-name="{{$cart->id}}" data-url="cart/delete/{{$cart->id}}">削除</button>
            </td>
          </tr>
        @endforeach
          <tr>
            <td>合計</td>
            <td id="item_num_sum"></td>
            <td></td>
            <td id="total_amount"></td>
            <td>
              <button>購入</button>
            </td>
          </tr>
      </tbody>
    </table>
    <script>
      window.onload = function(){
        let total_amount = 0;
        let item_num_sum = 0;
        $(".amount").each(function(){
          const item_num = $(this).data('num');
          const price = $(this).data('price');
          const raw_amount = item_num * price;
          $(this).text(raw_amount);
          item_num_sum = item_num_sum + item_num;
          total_amount = total_amount + raw_amount;
        });
        $("#item_num_sum").text(item_num_sum);
        $("#total_amount").text(total_amount);
      }
    </script>

  </div>

@endsection
