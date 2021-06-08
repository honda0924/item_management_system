@extends('layouts.app')

  @section('content')
    <h4>お問合せ内容のダウンロード</h4>
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
    <form method="post" action="{{ url('/inquiry/download') }}">
      @csrf
      <div class="form-group">
        <label for="inquirer_name">お問い合わせ（年）(必須)</label>
        <input id="inquirer_name" class="form-control" type="number" name="inquiry_year" required>
      </div>
      <div class="form-group">
        <label for="email">お問い合わせ（月）(必須)</label>
        <input id="email" class="form-control" type="number" name="inquiry_month" required>
      </div>
      <button type="submit" class="btn btn-primary">ダウンロード</button>
    </form>
  </div>


@endsection