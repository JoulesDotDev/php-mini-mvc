<?php
$user = _CONTEXT("user");
?>

<h1>Hey <?= __($user["name"]) ?>, Your Email is</h1>
<h2><?= __($user["email"]) ?></h2>

<form action="/logout" method="POST">
    <?= csrf() ?>
    <?= action("auth:logout") ?>

    <button type="submit">Logout</button>
</form>