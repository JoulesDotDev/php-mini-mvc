<?php

Component("BaseHeader", ["title" => "Home"]);
?>

<h1>Hey <?= $data["name"] ?>, Your Email is</h1>
<h2><?= $data["email"] ?></h2>

<p>Logout</p>
<form action="/logout" method="POST">
    <?= csrf() ?>
    <?= action("auth:logout") ?>

    <button type="submit">Logout</button>
</form>

<?php

Component("BaseFooter");
