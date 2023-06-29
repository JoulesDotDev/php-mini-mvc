<?php

require_once "./DatabaseModel.php";

class UserModel extends DatabaseModel
{
    public static function getTableName()
    {
        return "users";
    }
}
