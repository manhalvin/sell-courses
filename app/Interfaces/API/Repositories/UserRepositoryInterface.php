<?php

namespace App\Interfaces\API\Repositories;

use App\Http\Requests\API\UpdateUserRequest;

interface UserRepositoryInterface
{
    public function getUserAll();
    public function getUserById($userId);
    public function getUserByUuid($uuid);
    public function checkUuidExist(string $uuid);
    public function updateUserStatusByUuid(string $uuid);
    public function updateUserStatusById($id);
    public function checkEmailExist(string $email);
    public function getUserByEmail($email);
    public function createUser($userData);
    public function whereId($userId);

    public function updatePassword($passwordNew, $uuid);
    // public function updateUser($userId, UpdateUserRequest $updateUserRequest);
    // public function deleteUser($userId);
}
