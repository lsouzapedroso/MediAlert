<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'city_id',
        'cnpj',
        'email',
        'phone',
    ];

    /**
     * Get the city that the clinic belongs to.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function clinics(){
        return $this->belongsToMany(Clinic::class, 'users_clinics')
            ->withTimestamps()
            ->withTrashed();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_clinics')
            ->withPivot(['role', 'created_by'])
            ->withTimestamps();
    }
}
