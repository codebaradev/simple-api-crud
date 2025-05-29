<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $table = 'students';

    public $fillable = [
        'name',
        'nim',
        'prodi',
    ];

    protected static function newFactory()
    {
        return StudentFactory::new();
    }
}
