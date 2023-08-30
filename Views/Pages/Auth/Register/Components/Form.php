<?php
$values = _CONTEXT("result", "values") ?? [];
$errors = _CONTEXT("result", "errors") ?? [];
?>

<div class="flex items-center justify-center mt-20">
    <form action="/register" method="POST" class="card bg-primary card-compact w-96 bg-base-100 shadow-xl h-min p-8">
        <?= csrf() ?>
        <?= action("auth:register") ?>

        <div>
            <label class="label" for="email">Email</label>
            <input class="input w-full" type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
            <?php Component('FormShared/Error', $errors["email"] ?? "") ?>
        </div>

        <div class="mt-4">
            <label class="label" for="name">Name</label>
            <input class="input w-full" type="text" id="name" name="name" placeholder="Name" value="<?= $values["name"] ?? "" ?>">
            <?php Component('FormShared/Error', $errors["name"] ?? "") ?>
        </div>

        <div class="mt-4">
            <label class="label" for="password">Password</label>
            <input class="input w-full" type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
            <?php Component('FormShared/Error', $errors["password"] ?? "") ?>
        </div>

        <div class="mt-4">
            <label class="label" for="verify_password">Verify password</label>
            <input class="input w-full" type="password" id="verify_password" name="verify_password" placeholder="Verify password" value="<?= $values["verify_password"] ?? "" ?>">
            <?php Component('FormShared/Error', $errors["verify_password"] ?? "") ?>
        </div>

        <button class="btn btn-secondary btn-active mt-8 btn-sm" type="submit">Register</button>
    </form>