<?php
$path = _FLASH("path");

if (strlen($path) > 20) {
    $path = substr($path, 0, 20) . "...";
}
?>

<div class="flex justify-center mt-20">
    <div class="w-120 text-center">
        <h1 class="text-9xl font-bold text-error">404</h1>
        <h2 class="text-2xl font-bold mt-20">The page you're looking for does not exist</h2>
        <p class="mt-8 font-bold bg-base-200 text-xl p-4"><?= $path ?></p>
    </div>
</div>