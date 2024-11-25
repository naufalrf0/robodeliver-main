<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll($search = null, $sortColumn = 'name', $sortDirection = 'asc', $perPage = 10)
    {
        $query = $this->model->query();

        if ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        return $query->orderBy($sortColumn, $sortDirection)->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        $user->delete();

        return $user;
    }
}
