<?php

Component("BaseHeader", ["title" => "Home"]);

$email = $data->email ?? "";
?>

<h1>Your Email is</h1>
<h2><?= $email ?></h2>

<p>Logout</p>
<form action="/logout" method="POST">
    <?= csrf() ?>
    <input type="hidden" name="action" value="auth:logout">
    <button type="submit">Logout</button>
</form>

<?php

Component("BaseFooter");
