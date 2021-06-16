@extends('layouts.app')

@section('content')
  <h4>ユーザー情報変更</h4>
  <h6>以下の内容で変更します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="{{ route('user.update', $input["id"]) }}">
      @csrf
      <div class="form-group">
        <label>ログイン名</label>
        <div>{{ $input["login_id"] }}</div>
      </div>      
      <div class="form-group">
        <label>ユーザー名</label>
        <div>{{ $input["name"] }}</div>
      </div>
      <div class="form-group">
        <label>メールアドレス</label>
        <div>{{ $input["email"] }}</div>
      </div>

      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">変更</button>
    </form>
  </div>


@endsection