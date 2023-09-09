<!DOCTYPE html>
<html data-theme="business">

<head>
    <title><?= _CONTEXT("_head", "title") ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= _CONTEXT("_head", "description") ?? "Local Library" ?>">
    <meta name="csrf_token" content="<?= $_SESSION["csrf_token"] ?>">

    <?php Component("/Head/Scripts") ?>
    <?php Component("/Head/Styles") ?>
</head>

<body id="#body" hx-boost="true" hx-indicator=".htmx-progress" hx-ext="head-support">
    <?php Component("/Layout/Navbar") ?>
    <div class="page relative">
        <progress class="progress htmx-progress progress-success opacity-0 h-1 rounded-none w-full absolute"></progress>
        <div class="container mx-auto p-6">