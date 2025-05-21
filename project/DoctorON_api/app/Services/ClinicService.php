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
}
