<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function findUserById($id)
    {
        return $this->userRepository->findById($id);
    }
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listUsers($search = null, $sortColumn = 'name', $sortDirection = 'asc', $perPage = 10)
    {
        return $this->userRepository->getAll($search, $sortColumn, $sortDirection, $perPage);
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        $user->assignRole($data['role'] ?? 'user');

        return $user;
    }

    public function updateUser($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = $this->userRepository->update($id, $data);

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user;
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
