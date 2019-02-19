<?php
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= TODOLIST_NAMESPACE ?></title>
    <meta name="author" content="Thangpd"/>
	<?php todo_header(); ?>
</head>

<body>
<div class="menu">
    <ul>
        <li><a href="<?= ROOT_URL ?>">Home</a></li>
        <li><a href="<?= ROOT_URL . '?p=admin&act=render' ?>">Admin</a></li>
    </ul>
</div>
