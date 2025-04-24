<?php

namespace Core\Middleware;


class Guest
{
    public function handle()
    {
        if (isset($_SESSION['user'])) {
            redirect('/home');
        }
    }
}
class Middleware
{
    public const MAP = [
        'teacher' => Teacher::class,
        'student' => Student::class,
        'auth' => Auth::class,
        'admin' => Admin::class,
        'guest' => Guest::class
    ];
    /**
     * @return void
     * @param mixed $key
     */
    public static function resolve($key): void
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (!$middleware) {
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}
