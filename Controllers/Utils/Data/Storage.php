<?php

class Storage
{
    private static $storage_path = ROOT_DIR . "/Storage";

    public static function read($category, $alias)
    {
        $path = self::$storage_path . "/$category/$alias";
        $name = "";

        if (is_dir($path)) {
            $name = self::getFileOfDirectory($path);
            if (!$name) return null;
            $path .= "/$name";
        }

        if (!file_exists($path)) {
            return null;
        }

        $data = file_get_contents($path);
        return ["data" => $data, "name" => $name];
    }

    public static function save($category, $data, $name)
    {
        $alias = time() . bin2hex(random_bytes(64));
        $path = self::$storage_path . "/$category/$alias/$name";
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($path, $data);
        return $alias;
    }

    public static function delete($category, $file)
    {
        $path = self::$storage_path . "/$category/$file";
        $name = self::getFileOfDirectory($path);
        if (!$name) return null;
        $file_path = "$path/$name";
        if (!file_exists($file_path)) {
            return null;
        }
        unlink($file_path);
        rmdir($path);
        return $name;
    }

    private static function getFileOfDirectory($path)
    {
        $files = scandir($path);
        $files = array_diff($files, [".", ".."]);
        $files = array_values($files);
        return $files[0] ?? null;
    }
}
