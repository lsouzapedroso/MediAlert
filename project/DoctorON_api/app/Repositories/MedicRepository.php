<?php

namespace App\Repositories;

use App\Exceptions\ClinicNameNotUniqueException;
use App\Models\Medic;
use App\Models\User;

class MedicRepository
{
    public function __construct(
        private Medic $medicModel
    ) {}

    public function createMedic(array $medicData)
    {
        return $this->medicModel->create($medicData);
    }

    public function updateMedic(array $medicData, $id)
    {
        return $this->medicModel->where('id', $id)->update($medicData);
    }

    public function deleteMedic($id)
    {
        return $this->medicModel->where('id', $id)->delete();
    }

    public function findById($medicId)
    {
        return $this->medicModel->where('id', $medicId)->first();
    }

    public function associateUser(array $medicData, int $userId)
    {
        if ($this->findByCnpj($medicData['cnpj'])) {
            throw new ClinicNameNotUniqueException;
        }

        $medic = $this->createMedic($medicData);
        $medic->user()->associate($userId);
        $medic->save();

        return $medic;
    }

    public function findByCnpj(string $cnpj)
    {
        return $this->medicModel->where('cnpj', $cnpj)->first();
    }
}
