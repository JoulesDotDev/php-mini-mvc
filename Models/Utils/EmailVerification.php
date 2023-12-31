<?php

require_once ROOT_DIR . "/Models/DB.php";

class EmailVerification
{
    public $user_id;
    public $token;
    public $validUntil;

    public static function table()
    {
        return "email_verification";
    }

    public function save()
    {
        try {
            $result = DB::query(
                "INSERT INTO " . self::table() .
                    " (user_id, token, valid_until) VALUES (?, ?, ?)",
                [$this->user_id, $this->token, $this->validUntil]
            );

            if (!$result) throw new DBException("Failed to save verification token");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function generate($id)
    {
        $token = bin2hex(random_bytes(64));
        $verification = new EmailVerification();
        $verification->user_id = $id;
        $verification->token = $token;
        $verification->validUntil = time() + EMAIL_VERIFICATION_TIMEOUT;
        $verification->save();
        return $token;
    }

    public static function send($user)
    {
        Email::verification(
            $user->email,
            [
                "name" => $user->name,
                "link" => BASE_URL . "/verify-email?token=" . self::generate($user->id)
            ]
        );
    }

    public static function verify($token)
    {
        try {
            $stmt = DB::query("SELECT * FROM " . self::table() . " WHERE token = ?", [$token]);
            $result = $stmt->fetch();
            if (!$result) return false;
            if ($result["valid_until"] < time()) return false;
            self::deleteByToken($token);

            $user = User::getById($result["user_id"]);
            if (!$user) return false;
            $user->verified = true;
            $user->save();

            return true;
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private static function deleteByToken($token)
    {
        try {
            DB::query("DELETE FROM " . self::table() . " WHERE token = ?", [$token]);
        } catch (PDOException $ignored) {
            $exception = new DBException("Couldn't delete token", $ignored->getCode(), $ignored);
            Log::error($exception);
        }
    }

    public static function removeExpired()
    {
        try {
            DB::query("DELETE FROM " . self::table() . " WHERE valid_until < ?", [time()]);
        } catch (PDOException $ignored) {
            $exception = new DBException("Couldn't delete expired tokens", $ignored->getCode(), $ignored);
            Log::error($exception);
        }
    }
}
