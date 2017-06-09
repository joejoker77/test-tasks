<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test 3</title>
    <style>
        html,body{
            position: relative;
            width: 100%;
            height: 100%;
        }
        #outer {
            padding:10px;
            border:none;
            position:absolute;
            float:left;
            top: 0;
            left: 0;
        }
        #inner {
            border-radius:7px;
            padding:2px;
            text-align:center;
        }
    </style>
</head>
<body>
<div id="outer">
    <textarea id="inner">Catch me! )))</textarea>
</div>
<script>
    function jump(el) {

        var docHeight = (typeof document.height !== 'undefined') ? document.height : document.body.offsetHeight,
            docWidth  = (typeof document.width !== 'undefined') ? document.width : document.body.offsetWidth;

        el.style.top  = Math.floor(Math.random()*(docHeight - 60)) + 'px';
        el.style.left = Math.floor(Math.random()*(docWidth - 200)) + 'px';
    }

    window.onload = function () {
        document.getElementById('outer').onmouseover = function () {
            jump(this);
            return false;
        };
    };
</script>
</body>
</html>
