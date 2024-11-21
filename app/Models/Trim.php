<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Trim extends EloquentModel
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['model_id', 'name'];

    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
