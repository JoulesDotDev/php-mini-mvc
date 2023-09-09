<?php
$cards = $data["cards"];
$ajax = $data["ajax"] ?? false;
$back = $data["back"] ?? false;

if ($back) {
    $item = [
        "title" => "Back",
        "description" => "Go back to the previous page",
        "link" => "/admin",
        "icon" => "bi bi-arrow-left"
    ];

    array_unshift($cards, $item);
}

foreach ($cards as $index => $card) : ?>
    <a
        <?php if ($ajax) : ?>
        hx-get="<?= $card["link"] ?>"
        hx-target="#action-options"
        hx-push-url="false"
        <?php else : ?>
        href="<?= $card["link"] ?>"
        <?php endif; ?>>
        <div
            class="card bg-neutral text-neutral-content select-none hover:shadow-xl hover:opacity-75 hover:text-warning hover:cursor-pointer">
            <div class="card-body items-center text-center">
                <i class="<?= $card["icon"] ?> text-3xl"></i>
                <h2 class="card-title"><?= $card["title"] ?></h2>
                <p><?= $card["description"] ?></p>
            </div>
        </div>
    </a>
<?php endforeach; ?>