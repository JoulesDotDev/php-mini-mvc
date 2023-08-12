<?php
$reset = _CONTEXT("reset") ?? false;

if (_CONTEXT("success")) {
    if ($reset) return Component("ResetSuccess");
    else return Component("RequestSuccess");
}

$errors = _CONTEXT("result", "errors") ?? [];
?>

<form method="POST">
    <?= csrf() ?>

    <?php
    if ($reset) Component("PasswordFields");
    else Component("EmailField");
    ?>

    <button type="submit">Submit</button>

    <div><?php Component('FormShared/Error', $errors["token"] ?? "") ?></div>
</form>