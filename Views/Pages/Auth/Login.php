<?php

Component("BaseHeader", ["title" => "Login"]);

$values = $data["values"] ?? [];
$errors = $data["errors"] ?? [];
?>

<form action="/login" method="POST">
    <input type="hidden" name="action" value="auth:login">

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
        <?php Component('FormError', $errors["email"] ?? "") ?>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
        <?php Component('FormError', $errors["password"] ?? "") ?>
    </div>

    <button type="submit">Login</button>

    <div><?php Component('FormError', $errors["credentials"] ?? "") ?></div>
</form>

<?php

Component("BaseFooter");
