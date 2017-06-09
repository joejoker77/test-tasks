<?php
function renderTree($items) {
    $render = '<ul>';
    foreach ($items as $key => $item) {
        $render .= '<li>' . $key;
        if (is_array($item)) $render .= renderTree($item);
        $render .= '</li>';
    }
    return $render . '</ul>';
}

if(!empty($_FILES)){
    if($_FILES['file']['type'] !== 'application/json'){
        die(json_encode(['status' => 'error', 'message' => 'Некорректный тип файла']));
    }
    $jsonData = json_decode(file_get_contents($_FILES['file']['tmp_name']), true);
    die(json_encode(['status' => 'success', 'message' => renderTree($jsonData)]));
}else{
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/data/dropzone.js"></script>
    <link rel="stylesheet" href="/data/dropzone.css" />
    <title>Test 7</title>
</head>
<body>
<div class="container" style="width: 1170px;margin: 0 auto;">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Загрузка файлов</strong>
            </div>
            <div>
                <form id="upload-dropzone" class="dropzone" action="/test_7.php">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
            </div>
        </div>
        <div id="answer"></div>
    </div>
</div>
<script>
    Dropzone.options.uploadDropzone = {
        paramName: "file",
        maxFilesize: 2,
        accept: function(file, done) {
            done();
            var interval = setInterval(function () {
                if(typeof file.xhr !== 'undefined'){
                    clearInterval(interval);
                    renderAnswer(file.xhr.responseText);
                }
            }, 400);

            function renderAnswer(jsonAnswer){
                try{
                    var answer = JSON.parse(jsonAnswer);
                    if(answer.status === 'error'){
                        alert(answer.status);
                    }else{
                        document.getElementById('answer').innerHTML = answer.message;
                    }
                }catch (e){
                    console.log(e.message);
                }
            }
        }
    };
</script>
</body>
</html>
<?php
}