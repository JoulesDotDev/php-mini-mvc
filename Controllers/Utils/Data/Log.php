<?php

class Log
{
    static $errorLogs = ROOT_DIR . "/Logs/Error";
    static $infoLogs = ROOT_DIR . "/Logs/Info";
    static $simpleLogs = ROOT_DIR . "/Logs/Simple";

    static $hiddenParams = ["password", "verify_password", "csrf_token", "token"];

    public static function Error(Exception $e)
    {
        self::Log(get_class($e) . " " . $e->getMessage(), "error");
    }

    public static function Info($message = "")
    {
        self::Log(json_encode($message, JSON_PRETTY_PRINT), "info");
    }

    private static function filteredRequestData($data)
    {
        $filtered = $data;
        foreach (self::$hiddenParams as $param) {
            if (key_exists($param, $filtered)) {
                $filtered[$param] = "********";
            }
        }
        return $filtered;
    }

    public static function Simple($message = "")
    {
        $file = date("Y-m-d") . ".log";

        $log = date("Y-m-d H:i:s") . " [LOG] " . PHP_EOL;
        $log .= "Message: " . json_encode($message, JSON_PRETTY_PRINT) . PHP_EOL;
        $log .= str_repeat("=", 75) . PHP_EOL;

        file_put_contents(self::$simpleLogs . "/$file", $log, FILE_APPEND);
    }

    private static function Log($message = "", $type = "info")
    {
        $date = date("Y-m-d H:i:s");
        $file = date("Y-m-d") . ".log";

        $log = "[$date] [LOG] " . PHP_EOL;
        $log .= "Path: " . URI . PHP_EOL;
        $log .= "METHOD: " . METHOD . PHP_EOL;
        $log .= ACTION ? "ACTION: " . ACTION . PHP_EOL : "";

        $log .= empty($_POST) ? "" : str_repeat("- ", 25) . PHP_EOL;
        $log .= empty($_POST) ? "" : "POST: " . json_encode(self::filteredRequestData($_POST), JSON_PRETTY_PRINT) . PHP_EOL;

        $log .= empty($_GET) ? "" : str_repeat("- ", 25) . PHP_EOL;
        $log .= empty($_GET) ? "" : "POST: " . json_encode(self::filteredRequestData($_GET), JSON_PRETTY_PRINT) . PHP_EOL;

        $log .= $message ? str_repeat("- ", 25) . PHP_EOL : "";
        $log .= $message ? "Message: $message" . PHP_EOL : "";

        $log .= str_repeat("=", 75) . PHP_EOL;

        $folder = $type === "error" ? self::$errorLogs : self::$infoLogs;

        file_put_contents($folder . "/$file", $log, FILE_APPEND);
    }
}
