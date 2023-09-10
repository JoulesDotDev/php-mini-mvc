<?php

$cards = [
    [
        "title" => "Manage Books",
        "description" => "Everything about books",
        "link" => "/admin?manage=books",
        "icon" => "bi bi-book"
    ],
    [
        "title" => "Manage Cards",
        "description" => "Everything about cards",
        "link" => "/admin?manage=cards",
        "icon" => "bi bi-credit-card",
    ]
]
?>

<h1 class="text-5xl font-bold text-center mt-10 md:mt-20">Admin</h1>

<div id="action-options" class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10 md:mt-20">
    <?php Component("Cards", ["cards" => $cards, "ajax" => true]) ?>
</div>