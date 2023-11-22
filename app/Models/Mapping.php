<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    use HasFactory;
    protected $table = 'mapping';

    protected $fillable = [
        'main_data_id',
        'code',
        'description',
        'created_at',
        'reason_id',
        'updated_at'
    ];

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
    
    public function mainData()
    {
        return $this->belongsTo(MainData::class, 'main_data_id');
    }
    
}
