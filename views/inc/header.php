<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?= TODOLIST_NAMESPACE ?></title>
    <meta name="author" content="Pierre-Henry Soria"/>
	<?php todo_header(); ?>
</head>

<body>
<div class="menu">
    <ul>
        <li><a href="<?= ROOT_URL ?>">Home</a></li>
        <li><a href="<?= ROOT_URL . '?p=admin&act=render' ?>">Admin</a></li>
    </ul>
</div>
