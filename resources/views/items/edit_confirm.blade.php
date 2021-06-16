@extends('layouts.app')

@section('content')
  <h4>商品更新</h4>
  <h6>以下の内容で更新します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="{{ route('item.update', $input["id"]) }}">
      @csrf
      <div class="form-group">
        <label>id</label>
        <div>{{ $input["id"] }}</div>
      </div>      
      <div class="form-group">
        <label>商品名</label>
        <div>{{ $input["product_name"] }}</div>
      </div>
      <div class="form-group">
        <label>入荷元</label>
        <div>{{ $input["arrival_source"] }}</div>
      </div>
      <div class="form-group">
        <label>製造元</label>
        <div>{{ $input["manufacturer"] }}</div>
      </div>
      <div class="form-group">
        <label>単価</label>
        <div>{{ $input["price"] }}</div>
      </div>

      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


@endsection