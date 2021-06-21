@extends('layouts.app')

@section('content')
  <div class="d-flex">
    <h4>出荷先一覧</h4>
  </div>
  <div id="shippings_info"></div>
  <div>
    <table class="table col">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">出荷先名</th>
          <th scope="col">住所</th>
          <th scope="col">TEL</th>
          <th scope="col">アクション</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($shippings as $shipping)
          <tr>
            <th scope="row">{{$shipping->id}}</th>
            <td class="shippin_gname">{{$shipping->name}}</td>
            <td class="shipping_address">{{$shipping->address}}</td>
            <td class="shipping_tel">{{$shipping->tel}}</td>
            <td class="d-flex">
              <button type="button" class="shipping_delete_btn mr-3" data-toggle="modal" data-target="#modal_delete" data-name="{{$shipping->name}}" data-url="/shipping/delete/{{$shipping->id}}">削除</button>
              <button type="button" class="mr-3" onclick="location.href='/shipping/edit/{{$shipping->id}}'">編集</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="modal" tabindex="-1" role="dialog" id="modal_delete">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p>本当に<span id="shipping_delete_candidate_name"></span>を削除してもよろしいですか？</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            <button type="button" class="btn btn-danger" id="shipping_delete_execute">削除</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      window.onload = function(){
        $("#modal_delete").on('shown.bs.modal', function(event){
          const button = $(event.relatedTarget);
          const shipping_name = button.data('name');
          const url = button.data('url');
          $('#shipping_candidate_name').text(shipping_name);
          $('#shipping_delete_execute').on('click', function(){
            location.href = url;
          });
        });
      }


    </script>
    <div>
      {{ $shippings->links() }}
    </div>
  </div>

@endsection
