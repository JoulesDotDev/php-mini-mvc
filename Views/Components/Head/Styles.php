<!-- DaisyUI -->
<link href="https://cdn.jsdelivr.net/npm/daisyui@3.6.2/dist/full.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Custom Styles -->
<link href="//<?= BASE_URL ?>/static/css/main.css" rel="stylesheet" type="text/css" />
<!-- Dynamic CSS -->
<?php foreach ((_CONTEXT("_head", "styles") ?? []) as $style) : ?>
    <script src="//<?= BASE_URL ?>/static/css/<?= $style ?>.css"></script>
<?php endforeach; ?>