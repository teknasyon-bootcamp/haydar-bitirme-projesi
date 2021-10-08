<?php

namespace Core\Session;

class Session
{
    public static function all(): mixed
    {

        return $_SESSION;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public function getErrors()
    {
        dd(Session::all());
        return $this->get('flash')['errors'] ?? [];
    }

    public static function delete(string $key): void
    {
        unset($_SESSION[$key]);
    }


    public static function getFlash(string $key, mixed $default = null): mixed
    {
        return $_SESSION['flash'][$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['flash'][$key] = $value;
    }

    public function any(mixed $key = null)
    {
        if (is_string($key)) {
            return key_exists($key, $_SESSION);
        } elseif (is_array($key) && $key[0] == "flash") {
            return count($_SESSION['flash'][$key[0]]) > 0;
        }

        return count($_SESSION['flash']['errors'] ?? []) > 0;
    }
}
