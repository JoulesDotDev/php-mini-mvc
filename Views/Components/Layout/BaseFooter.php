<?php
require_once "Data.php";
$links = navbarLinks();
?>

</div>
</div>
<div class="drawer-side">
    <label for="my-drawer-3" class="drawer-overlay"></label>
    <ul class="menu p-4 w-80 min-h-full bg-base-200">
        <?php foreach ($links as $name => $link) : ?>
            <li>
                <a href="<?= $link ?>" class="btn btn-ghost flex content-center <?= PATH === $link ? "active" : "" ?>">
                    <?= $name ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</div>
</body>

</html>