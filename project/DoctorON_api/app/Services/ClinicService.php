<?php

namespace App\Services;

use App\Repositories\ClinicRepository;

class ClinicService
{
    protected $clinicRepository;

    public function __construct(ClinicRepository $clinicRepository)
    {
        $this->clinicRepository = $clinicRepository;
    }

    public function registerClinic(array $clinicData)
    {
        $existingClinic = $this->clinicRepository->findByName($clinicData['name']);
        if ($existingClinic) {
            throw new \Exception('A clinic with this name already exists.');
        }

        return $this->clinicRepository->createClinic($clinicData);
    }

    public function findById(int $clinicId)
    {
        $existingClinic = $this->clinicRepository->findById($clinicId);
        if ($existingClinic) {
            throw new \Exception('This clinic does not exist.');
        }

        return $existingClinic;
    }

    public function updateClinic(array $clinicData)
    {
        $clinicId = $clinicData['id'] ;

        $existingClinic = $this->clinicRepository->findById($clinicId);
        if (!$existingClinic) {
            throw new \Exception('This clinic does not exist.');
        }

        return $this->clinicRepository->updateClinic($clinicData, $clinicId );
    }

}
