<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Short links</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-8">
                <input type="text" id="url" style="width: 100%">
            </div>
            <div class="col-4">
                <button style="width: 100%" onclick="ajaxReq($('#url').val())">Сократить ссылку</button>
            </div>
        </div>
        <div class="row">
            @foreach($links as $link)
                <div class="col-12">
                    <a href="/{{$link['link']}}">{{$link['link']}}</a> - [{{$link['url']}}]
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function ajaxReq(url) {
            $.ajax({
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajaxRequest',
                data:{'url':url},
                success:function(data){
                    data=JSON.parse(data);
                    location.reload();
                }
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </body>
</html>
