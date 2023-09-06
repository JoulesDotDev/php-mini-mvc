<!DOCTYPE html>
<html data-theme="business">

<head>
    <title><?= _CONTEXT("page", "title") ?></title>
    <script src="https://unpkg.com/htmx.org@1.9.4" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/morph@3.x.x/dist/cdn.min.js"></script>

    <script src="//<?= BASE_URL ?>/static/scripts/main.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.6.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="//<?= BASE_URL ?>/static/css/main.css" rel="stylesheet" type="text/css" />
</head>

<body id="#body" hx-boost="true">
    <?php Component("/Layout/Navbar"); ?>
    <div class="container mx-auto p-6">