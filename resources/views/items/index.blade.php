@extends('layouts.app')

@section('content')
  <div class="d-flex">
    <h4>商品一覧</h4>
    <button onclick="location.href='/cart/show/{{Auth::user()["id"]}}'">カートを見る</button>
  </div>
  {{-- @foreach ($items as $item)
    <p>{{ $item->product_name }}</p>
  @endforeach --}}
  <div id="err_info"></div>
  <div>
    <table class="table col">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">商品名</th>
          <th scope="col">入荷元</th>
          <th scope="col">製造元</th>
          <th scope="col">単価</th>
          {{-- <th scope="col">作成日</th> --}}
          {{-- <th scope="col">更新日</th> --}}
          <th scope="col">お気に入り</th>
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
            <td class="manufacturer">{{$item->price}}</td>
            {{-- <td class="created_at">{{$item->created_at}}</td> --}}
            {{-- <td class="updated_at">{{$item->updated_at}}</td> --}}
            <td class="is_favorite">{{$item->is_favorite==1 ? '○' : '×'}}</td>
            <td class="d-flex">
              <button type="button" class="item_delete_btn mr-3" data-toggle="modal" data-target="#modal_delete" data-name="{{$item->product_name}}" data-url="item/delete/{{$item->id}}">削除</button>
              <button type="button" class="mr-3" onclick="location.href='item/edit/{{$item->id}}'">編集</button>
              @if ($item->is_favorite==0)
                <button type="button" class="mr-3" onclick="location.href='/favorite/add/{{$item->id}}'">お気に入り追加</button>  
              @else
                <button type="button" class="mr-3" onclick="location.href='/favorite/delete/{{$item->id}}'">お気に入り削除</button>
              @endif
              <input type="number" class="mr-3 item_num" name="item_num" min="0">
              <button type="button" data-id="{{$item->id}}" class="add_cart">カートに追加</button>
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
        $(".add_cart").click(function(){
          const target_num = $(this).parent().children(".item_num");
          if (!target_num.val()){
            target_num.val(1);
          }
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/cart/add",
            type: "POST",
            data:{
              'user_id': {{Auth::user()["id"]}},
              'product_id': $(this).data('id'),
              'item_num': target_num.val()
            }
          }).done(function (data) {
            $("#err_info").text(data);
            target_num.val("");
          }).fail(function(data){
            $("#err_info").text(data);
          })
          
        });
      }


    </script>
    <div>
      {{ $items->links() }}
    </div>
  </div>

@endsection
