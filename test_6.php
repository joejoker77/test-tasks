<?php
$host    = '127.0.0.1';
$db      = 'test_tasks';
$user    = 'root';
$pass    = 'Db505Db';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo  = new PDO($dsn, $user, $pass, $opt);
$stmt = $pdo->prepare('SELECT b.title, a.name, a.aliases, a.creativity_years, a.prize, b.genre, b.publishing, b.price FROM book as b, author as a WHERE b.author = a.id');
$stmt->execute();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Test 6</title>
</head>
<body>
<div class="container">
    <div class="row">
        <h1>Данные из таблиц book и author</h1>
        <table class="table table-stripped table-bordered">
            <tr>
                <th>Наименование</th>
                <th>Автор</th>
                <th>Псевдонимы автора</th>
                <th>Годы творчества</th>
                <th>Премии</th>
                <th>Жанр</th>
                <th>Год первой публикации</th>
                <th>Цена</th>
            </tr>
            <?php
            while ($row = $stmt->fetch()) : ?>
                <tr>
                    <?php foreach ($row as $key => $value): ?>
                        <td><?php echo $value ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>