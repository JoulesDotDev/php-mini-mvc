<?php

class Template
{
    private static function get($name)
    {
        $file = ROOT_DIR . '/Email/Templates/' . $name . '.html';
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        return null;
    }

    public static function build($template, $data = [])
    {
        $content = self::get($template);
        if (!$content) {
            throw new EmailException("Template not found");
        }

        foreach ($data as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
            Log::Simple("Replacing {{{$key}}} with {$value}");
            Log::Simple($content);
        }

        return $content;
    }
}
