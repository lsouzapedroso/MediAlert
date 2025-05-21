<?php

// App/Repositories/ClinicRepository.php

namespace App\Repositories;

use App\Models\Clinic;

class ClinicRepository
{
    protected $clinicModel;

    public function __construct(Clinic $clinicModel)
    {
        $this->clinicModel = $clinicModel;
    }

    public function findByName($name)
    {
        return $this->clinicModel->where('name', $name)->first();
    }

    public function createClinic(array $clinicData)
    {
        return $this->clinicModel->create($clinicData);
    }
}
