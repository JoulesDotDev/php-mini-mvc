<?php

class JWT
{
    public static function encode($payload = [])
    {
        $header = base64UrlEncode(json_encode([
            "alg" => "HS256",
            "typ" => "JWT",
            "exp" => time() + SESSION_TIMEOUT
        ]));

        $payload = base64UrlEncode(json_encode($payload));

        $signature = base64UrlEncode(hash_hmac(
            "sha256",
            $header . "." . $payload,
            JWT_SECRET,
            true
        ));

        return $header . "." . $payload . "." . $signature;
    }

    public static function decode($jwt = null)
    {
        if (!$jwt) return null;

        $jwt = explode(".", $jwt);

        if (count($jwt) !== 3) return null;

        $header = json_decode(base64UrlDecode($jwt[0]));
        $payload = json_decode(base64UrlDecode($jwt[1]));
        $signature = $jwt[2];

        if ($header->alg !== "HS256") return null;
        if ($header->exp < time()) return null;

        if ($signature !== base64UrlEncode(hash_hmac(
            "sha256",
            $jwt[0] . "." . $jwt[1],
            JWT_SECRET,
            true
        ))) return null;

        return [$header, $payload];
    }
}

function base64UrlEncode($text)
{
    return str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($text)
    );
}

function base64UrlDecode($text)
{
    return base64_decode(
        str_replace(
            ['-', '_'],
            ['+', '/'],
            $text
        )
    );
}
