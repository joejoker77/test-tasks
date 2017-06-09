<?php if(!empty($_POST['get_text'])){

    if(file_exists(__DIR__.trim($_POST['get_text']))){

        $f_content = file_get_contents(__DIR__.trim($_POST['get_text']));
        die(json_encode(['status' => 'success', 'message' => $f_content]));

    }else{

        die(json_encode(['status' => 'error', 'message' => 'file /data/text.txt not exists or permission denied']));
    }

} else { ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test 2</title>
</head>
<body>
    <textarea id="id1" cols="18" rows="10" placeholder="Click me"></textarea>
    <script>
        var textBlock = document.getElementById('id1');

        textBlock.onclick = function () {

            var xhr            = new XMLHttpRequest(),
                data           = {get_text: '/data/text.txt'},
                boundary       = String(Math.random()).slice(2),
                boundaryMiddle = '--' + boundary + '\r\n',
                boundaryLast   = '--' + boundary + '--\r\n',
                body           = ['\r\n'];

            for (var key in data) {
                body.push('Content-Disposition: form-data; name="' + key + '"\r\n\r\n' + data[key] + '\r\n');
            }

            body = body.join(boundaryMiddle) + boundaryLast;
            xhr.open('POST', '/test_2.php', true);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);

            xhr.onreadystatechange = function() {

                if(this.readyState !== 4)
                    return;

                if (xhr.status === 200) {
                    try{
                        var answer = JSON.parse(xhr.responseText);
                        textBlock.textContent = answer.message;
                    }catch (e){
                        console.log(e.message);
                    }
                }
            };
            xhr.send(body);
            return false;
        }
    </script>
</body>
</html>
<?php
}