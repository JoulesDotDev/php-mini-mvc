<?php

$cards = [
    [
        "title" => "All Cards",
        "description" => "View all cards",
        "link" => "/admin/cards",
        "icon" => "bi bi-book"
    ],
    [
        "title" => "Manage card",
        "description" => "View and edit a card",
        "link" => "/admin/card/manage",
        "icon" => "bi bi-book"
    ],
    [
        "title" => "Borrowed books",
        "description" => "View books borrowed by a card",
        "link" => "/admin/card/books",
        "icon" => "bi bi-book"
    ]
];

Component("Cards", ["cards" => $cards, "back" => true]);
