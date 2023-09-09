<?php

require_once ROOT_DIR . "/Controllers/Utils/Validation/Validator.php";
require_once ROOT_DIR . "/Models/Book/Book.php";
require_once ROOT_DIR . "/Models/Author/Author.php";

function validate()
{
    $v = _POSTValues(
        [
            "id", "name", "isbn", "author_id", "amount", "borrowable",
            "borrow_days", "renewable_times", "overdue_rate"
        ]
    );

    $f = _FILEValues(["cover"]);

    $validator = new Validator();

    if (!is_null($v["id"])) {
        $validator->validate($v, "id")->id(Book::table(), "Book not found")->done();
    }
    $validator->validate($v, "name")->required()->done();
    $validator->validate($v, "isbn")->required()->lengths([10, 13], "ISBN")->unique(Book::table(), "isbn", "ISBN already exists")->done();
    $validator->validate($v, "author_id")->required()->exists(Author::table(), "id", "Author not found")->done();
    if (!is_null($f["cover"])) {
        $validator->validate($f, "cover")->image()->maxSize(1024 * 500)->done();
        $v["cover"] = file_get_contents($f["cover"]["tmp_name"]);
    }
    $validator->validate($v, "amount")->required()->integer()->min(0)->done();
    if (!is_null($v["borrowable"])) {
        $validator->validate($v, "borrow_days")->required()->integer()->min(1)->max(14)->done();
        $validator->validate($v, "renewable_times")->required()->integer()->min(0)->max(2)->done();
        $validator->validate($v, "overdue_rate")->required()->decimal()->min(0.35)->max(2)->done();
        $v["borrowable"] = true;
    } else {
        $v["borrowable"] = false;
    }

    return [
        "errors" => $validator->errors,
        "values" => $v
    ];
}
