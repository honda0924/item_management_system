@extends('layouts.app')

@section('content')
  <h4>商品更新</h4>
  <h6>以下の内容で更新します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="{{ route('shipping.update', $input["id"]) }}">
      @csrf
      <div class="form-group">
        <label>id</label>
        <div>{{ $input["id"] }}</div>
      </div>      
      <div class="form-group">
        <label>入荷先名</label>
        <div>{{ $input["name"] }}</div>
      </div>
      <div class="form-group">
        <label>住所</label>
        <div>{{ $input["address"] }}</div>
      </div>
      <div class="form-group">
        <label>TEL</label>
        <div>{{ $input[""] }}</div>
      </div>
      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


@endsection