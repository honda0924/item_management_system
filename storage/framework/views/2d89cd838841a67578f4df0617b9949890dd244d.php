  <?php $__env->startSection('content'); ?>
    <h4>お問合せ内容のダウンロード</h4>
    
  <div id="download_info"></div>
  <div class="w-50">
    
      
      <div class="form-group">
        <label for="inquiry_year">お問い合わせ（年）(必須)</label>
        <input id="inquiry_year" class="form-control" type="number" name="inquiry_year" required>
      </div>
      <div class="form-group">
        <label for="inquiry_month">お問い合わせ（月）(必須)</label>
        <input id="inquiry_month" class="form-control" type="number" name="inquiry_month" required>
      </div>
      <button type="button" class="btn btn-primary" id="download_execute">ダウンロード</button>
    
  </div>
  <a id="download_link" style="display: none" download="inquirydata.csv">ダウンロード</a>


<?php $__env->stopSection(); ?>
<script>
  window.onload = function(){
    headerMenu();
    $('#download_execute').on('click', function(){
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: "/inquiry/download",
        type: "POST",
        data: {
          inquiry_year: $("#inquiry_year").val(),
          inquiry_month: $("#inquiry_month").val(),
        },
      }).done(function (data) {
        const bom = new Uint8Array([0xEF, 0xBB, 0xBF]);
        const blob = new Blob([bom, data], {"type" : "text/csv"});
        const downloadUrl = window.URL.createObjectURL(blob);
        if (window.navigator.msSaveBlob) { 
                    window.navigator.msSaveBlob(blob, "inquirydata.csv"); 
                } else {
                    document.getElementById("download_link").href = window.URL.createObjectURL(blob);
                
      }
        // $("#download_link").attr("href", downloadUrl);
        document.querySelector('#download_link').click();
        $("#download_info").text('ダウンロードファイルの作成が完了しました。');
      }).fail(function(err){
        $('#download_info').text(err.message);
      });
    });
  }
  
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/honda/dev/item_management_system/resources/views/inquiry/csv.blade.php ENDPATH**/ ?>