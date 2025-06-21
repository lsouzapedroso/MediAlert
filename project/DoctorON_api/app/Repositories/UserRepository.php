<?php


namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Cria um novo usuário.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->create($data);
    }

    /**
     * Encontra um usuário pelo ID.
     * Lança ModelNotFoundException se não encontrar.
     *
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Retorna todos os usuários.
     * Pode adicionar paginação aqui se necessário.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Atualiza um usuário existente.
     *
     * @param int $id
     * @param array $data
     * @return User|null
     */
    public function update(int $id, array $data): ?User
    {
        $user = $this->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    /**
     * Deleta um usuário.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
