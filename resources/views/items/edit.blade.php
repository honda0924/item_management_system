@extends('layouts.app')

@section('content')
  <h4>商品編集</h4>
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
    ?>  
  @endif
  <div class="w-50">
    <form method="post" action="{{ route('item.edit_post') }}">
      @csrf
      <input type="hidden" name="id" value="{{ old('id') ?? $item->id}}">
      <div class="form-group">
        <label for="product_name">商品名(必須)</label>
        <input id="product_name" class="form-control" type="text" name="product_name" value="{{ old('product_name') ?? $item->product_name}}">
      </div>
      <div class="form-group">
        <label for="arrival_source">入荷元</label>
        <input id="arrival_source" class="form-control" type="text" name="arrival_source" value="{{ old('arrival_source') ?? $item->arrival_source}}">
      </div>
      <div class="form-group">
        <label for="manufacturer">製造元</label>
        <input id="manufacturer" class="form-control" type="text" name="manufacturer" value="{{ old('manufacturer') ?? $item->manufacturer}}">
      </div>
      <div class="form-group">
        <label for="price">製造元</label>
        <input id="price" class="form-control" type="text" name="price" value="{{ old('price') ?? $item->price}}">
      </div>

      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


@endsection