@extends('layouts.app')

@section('content')
  <h4>商品一覧</h4>
  {{-- @foreach ($items as $item)
    <p>{{ $item->product_name }}</p>
  @endforeach --}}
  <div>
    <table class="table col">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">商品名</th>
          <th scope="col">入荷元</th>
          <th scope="col">製造元</th>
          <th scope="col">作成日</th>
          <th scope="col">更新日</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->product_name}}</td>
            <td>{{$item->arrival_source}}</td>
            <td>{{$item->manufacturer}}</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->update_at}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $items->links() }}
  </div>

@endsection
