<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "username", "email", "password", "level"]);
    }

    /**
     * @param array $validated
     * @return User
     */
    public function add(array $validated): User
    {
        $this->first_name = $validated["first_name"];
        $this->last_name = $validated["last_name"];
        $this->username = $validated["username"];
        $this->email = $validated["email"];
        $this->password = password_hash($validated["password"], PASSWORD_DEFAULT);
        $this->level = $validated["level"] ?? 1;
        return $this;
    }
}