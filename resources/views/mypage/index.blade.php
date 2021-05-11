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
                <a href="{{url('/item/create')}}">商品登録</a>
            </li>
            <li>
                <a href="/inquiry">お問い合わせ</a>
            </li>
        </ul>
        
    </div>
</div>


@endsection
