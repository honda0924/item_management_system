@extends('layouts.app')

@section('content')
  <h4>出荷先登録</h4>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    <?php
      $name = old('name');
      $address = old('address');
      $tel = old('tel');
    ?>  
  @endif
  <div class="w-50" id="ajax-contents">
      <div class="form-group">
        <label for="product_name">出荷先名(必須)</label>
        <input id="name" class="form-control" type="text" name="name" value="{{ old('name')}}">
      </div>
      <div class="form-group">
        <label for="address">住所(必須)</label>
        <input id="address" class="form-control" type="text" name="address" value="{{ old('address')}}">
      </div>
      <div class="form-group">
        <label for="tel">TEL(必須)
        </label>
        <input id="tel" class="form-control" type="text" name="manufacturer" value="{{ old('tel')}}">
      </div>
      <button id="shipping-register" class="btn btn-primary">登録</button>
  </div>
  <div id="ajax-confirm"></div>
  <div id="ajax-finished"></div>
  <script>
    window.onload = function(){
      $("#shipping-register").click(function(event){
        const shipping_name = $("#name").val();
        const shipping_address = $("#address").val();
        const shipping_tel = $("#tel").val();
        console.log(shipping_name);
        const confirmHTML = `<div class="form-group">
                              <label>出荷先名</label>
                              <div>${shipping_name}</div>
                            </div>      
                            <div class="form-group">
                              <label>住所</label>
                              <div>${shipping_address}</div>
                            </div>
                            <div class="form-group">
                              <label>TEL</label>
                              <div>${shipping_tel}</div>
                            </div>
                            <button id="confirm-back" class="btn btn-secondary">戻る</button>
                            <button id="confirm-register" class="btn btn-primary">登録</button>
                          `;
        $("#ajax-contents").remove();
        $("#ajax-confirm").append(confirmHTML);
        document.querySelector('#confirm-register').addEventListener("click", function () {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/shipping/add",
            type: "POST",
            data: {
              'name': shipping_name,
              'address': shipping_address,
              'tel': shipping_tel,
            },

          }).done(function(data){
            const finishedHTML = `<h3>登録完了</h3>
                                  <p>${data}</p>
                                  <a href="{{url('/items')}}">戻る</a>`;
            $("#ajax-confirm").remove();
            $("#ajax-finished").append(finishedHTML);
          }).fail(function(err){
            console.log(err);
          });
          ;

        });

      });


    };
    
  </script>


@endsection