<?php

namespace App\Models;

use App\Casts\PhoneCast;
use App\ValueObjects\Phone;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property Phone $phone
 * @property CarbonInterface $created_at
 */
class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected $casts = [
        'phone' => PhoneCast::class
    ];
}
