<?php

function HashPassword($password)
{
    return password_hash($password . PEPPER, PASSWORD_BCRYPT, ["cost" => 12]);
}

function VerifyPassword($password, $hash)
{
    return password_verify($password . PEPPER, $hash);
}
