@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">メニュー</div>
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{url('/items')}}">商品一覧</a>
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
        </div>
    </div>
</div>
@endsection
