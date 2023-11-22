<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $table = 'reasons';

    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ]; 

    public function mappings()
    {
        return $this->hasMany(Mapping::class, 'reason_id');
    }

    use HasFactory;
}
