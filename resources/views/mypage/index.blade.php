@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">マイページ</div>
    <div class="card-body">
        <ul>
          <li>
            <div class="d-flex">
              <h4>ユーザー情報</h4>
              <button type="button" class="mr-3" data-toggle="modal" data-target="#modal_user_edit">ユーザー情報変更</button>
              <button type="button" onclick="location.href='password/change'">パスワード変更</button>
            </div>
            <div>login_id:{{$user["login_id"]}} </div>
            <div>ユーザー名:{{$user["name"]}} </div>
            <div>email:{{$user["email"]}} </div>
            <div class="modal" tabindex="-1" role="dialog" id="modal_user_edit">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <form method="post" action="{{ route('user.edit_post') }}">
                      @csrf
                      <input type="hidden" name="id" value="{{$user['id']}}">
                      <input type="hidden" name="login_id" value="{{ $user['login_id']}}">
                    
                      <div class="form-group">
                        <label for="name">ユーザー名</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{$user['name']}}">
                      </div>
                      <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input id="email" class="form-control" type="text" name="email" value="{{$user['email']}}">
                      </div>
                
                      <button type="submit" class="btn btn-primary">変更</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                  </div>
                </div>
              </div>
            </div>

          </li>
            <li>
              <h4>ログ一覧</h4>
              <div>
                <table class="table col">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">email</th>
                      <th scope="col">tel</th>
                      <th scope="col">information</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($logs as $log)
                      <tr>
                        <th scope="row">{{$log->id}}</th>
                        <td class="email">{{$log->email}}</td>
                        <td class="tel">{{$log->tel}}</td>
                        <td class="information">{{$log->information}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </li>

            <li>
              <h4>お気に入り一覧</h4>
              <div>
                <table class="table col">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">商品名</th>
                      <th scope="col">入荷元</th>
                      <th scope="col">製造元</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($favorites as $favorite)
                      <tr>
                        <th scope="row">{{$favorite->id}}</th>
                        <td class="product_name">{{$favorite->product_name}}</td>
                        <td class="arrival_source">{{$favorite->arrival_source}}</td>
                        <td class="manufacturer">{{$favorite->manufacturer}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </li>
        </ul>
        
    </div>
</div>


@endsection
