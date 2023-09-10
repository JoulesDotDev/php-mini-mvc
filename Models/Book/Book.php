<?php

require_once ROOT_DIR . "/Models/DB.php";
require_once "Read.php";

class Book
{
    use BookRead;

    public $id;
    public $name;
    public $isbn;
    public $author_id;
    public $cover;
    public $amount;
    public $borrowable;
    public $borrow_days = null;
    public $renewable_times = null;
    public $overdue_rate = null;

    public static function table()
    {
        return "books";
    }

    public function fill($values)
    {
        $this->id = $values["id"] ?? null;
        $this->name = $values["name"];
        $this->isbn = $values["isbn"];
        $this->author_id = $values["author_id"];
        $this->cover = $values["cover"] ?? null;
        $this->amount = $values["amount"];
        $this->borrowable = $values["borrowable"];
        if ($this->borrowable) {
            $this->borrow_days = $values["borrow_days"];
            $this->renewable_times = $values["renewable_times"];
            $this->overdue_rate = $values["overdue_rate"];
        }
    }

    public function save()
    {
        try {
            $result = DB::query(
                "INSERT INTO " . self::table() .
                    " (id, name, isbn, author_id, cover, amount, borrowable, borrow_days, renewable_times, overdue_rate)" .
                    " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" .
                    " ON DUPLICATE KEY UPDATE" .
                    " id = VALUES(id), name = VALUES(name), isbn = VALUES(isbn)," .
                    " author_id = VALUES(author_id), cover = VALUES(cover), amount = VALUES(amount), borrowable = VALUES(borrowable)," .
                    " borrow_days = VALUES(borrow_days), renewable_times = VALUES(renewable_times)," .
                    " overdue_rate = VALUES(overdue_rate)",
                [
                    $this->id, $this->name, $this->isbn, $this->author_id, $this->cover, $this->amount,
                    $this->borrowable, $this->borrow_days, $this->renewable_times, $this->overdue_rate
                ]
            );

            if (!$result) throw new DBException("Failed to save book");
            return self::_getById(DB::lastInsertId());
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
