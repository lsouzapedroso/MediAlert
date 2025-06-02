<?php

namespace App\Services;

use App\Exceptions\InvalidCnpjException;
use App\Repositories\ClinicRepository;
use Illuminate\Support\Facades\DB;

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
            $clinicData = $this->sanitizeClinicData($clinicData);
            $clinic = $this->clinicRepository->createClinic($clinicData);
            $this->clinicRepository->associateUser($clinic->id, $userId);

            DB::commit();
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

    private function sanitizeClinicData(array $clinicData): array
    {
        if (!isset($clinicData['cnpj'])) {
            return $clinicData;
        }

        if (!isset($clinicData['email'])) {
            return $clinicData;
        }

        if (!isset($clinicData['phone'])) {
            return $clinicData;
        }

        $cleanedCnpj = $this->sanitizeAndValidateCnpj($clinicData['cnpj']);
        $clinicData['cnpj'] = $cleanedCnpj;

        $cleanedEmail = $this->sanitizeAndValidateEmail($clinicData['email']);
        $clinicData['email'] = $cleanedEmail;

        $cleanedEmail = $this->sanitizeAndValidateEmail($clinicData['email']);
        $clinicData['email'] = $cleanedEmail;

        return $clinicData;
    }

    private function sanitizeAndValidateCnpj(string $rawCnpj): string
    {
        $cleanedCnpj = preg_replace('/[^0-9]/', '', $rawCnpj);

        if (strlen($cleanedCnpj) !== 14) {
            throw new InvalidCnpjException;
        }

        return $cleanedCnpj;
    }

    private function sanitizeAndValidateEmail(string $rawEmail): string
    {
        $cleanedEmail = filter_var($rawEmail, FILTER_SANITIZE_EMAIL);
        if (!filter_var($cleanedEmail,  FILTER_SANITIZE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email addres');
        }

        return $cleanedEmail;
    }

    private function sanitizeAndValidatePhone(string $rawPhone): string
    {
        $cleanedPhone = preg_replace('/[^0-9]/', '', $rawPhone);

        if ( strlen($cleanedPhone) < 10 ||  strlen($cleanedPhone) > 15 ) {
            throw new \InvalidArgumentException('Invalid phone number length');
        }
        return $cleanedPhone;
    }
}

