@extends('layouts.app')

  @section('content')
    <h4>お問い合わせフォーム</h4>
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>

  @endif
  <div class="w-50">
    <form method="post" action="{{ url('/inquiry/post') }}">
      @csrf
      <div class="form-group">
        <label for="inquirer_name">お名前(必須)</label>
        <input id="inquirer_name" class="form-control" type="text" name="inquirer_name" value="{{ old('inquirer_name') }}">
      </div>
      <div class="form-group">
        <label for="email">メールアドレス(必須)</label>
        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}">
      </div>
      <div class="form-group">
        <label for="tel">電話番号(ハイフン不要、必須)</label>
        <input id="tel" class="form-control" type="text" name="tel" value="{{ old('tel') }}">
      </div>
      <div class="form-group">
        <label>性別</label>
        <div class="d-flex">
          <input type="radio" name="gender" id="male" value="{{ old('gender') }}" checked>男性
          <input type="radio" name="gender" id="female" value="{{ old('gender') }}" >女性
        </div>
        <div class="form-group" id="male-hobby">
          <label for="hobby">趣味</label>
          <input id="hobby" class="form-control" type="text" name="hobby" value="{{ old('hobby') }}">
        </div>
        
        <div class="form-group d-none" id="female-skill">
          <label for="skill">特技</label>
          <input id="skill" class="form-control" type="text" name="skill" value="{{ old('skill') }}">
        </div>
      </div>
      <div class="form-group">
        <label for="inquiry_text">お問い合わせ内容(必須)</label>
        <textarea name="inquiry_text" rows="10" cols="40" id="inquiry_text" class="form-control">{{ old('inquiry_text') }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">送信</button>
    </form>
  </div>

  <script>
    window.onload = function(){
      if ($('input:radio[name="gender"]').val()==="女性") {
        $('#female').trigger('click');
        $('#female-skill').removeClass("d-none");
        $('#male-hobby').addClass("d-none");
      } else {
        $('#male').trigger('click');
        $('#female-skill').addClass("d-none");
        $('#male-hobby').removeClass("d-none");
      }
      $('#female').click(function(){
          $('#female-skill').removeClass("d-none");
          $('#male-hobby').addClass("d-none");
          $('input:radio[name="gender"]').val("女性");
      });
      $('#male').click(function(){
          $('#female-skill').addClass("d-none");
          $('#male-hobby').removeClass("d-none");
          $('input:radio[name="gender"]').val("男性");
      });
    }
  </script>


@endsection