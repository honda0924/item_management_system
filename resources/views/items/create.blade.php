@extends('layouts.app')

@section('content')
  <h4>商品登録</h4>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ error }}</li>
        @endforeach
      </ul>
    </div>
    <?php
      $product_name = old('product_name');
      $arrival_source = old('arrival_source');
      $manufacturer = old('manufacturer');
      $price = old('price');
    ?>  
  @endif
  <div class="w-50">
    <form method="post" action="{{ url('/item/store') }}">
      @csrf
      <div class="form-group">
        <label for="product_name">商品名(必須)</label>
        <input id="product_name" class="form-control" type="text" name="product_name">
      </div>
      <div class="form-group">
        <label for="product_name">入荷元</label>
        <input id="product_name" class="form-control" type="text" name="product_name">
      </div>
      <div class="form-group">
        <label for="product_name">製造元</label>
        <input id="product_name" class="form-control" type="text" name="product_name">
      </div>
      <div class="form-group">
        <label for="product_name">メールアドレス(必須)</label>
        <input id="product_name" class="form-control" type="email" name="product_name">
      </div>
      <div class="form-group">
        <label for="product_name">電話番号(ハイフン不要、必須)</label>
        <input id="product_name" class="form-control" type="text" name="product_name">
      </div>
      <button type="submit" class="btn btn-primary">登録</button>
    </form>
  </div>


@endsection