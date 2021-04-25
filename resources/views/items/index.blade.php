@extends('layouts.app')

@section('content')
  <h4>商品一覧</h4>
  @foreach ($items as $item)
    <p>{{ $item }}</p>
  @endforeach
@endsection