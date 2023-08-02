<?php

Component("BaseHeader", ["title" => "Register"]);

$values = $data["values"] ?? [];
$errors = $data["errors"] ?? [];

?>

<form action="/register" method="POST">
    <?= csrf() ?>
    <?= action("auth:register") ?>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
        <?php Component('Form/Error', $errors["email"] ?? "") ?>
    </div>

    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name" value="<?= $values["name"] ?? "" ?>">
        <?php Component('Form/Error', $errors["name"] ?? "") ?>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
        <?php Component('Form/Error', $errors["password"] ?? "") ?>
    </div>

    <div>
        <label for="verify_password">Verify password</label>
        <input type="password" id="verify_password" name="verify_password" placeholder="Verify password" value="<?= $values["verify_password"] ?? "" ?>">
        <?php Component('Form/Error', $errors["verify_password"] ?? "") ?>
    </div>

    <button type="submit">Register</button>
</form>

<?php

Component("BaseFooter");
