@extends('layouts.app')

@section('content')
  <h4>出荷先登録</h4>
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
      $address = old('address');
      $tel = old('tel');
    ?>  
  @endif
  <div class="w-50" id="ajax-contents">
      <div class="form-group">
        <label for="product_name">出荷先名(必須)</label>
        <input id="name" class="form-control" type="text" name="name" value="{{ old('name')}}">
      </div>
      <div class="form-group">
        <label for="address">住所(必須)</label>
        <input id="address" class="form-control" type="text" name="address" value="{{ old('address')}}">
      </div>
      <div class="form-group">
        <label for="tel">TEL(必須)
        </label>
        <input id="tel" class="form-control" type="text" name="manufacturer" value="{{ old('tel')}}">
      </div>
      <button type="submit" class="btn btn-primary">登録</button>
  </div>


@endsection