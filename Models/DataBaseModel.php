<?php

require_once ROOT_DIR . "/Models/DB.php";

abstract class DatabaseModel
{
    private static function table()
    {
        throw new Exception("Not implemented");
    }

    private function fill($values)
    {
        throw new Exception("Not implemented");
    }

    private function save()
    {
        throw new Exception("Not implemented");
    }

    private function getById($id)
    {
        throw new Exception("Not implemented");
    }

    private function getAll()
    {
        throw new Exception("Not implemented");
    }

    private function update($id, $data)
    {
        throw new Exception("Not implemented");
    }

    private function delete($id)
    {
        throw new Exception("Not implemented");
    }
}
