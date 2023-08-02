<?php

Component("BaseHeader", ["title" => "Login"]);

$values = $data["values"] ?? [];
$errors = $data["errors"] ?? [];
?>

<form action="/login" method="POST">
    <?= csrf() ?>
    <?= action("auth:login") ?>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
        <?php Component('Form/Error', $errors["email"] ?? "") ?>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
        <?php Component('Form/Error', $errors["password"] ?? "") ?>
    </div>

    <button type="submit">Login</button>

    <div><?php Component('Form/Error', $errors["credentials"] ?? "") ?></div>
</form>

<?php if ($errors["unverified"] ?? null) : ?>
    <form action="/verify-resend" method="POST">
        <?= csrf() ?>
        <?= action("auth:verify-resend") ?>
        <input type="hidden" name="email" value="<?= $values["email"] ?>">
        <p>Your email (<?= $values["email"] ?>) is not verified.</p>
        <button type="submit">Resend verification email</button>
    </form>
<?php endif; ?>

<?php

Component("BaseFooter");
