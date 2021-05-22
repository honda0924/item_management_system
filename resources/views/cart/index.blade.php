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
            <td class="manufacturer">{{$cart->price}}</td>
            <td class="item_num">{{$cart->item_num}}</td>
            <td class="amount">{{$cart->amount}}</td>
            <td class="d-flex">
              <button type="button" class="cart_delete_btn mr-3" data-name="{{$cart->id}}" data-url="cart/delete/{{$cart->id}}">削除</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>


  </div>

@endsection
