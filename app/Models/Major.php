<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    public $path = 'image/majors';

    protected $table = 'majors';

    protected $fillable = ['title', 'image', 'status'];

    public static $status = ['active', 'deactive'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function getImageAttribute($value)
    {
        if ($value == 'major.jpg') {
            return asset('front/assets/images/' . $value);
        }
        return asset($this->path . '/' . $value);
    }
}
