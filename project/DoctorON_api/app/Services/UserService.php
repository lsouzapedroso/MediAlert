<?php


namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

// Necessário para type hinting de retorno
use Illuminate\Database\Eloquent\Collection;

// Necessário para type hinting de retorno
use Illuminate\Support\Facades\Log;

// Opcional, para logging

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Cria um novo usuário.
     *
     * @param array $data Dados do usuário.
     * @return User
     */
    public function createUser(array $data): User
    {
        // Aqui você pode adicionar lógica de negócios antes de criar o usuário,
        // como validações complexas, disparar eventos, etc.
        // Ex: if (isset($data['password'])) {
        // $data['password'] = bcrypt($data['password']); // Se não estiver usando o cast 'hashed' no model
        // }
        return $this->userRepository->create($data);
    }

    /**
     * Obtém um usuário pelo ID.
     *
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Obtém todos os usuários.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * Atualiza um usuário existente.
     *
     * @param int $id
     * @param array $data
     * @return User|null
     */
    public function updateUser(int $id, array $data): ?User
    {
         if (isset($data['password']) && !empty($data['password'])) {
         $data['password'] = bcrypt($data['password']);
         } else {
         unset($data['password']);
         }
        return $this->userRepository->update($id, $data);
    }

    /**
     * Deleta um usuário.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
