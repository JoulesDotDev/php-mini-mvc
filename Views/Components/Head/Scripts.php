<!-- HTMX -->
<script src="https://unpkg.com/htmx.org@1.9.4" crossorigin="anonymous"></script>
<script src="https://unpkg.com/htmx.org/dist/ext/head-support.js"></script>
<script src="https://unpkg.com/htmx.org/dist/ext/alpine-morph.js"></script>
<!-- Tailwind -->
<script defer src="https://cdn.tailwindcss.com"></script>
<!-- Alpine JS -->
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/morph@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- Custom Scripts -->
<script src="//<?= BASE_URL ?>/static/scripts/main.js"></script>
<!-- Dynamic Scripts -->
<?php foreach ((_CONTEXT("_head", "scripts") ?? []) as $script) : ?>
    <script src="//<?= BASE_URL ?>/static/scripts/<?= $script ?>.js"></script>
<?php endforeach; ?>