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
    <div
        hx-get="<?= $card["link"] ?>"
        hx-target="<?= $ajax ? '#action-options' : 'body' ?>"
        hx-push-url="<?= $ajax ? 'false' : 'true' ?>"
        class="card bg-neutral text-neutral-content select-none hover:shadow-xl hover:opacity-75 hover:text-warning hover:cursor-pointer">
        <div class="card-body items-center text-center">
            <i class="<?= $card["icon"] ?> text-3xl"></i>
            <h2 class="card-title"><?= $card["title"] ?></h2>
            <p><?= $card["description"] ?></p>
        </div>
    </div>
<?php endforeach; ?>