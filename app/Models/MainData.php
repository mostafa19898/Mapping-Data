<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainData extends Model
{
    use HasFactory;
    protected $table = 'main_data';

    protected $fillable = [
        'id',
        'description',
    ];


    public function mappings()
    {
        return $this->hasMany(Mapping::class, 'main_data_id');
    }

}
