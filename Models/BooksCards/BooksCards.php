<?php

require_once ROOT_DIR . "/Models/DB.php";

class BooksCards
{
    public $book_id;
    public $card_id;
    public $borrowed_at;
    public $returned_at;
    public $renewed_times;

    public static function table()
    {
        return "books_cards";
    }

    public function fill($values)
    {
        $this->book_id = $values["book_id"];
        $this->card_id = $values["card_id"];
        $this->borrowed_at = $values["borrowed_at"] ?? time();
        $this->returned_at = $values["returned_at"] ?? null;
        $this->renewed_times = $values["renewed_times"];
    }

    public function save()
    {
        try {
            $result = DB::query(
                "INSERT INTO " . self::table() .
                    " (book_id, card_id, borrowed_at, returned_at, renewed_times)" .
                    " VALUES (?, ?, ?, ?, ?)" .
                    " ON DUPLICATE KEY UPDATE" .
                    " book_id = VALUES(book_id), card_id = VALUES(card_id), borrowed_at = VALUES(borrowed_at)," .
                    " returned_at = VALUES(returned_at), renewed_times = VALUES(renewed_times)",
                [$this->book_id, $this->card_id, $this->borrowed_at, $this->returned_at, $this->renewed_times]
            );

            if (!$result) throw new DBException("Failed to save book as borrowed");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
