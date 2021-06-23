{{$inquiry["inquirer_name"]}}様
以下の内容でお問い合わせを承りました。

email:{{$inquiry["email"]}}
tel:{{$inquiry["tel"]}}
性別:{{$inquiry["gender"]}}
@if ($inquiry["gender"]=="男性")
    趣味:{{$inquiry["hobby"]}}
@else
    特技:{{$inquiry["skill"]}}
@endif
お問い合わせ内容：{{$inquiry["inquiry_text"]}}