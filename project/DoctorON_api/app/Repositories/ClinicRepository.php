<?php

// App/Repositories/ClinicRepository.php

namespace App\Repositories;

use App\Enums\ClinicRole;
use App\Exceptions\ClinicNameNotUniqueException;
use App\Models\Clinic;
use App\Models\User;

class ClinicRepository
{
    public function __construct(
        private Clinic $clinicModel,
    ) {}

    public function createClinic(array $clinicData)
    {
        return $this->clinicModel->create($clinicData);
    }

    public function updateClinic(array $clinicData, $id)
    {
        return $this->clinicModel->where('id', $id)->update($clinicData);
    }

    public function deleteClinic($id)
    {
        return $this->clinicModel->where('id', $id)->delete();
    }

    public function findById($clinicId)
    {
        return $this->clinicModel->where('id', $clinicId)->first();
    }

    public function exitsByCnpj(array $clinicData): bool
    {
        return $this->clinicModel->where('cnpj' , $clinicData)->exit();
    }

    public function findByCnpj(array $clinicData){
        return $this->clinicModel->where('cnpj' , $clinicData->cnpj )->first();
    }

    public function associateUser(int $clinicId, int $userId, ?ClinicRole $role = null)
    {
        $clinic = $this->clinicModel->findOrFail($clinicId);

        $clinic->users()->attach($userId, [
            'role' => ($role ?? ClinicRole::ADMIN)->value,
            'created_by' => $userId
        ]);
        return $clinic;
    }

}
