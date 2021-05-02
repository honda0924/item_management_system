@extends('layouts.app')

@section('content')
  <h4>商品登録</h4>
  <h6>以下の内容で登録します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="{{ url('/item/send') }}">
      @csrf
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
      {{-- <div class="form-group">
        <label>金額</label>
        <div>{{ $input["price"] }}</div>
      </div> --}}
      <div class="form-group">
        <label>メールアドレス</label>
        <div>{{ $input["email"] }}</div>
      </div>
      <div class="form-group">
        <label>電話番号</label>
        <div>{{ $input["tel"] }}</div>
      </div>
      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">登録</button>
    </form>
  </div>


@endsection