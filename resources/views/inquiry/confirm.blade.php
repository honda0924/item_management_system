@extends('layouts.app')

@section('content')
  <h4>メール送信確認</h4>
  <h6>以下の内容で送信します。よろしいですか？</h6>

  <div class="w-50">
    <form method="post" action="{{ url('/inquiry/send') }}">
      @csrf
      <div class="form-group">
        <label>お名前</label>
        <div>{{ $input["inquirer_name"] }}</div>
      </div>
      <div class="form-group">
        <label>メールアドレス</label>
        <div>{{ $input["email"] }}</div>
      </div>
      <div class="form-group">
        <label>電話番号</label>
        <div>{{ $input["tel"] }}</div>
      </div>
      <div class="form-group">
        <label>お問い合わせ内容</label>
        <div>{{ $input["inquiry_text"] }}</div>
      </div>
      <button type="submit" name="back" class="btn btn-secondary">戻る</button>
      <button type="submit" class="btn btn-primary">登録</button>
    </form>
  </div>


@endsection