<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAllUsers();
            return response()->json($users);
        } catch (Exception $e) {
            Log::error('Erro ao buscar todos os usuários: ' . $e->getMessage());
            return response()->json(['message' => 'Ocorreu um erro ao processar sua solicitação.'], 500);
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $user = $this->userService->createUser($validatedData);
            return response()->json($user, 201);
        } catch (Exception $e) {
            Log::error('Erro ao criar usuário: ' . $e->getMessage());
            return response()->json(['message' => 'Ocorreu um erro ao criar o usuário.'], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $user = $this->userService->getUserById($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            return response()->json($user);
        } catch (Exception $e) {
            Log::error("Erro ao buscar usuário com ID {$id}: " . $e->getMessage());
            return response()->json(['message' => 'Ocorreu um erro ao buscar o usuário.'], 500);
        }
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            if (array_key_exists('password', $validatedData) && empty($validatedData['password'])) {
                unset($validatedData['password']);
            }

            $user = $this->userService->updateUser($id, $validatedData);

            if (!$user) {
                return response()->json(['message' => 'User not found or could not be updated'], 404);
            }

            return response()->json($user);
        } catch (Exception $e) {
            Log::error("Erro ao atualizar usuário com ID {$id}: " . $e->getMessage());
            return response()->json(['message' => 'Ocorreu um erro ao atualizar o usuário.'], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $deleted = $this->userService->deleteUser($id);
            if (!$deleted) {
                return response()->json(['message' => 'User not found or could not be deleted'], 404);
            }
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error("Erro ao deletar usuário com ID {$id}: " . $e->getMessage());
            return response()->json(['message' => 'Ocorreu um erro ao deletar o usuário.'], 500);
        }
    }
}
