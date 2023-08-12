<?php
$values = _CONTEXT("result", "values") ?? [];
$errors = _CONTEXT("result", "errors") ?? [];
?>

<?= action("auth:reset-submit") ?>

<input type="hidden" name="token" value="<?= _CONTEXT("token") ?>">

<div>
    <label for="password">New Password</label>
    <input type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
    <?php Component('FormShared/Error', $errors["password"] ?? "") ?>
</div>

<div>
    <label for="verify_password">Verify new password</label>
    <input type="password" id="verify_password" name="verify_password" placeholder="Verify password" value="<?= $values["verify_password"] ?? "" ?>">
    <?php Component('FormShared/Error', $errors["verify_password"] ?? "") ?>
</div>