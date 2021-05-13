@extends('layouts.app')

@section('content')
  {{-- @foreach ($items as $item)
    <p>{{ $item->product_name }}</p>
  @endforeach --}}
  <div class="card">
    <div class="card-header">マイページ</div>
    <div class="card-body">
        <ul>
          <li>
            <h4>ユーザー情報</h4>
            <div>{{$user["id"]}} </div>
            <div>{{$user["login_id"]}} </div>
            <div>{{$user["name"]}} </div>
            <div>{{$user["email"]}} </div>

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
