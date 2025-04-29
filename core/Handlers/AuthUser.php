<?php

namespace Core\Handlers;

class AuthUser {
    public $user;

    public function __construct($user) {
        $this->user = $user;
    }
}