<?php

// App/Repositories/ClinicRepository.php

namespace App\Repositories;

use App\Exceptions\ClinicNameNotUniqueException;
use App\Models\Clinic;
use app\Models\User;

class ClinicRepository
{
    public function __construct(
        private Clinic $clinicModel,
        private User $userModel
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




    public function associateUser(array $clinicData, int $userId)
    {

        if ($this->clinicRepository->findByCnpj($$clinicData['cnpj'])) {
            throw new ClinicNameNotUniqueException;
        }


    }

    public function findByCnpj(array $clinicData){

    }

}
