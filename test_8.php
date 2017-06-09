<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/data/resizable.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Test 8</title>
    <style>
        html,
        body {
            height: 100%;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            padding: 0;
            margin: 0;
            overflow: auto;
        }
        .container-fluid,.row{
            height: 100%;
        }
        .panel-container{
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 100%;
        }
        .panel-left{
            height: 100%;
            background: rgb(52, 77, 138);
            color: white;
            position: relative;
            word-wrap: break-word;
        }
        .panel-right{
            height: 100%;
            width: 100%;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        .panel-top{
            background: #ccc;
            position: relative;
        }
        .panel-top,.panel-bottom{
            width: 100%;
            height: 50%;
        }
        .splitter{
            background: rgb(155, 155, 155) url("/images/vsizegrip.png") center center no-repeat;
            width: 10px;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            cursor: col-resize;
        }
        .splitter-horizontal{
            background: rgb(155, 155, 155) url("/images/hsizegrip.png") center center no-repeat;
            height: 10px;
            width: 100%;
            position: absolute;
            right: 0;
            bottom: 0;
            cursor: row-resize;
        }
        .tab-content{
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="panel-container">
            <div class="panel-left" style="width: 30%;">
                <p>Содержимое левой панели</p>
                <div class="splitter"></div>
            </div>
            <div class="panel-right">
                <div class="panel-top">
                    <p>Содержимое правой панели</p>
                    <div class="splitter-horizontal"></div>
                </div>
                <div class="panel-bottom">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#one" aria-controls="one" role="tab" data-toggle="tab">Один</a>
                            </li>
                            <li role="presentation">
                                <a href="#two" aria-controls="two" role="tab" data-toggle="tab">Два</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="one">
                                <h4>Редактирование левой вкладки</h4>
                                <textarea id="text_1" cols="100" rows="4"></textarea>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="two">
                                <h4>Редактирование верхней вкладки</h4>
                                <textarea id="text_1" cols="100" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".panel-left").resizable({
        handleSelector: ".splitter",
        resizeHeight: false
    });
    $(".panel-top").resizable({
        handleSelector: ".splitter-horizontal",
        resizeWidth: false
    });
    $('#one textarea').on('keyup',function (e) {
        e.preventDefault();
        $('.panel-left > p').text($(this).val());
    });
    $('#two textarea').on('keyup',function (e) {
        e.preventDefault();
        $('.panel-top > p').text($(this).val());
    });
</script>
</body>
</html>