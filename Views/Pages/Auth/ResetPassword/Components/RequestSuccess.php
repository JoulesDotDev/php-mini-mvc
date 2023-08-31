<?php
$email = _CONTEXT("email");
?>

<div class="flex items-center justify-center mt-20">
    <div class="card bg-neutral card-compact w-120 bg-base-100 shadow-xl p-8">
        <h1 class="text-2xl font-bold">Change request successful</h1>
        <p class="mt-4">We sent an email to <b><?= __($email) ?></b> for you to change your password.</p>
    </div>
</div>