@extends('layouts.app')

@section('content')
  <h4>出荷先編集</h4>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    <?php
      $name = old('name');
      $arrival_source = old('address');
      $tel = old('tel');
    ?>  
  @endif
  <div class="w-50">
    <form method="post" action="{{ route('shipping.edit_post') }}">
      @csrf
      <input type="hidden" name="id" value="{{ old('id') ?? $shipping->id}}">
      <div class="form-group">
        <label for="name">出荷先名</label>
        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') ?? $shipping->product_name}}">
      </div>
      <div class="form-group">
        <label for="address">住所</label>
        <input id="address" class="form-control" type="text" name="address" value="{{ old('address') ?? $shipping->address}}">
      </div>
      <div class="form-group">
        <label for="tel">TEL</label>
        <input id="tel" class="form-control" type="text" name="tel" value="{{ old('tel') ?? $shipping->tel}}">
      </div>
      <button type="submit" class="btn btn-primary">更新</button>
    </form>
  </div>


@endsection