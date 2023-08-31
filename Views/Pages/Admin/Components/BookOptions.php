<?php

$cards = [
    [
        "title" => "All books",
        "description" => "Manage all library books",
        "link" => "/admin/books",
        "icon" => "bi bi-book"
    ],
    [
        "title" => "Add book",
        "description" => "Register a new book to the library",
        "link" => "/admin/book/insert",
        "icon" => "bi bi-plus"
    ],
    [
        "title" => "Borrowing",
        "description" => "Mark books as borrowed by a card",
        "link" => "/admin/books/borrow",
        "icon" => "bi bi-arrow-bar-up"
    ],
    [
        "title" => "Returning",
        "description" => "Return books from a certain card",
        "link" => "/admin/books/return",
        "icon" => "bi bi-arrow-bar-down"
    ],
    [
        "title" => "Lost book",
        "description" => "Report a book as lost",
        "link" => "/admin/book/lost",
        "icon" => "bi bi-question"
    ]
];

Component("Cards", ["cards" => $cards, "back" => true]);
