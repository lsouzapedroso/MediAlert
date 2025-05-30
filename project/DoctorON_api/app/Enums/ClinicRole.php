<?php

namespace App\Enums;

enum ClinicRole: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case DOCTOR = 'doctor';
    case RECEPTIONIST = 'receptionist';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador',
            self::MANAGER => 'Gerente',
            self::DOCTOR => 'Médico',
            self::RECEPTIONIST => 'Recepcionista',
        };
    }
}
