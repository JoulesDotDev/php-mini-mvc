<?php
$user = _CONTEXT("user");
?>

<h1>Hey <?= $user["name"] ?>, Your Email is</h1>
<h2><?= $user["email"] ?></h2>

<p>Logout</p>
<form action="/logout" method="POST">
    <?= csrf() ?>
    <?= action("auth:logout") ?>

    <button type="submit">Logout</button>
</form>