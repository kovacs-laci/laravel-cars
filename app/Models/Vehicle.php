<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Vehicle extends EloquentModel
{
    use HasFactory;

    public function body()
    {
        return $this->belongsTo(Body::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }

    public function maker()
    {
        return $this->belongsTo(Maker::class, 'maker_id' );
    }

    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id');
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class, 'transmission_id');
    }

    public function trim()
    {
        return $this->belongsTo(Trim::class, 'trim_id');
    }

}
