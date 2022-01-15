<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyParent extends Model
{
    use SoftDeletes;

    public const RELATIVE_RELATION_SELECT = [
        'father'  => 'father',
        'brother' => 'brother',
        'driver'  => 'driver',
    ];

    public $table = 'my_parents';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'school_id',
        'relative_relation',
        'company_name',
        'license_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parentStudents()
    {
        return $this->hasMany(Student::class, 'parent_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
