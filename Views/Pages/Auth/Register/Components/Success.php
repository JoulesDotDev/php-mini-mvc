<?php
$email = _CONTEXT("email");
?>

<div class="flex items-center justify-center mt-20">
    <div class="card bg-primary card-compact w-120 bg-base-100 shadow-xl p-8">
        <h1 class="text-2xl font-bold">Registration successful</h1>
        <p class="mt-4">Check your inbox for an email verification link.</p>
        <div class="mt-12">
            <form action="/verify-resend" method="POST">
                <?= csrf() ?>
                <?= action("auth:verify-resend") ?>
                <input type="hidden" name="email" value="<?= $email ?>">
                <div class="font-bold text-sm">Didn't receive an Email?</div>
                <button class="btn btn-active btn-error btn-sm mt-2" type="submit">Resend verification email</button>
            </form>
        </div>
    </div>
</div>