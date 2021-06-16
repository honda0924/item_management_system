@extends('layouts.app')

@section('content')
  <h4>出荷先登録</h4>
    <div id="shipping-error-info" class="alert alert-danger d-none">
    </div>
  <div class="w-50" id="ajax-contents">
      <div class="form-group">
        <label for="product_name">出荷先名(必須)</label>
        <input id="name" class="form-control" type="text" name="name">
      </div>
      <div class="form-group">
        <label for="address">住所(必須)</label>
        <input id="address" class="form-control" type="text" name="address">
      </div>
      <div class="form-group">
        <label for="tel">TEL(必須)
        </label>
        <input id="tel" class="form-control" type="text" name="manufacturer">
      </div>
      <button id="shipping-register" class="btn btn-primary">登録</button>
  </div>
  <div id="ajax-confirm"></div>
  <div id="ajax-finished"></div>
  


@endsection
<script>
  window.onload = function(){
    headerMenu();
    function registerListen() {
      document.querySelector('#shipping-register').addEventListener("click", function () {
        $("#shipping-error-info").addClass('d-none');
        $("#shipping-error-info").empty();
        const shipping_name = $("#name").val();
        const shipping_address = $("#address").val();
        const shipping_tel = $("#tel").val();
        const inputHTML = `<div class="form-group">
                            <label for="product_name">出荷先名(必須)</label>
                            <input id="name" class="form-control" type="text" name="name" value="${shipping_name}">
                          </div>
                          <div class="form-group">
                            <label for="address">住所(必須)</label>
                            <input id="address" class="form-control" type="text" name="address" value="${shipping_address}">
                          </div>
                          <div class="form-group">
                            <label for="tel">TEL(必須)</label>
                            <input id="tel" class="form-control" type="text" name="manufacturer" value="${shipping_tel}">
                          </div>
                            <button id="shipping-register" class="btn btn-primary">登録</button>
                          </div>
                          `;

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
        $("#ajax-contents").empty();
        $("#ajax-confirm").append(confirmHTML);
        window.history.pushState(null, null, '/shipping/confirm');
        window.addEventListener('popstate', function(event){
          // event.preventDefault();
          $("#ajax-confirm").empty();
          $("#ajax-contents").empty();
          $("#ajax-contents").append(inputHTML);
          window.history.replaceState(null, null,'/shipping/create');
          window.addEventListener('popstate',function(event){
            $("#ajax-confirm").empty();
            $("#ajax-contents").empty();
            $("#ajax-contents").append(inputHTML);
            window.history.pushState(null, null,'/shipping/confirm');
          });
          registerListen();
        });
        document.querySelector('#confirm-back').addEventListener("click", function () {
          $("#ajax-confirm").empty();
          $("#ajax-contents").append(inputHTML);
          window.history.replaceState(null, null,'/shipping/create');
          registerListen();
        });
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
                                  <a href="{{url('/items')}}">商品一覧に戻る</a>`;
            $("#ajax-confirm").remove();
            $("#ajax-finished").append(finishedHTML);
            window.history.replaceState(null, null,'/shipping/complete');
            window.addEventListener('popstate', function(event){
              $("#ajax-finished").empty();
              $("#ajax-contents").empty();
              $("#ajax-contents").append(inputHTML);
              window.history.replaceState(null, null,'/shipping/create');
              window.addEventListener('popstate',function(event){
                $("#ajax-finished").empty();
                $("#ajax-contents").empty();
                $("#ajax-contents").append(inputHTML);
                window.history.pushState(null, null,'/shipping/confirm');
              });
              registerListen();
            });

          }).fail(function(err){
            const responseError = JSON.parse(err.responseText).errors;
            let errorList = '';
            Object.keys(responseError).forEach(key => {
              errorList = `${errorList} <li>${responseError[key]}</li>`;
            });
            const errorHTML = `<ul>${errorList}</ul>`;
            $("#shipping-error-info").append(errorHTML);
            $("#shipping-error-info").removeClass('d-none');
            $("#ajax-confirm").empty();
            $("#ajax-contents").append(inputHTML);
            window.history.replaceState(null, null,'/shipping/create');
            registerListen();
            
          });

        });

      });
    }

    registerListen();



  };
  
</script>