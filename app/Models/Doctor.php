<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public $guarded = [];

    public static $status = ['active', 'deactive'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
