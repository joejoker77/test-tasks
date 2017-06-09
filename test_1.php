<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test 1</title>
</head>
<body>
    <script>
        var arr = ['one', 'two', 'three'];
        function array_flip(arr){
            var i,res = {};
            for(i in arr) {
                res[arr[i]] = i;
            }
            return res;
        }
        console.log(array_flip(arr));
    </script>
</body>
</html>