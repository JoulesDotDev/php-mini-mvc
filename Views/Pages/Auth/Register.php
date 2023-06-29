<?php

LoadView("Layouts/BaseHeader", ["title" => "Register"]);

$values = $data["values"] ?? [];
$errors = $data["errors"] ?? [];
?>

<form action="/register" method="POST">
    <input type="hidden" name="action" value="auth:register">

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
        <?php if (isset($errors["email"])) { ?>
            <p><?= $errors["email"] ?></p>
        <?php } ?>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
        <?php if (isset($errors["password"])) { ?>
            <p><?= $errors["password"] ?></p>
        <?php } ?>
    </div>

    <div>
        <label for="verify_password">Verify password</label>
        <input type="password" id="verify_password" name="verify_password" placeholder="Verify password" value="<?= $values["verify_password"] ?? "" ?>">
        <?php if (isset($errors["verify_password"])) { ?>
            <p><?= $errors["verify_password"] ?></p>
        <?php } ?>
    </div>

    <button type="submit">Register</button>
</form>

<?php

LoadView("Layouts/BaseFooter");
