@extends('layouts.app')

@section('content')
  <h4>商品登録</h4>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
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
    <form method="post" action="{{ url('/item/post') }}">
      @csrf
      <div class="form-group">
        <label for="product_name">商品名(必須)</label>
        <input id="product_name" class="form-control" type="text" name="product_name" value="{{ old('product_name')}}">
      </div>
      <div class="form-group">
        <label for="arrival_source">入荷元</label>
        <input id="arrival_source" class="form-control" type="text" name="arrival_source" value="{{ old('arrival_source')}}">
      </div>
      <div class="form-group">
        <label for="manufacturer">製造元</label>
        <input id="manufacturer" class="form-control" type="text" name="manufacturer" value="{{ old('manufacturer')}}">
      </div>
      <div class="form-group">
        <label for="price">金額</label>
        <input id="price" class="form-control" type="text" name="price">
      </div>
      <div class="form-group">
        <label for="email">メールアドレス(必須)</label>
        <input id="email" class="form-control" type="email" name="email" value="{{ old('email')}}">
      </div>
      <div class="form-group">
        <label for="tel">電話番号(ハイフン不要、必須)</label>
        <input id="tel" class="form-control" type="text" name="tel" value="{{ old('tel')}}">
      </div>
      <button type="submit" class="btn btn-primary">登録</button>
    </form>
  </div>


@endsection
<script>
  window.onload = function(){
    headerMenu();
  }
</script>