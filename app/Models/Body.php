<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Body extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
