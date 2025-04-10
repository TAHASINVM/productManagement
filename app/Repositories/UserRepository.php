<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create new User
     *
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        $data['password'] =  Hash::make($data['password']);
        return User::create($data);
    }
}
