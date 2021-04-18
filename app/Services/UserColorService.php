<?php

namespace App\Services;

use App\Models\User;

class UserColorService
{
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserColors()
    {
        $q = User::with('');
    }
}