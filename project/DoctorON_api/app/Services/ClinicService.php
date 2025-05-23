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

    public function registerClinic(array $clinicData, int $userId)
    {

        DB::beginTransaction();

        try{

            $clinic = $this->clinicRepository->createClinic($clinicData);

            $this->clinicRepository->associateUser($clinic, $userId);
            return $clinic;
        }catch (\Exception $e){
           DB::rollBack();
           throw $e;
        }

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

