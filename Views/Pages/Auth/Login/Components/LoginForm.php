<?php
$values = _CONTEXT("result", "values") ?? [];
$errors = _CONTEXT("result", "errors") ?? [];
$unverified = $errors["unverified"] ?? false;
?>

<?php if ($unverified) : ?>
    <form action="/verify-resend" method="POST">
        <?= csrf() ?>
        <?= action("auth:verify-resend") ?>
        <input type="hidden" name="email" value="<?= $values["email"] ?>">
        <p>Your email has not been verified.</p>
        <button class="btn btn-active btn-error btn-sm mt-4" type="submit">Resend verification email</button>
    </form>
<?php endif; ?>

<form hx-post="/login" hx-target="#login-form" class="<?= $unverified ? "mt-8" : "" ?>">
    <?= csrf() ?>
    <?= action("auth:login") ?>

    <div>
        <label class="label" for="email">Email</label>
        <input class="input w-full" type="email" id="email" name="email" placeholder="Email" value="<?= $values["email"] ?? "" ?>">
        <?php Component('FormShared/Error', $errors["email"] ?? "") ?>
    </div>

    <div class="mt-4">
        <label class="label" for="password">Password</label>
        <input class="input w-full" type="password" id="password" name="password" placeholder="Password" value="<?= $values["password"] ?? "" ?>">
        <?php Component('FormShared/Error', $errors["password"] ?? "") ?>
    </div>

    <button class="btn btn-secondary btn-active mt-8 btn-sm" type="submit">Login</button>

    <div><?php Component('FormShared/Error', $errors["credentials"] ?? "") ?></div>

    <div class="mt-10 text-right">
        <a class="link link-warning link-hover" href="/reset-password">Forgot password?</a>
    </div>
</form>