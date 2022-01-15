<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Student extends Model implements HasMedia
{
    use SoftDeletes; 
    use HasMediaTrait;
    use Auditable; 

    public const CLASS_NUMBER_SELECT = [
        '1'  => 'class 1',
        '2'  => 'class  2',
        '3'  => 'class  3',
        '4'  => 'class  4',
        '5'  => 'class  5',
        '6'  => 'class  6',
        '7'  => 'class  7',
        '8'  => 'class  8',
        '9'  => 'class  9',
        '10' => 'class  10',
    ];

    public const ACADEMIC_LEVEL_SELECT = [
        '1'  => 'First grade',
        '2'  => 'second grade',
        '3'  => 'third grade',
        '4'  => 'fourth grade',
        '5'  => 'Fifth grade',
        '6'  => 'six grade', 
    ];

    public $table = 'students';  

    protected $appends = [
        'voice',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'number',
        'academic_level',  
        'class_number',
        'parent_identity',
        'school_id',
        'user_id', 
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ]; 

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
    
    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }

    public function getVoiceAttribute() 
    {
        return $this->getMedia('voice')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
