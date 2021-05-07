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
          <th scope="col">アクション</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($items as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td class="product_name">{{$item->product_name}}</td>
            <td class="arrival_source">{{$item->arrival_source}}</td>
            <td class="manufacturer">{{$item->manufacturer}}</td>
            <td class="created_at">{{$item->created_at}}</td>
            <td class="updated_at">{{$item->updated_at}}</td>
            <td class="d-flex">
              <button type="button" class="item_delete_btn mr-3" data-toggle="modal" data-target="#modal_delete" data-name="{{$item->product_name}}" data-url="item/delete/{{$item->id}}">削除</button>
              <button type="button" onclick="location.href='item/edit/{{$item->id}}'">編集</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="modal" tabindex="-1" role="dialog" id="modal_delete">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p>本当に<span id="item_delete_candidate_name"></span>を削除してもよろしいですか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            <button type="button" class="btn btn-danger" id="item_delete_execute">削除</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      window.onload = function(){
        $("#modal_delete").on('shown.bs.modal', function(event){
          const button = $(event.relatedTarget);
          const product_name = button.data('name');
          const url = button.data('url');
          $('#item_delete_candidate_name').text(product_name);
          $('#item_delete_execute').on('click', function(){
            location.href = url;
          });

          
        });
      }

    </script>
    <div>
      {{ $items->links() }}
    </div>
  </div>

@endsection
