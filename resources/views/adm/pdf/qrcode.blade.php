<!doctype html>

<html lang="en">
<head>

    <title>Qr Code - Agendrix</title>
</head>
<body>


<style>
    body{
        font-family: system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        background-color: #cbd5e0;
    }
    div.inline { }
    .clearBoth { clear:both; }
    #content
    {
        background-color: snow;
        width: 65%;
        margin: 10% auto;
        padding-bottom: 30px;
    }
    #header{
        width: 80%;
        margin: 0 30%;
        padding-top: 5%;
    }
    #code{
        margin: 0 auto;
        width: 65%;
        border-radius: 16px;
        border: 1px solid #ccc!important;
        padding: 0.01em 16px;

    }
    #img{
        margin-top: 40px;
        margin-left: 45px;
        position: relative;
    }
</style>
<br>
<div id="content">

        <div id="header">
            <div class="inline"><h1>{{$data['company']}} &nbsp;&nbsp; &nbsp;&nbsp;</h1></div>
            <div class="inline">&nbsp;&nbsp;<img width="35%" src="{{$data['logo']}}"></div>
            <br class="clearBoth" /><!-- you may or may not need this -->
            <br>

        </div>
        <div id="code">
            <img id="img" src="data:image/png;base64, {!! $data['qrcode'] !!}">
            <p style="text-align: center">Aponte a camera do seu smartphone para o QrCode acima, e você será direcionado para a página de
                Agendamento Remoto do serviço:
                <br><strong>{{$data['act_name']}}</strong>
            </p>
            <p style="text-align: center">
                <br><strong>DICA:</strong> Você pode salvar o link nos favoritos do seu smartphone e
                agendar sempre que desejar.
            </p>


        </div>

</div>
</body>
</html>
