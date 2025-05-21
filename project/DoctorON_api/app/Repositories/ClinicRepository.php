<?php

// App/Repositories/ClinicRepository.php

namespace App\Repositories;

use app\Http\Requests\Appointment\Models\Clinic;

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

}
