<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;
    use Auditable;

    public $table = 'schools';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'city',
        'area',
        'sector',
        'name',
        'classificaion',
        'longitude',
        'latitude',
        'end_time',
        'start_time',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function schoolStudents()
    {
        return $this->hasMany(Student::class, 'school_id', 'id');
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
