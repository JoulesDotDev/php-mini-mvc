<?php
$values = _CONTEXT("result", "values") ?? [];
$errors = _CONTEXT("result", "errors") ?? [];
?>

<?= action("auth:reset-request") ?>

<div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
    <?php Component('FormShared/Error', $errors["email"] ?? "") ?>
</div>