<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterClinicRequest;
use App\Services\ClinicService;

class ClinicController extends Controller
{

    protected $clinicService;

    public function __construct(clinicService $clinicService)
    {
        $this->clinicService = $clinicService;
    }



    /**
     * @OA\Post(
     *     path="/api/clinicas",
     *     summary="Cadastrar uma nova clinica",
     *     description="Cadastra uma nova clinica no sistema.",
     *     tags={"Clinicas"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"nome", "enderço", "cidade_id"},
     *
     *             @OA\Property(property="nome", type="string", example="Clinica Souza"),
     *             @OA\Property(property="endereço", type="string", example="Avenida São Paulo"),
     *             @OA\Property(property="cidade_id", type="integer", example=1)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Médico cadastrado com sucesso",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="Dr. João Silva"),
     *             @OA\Property(property="endereço", type="string", example="Avenida São Paulo"),
     *             @OA\Property(property="cidade_id", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-01T12:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-02-01T12:00:00Z"),
     *             @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true, example=null)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Erro ao cadastrar o médico",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Erro ao cadastrar a clinica."),
     *             @OA\Property(property="error", type="string", example="Mensagem detalhada do erro")
     *         )
     *     )
     * )
     */
    public function register(RegisterClinicRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $clinic = $this->clinicService->registerClinic($validatedData);

            return response()->json([
                'message' => 'Clinic registered successfully',
                'clinic' => $clinic
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
