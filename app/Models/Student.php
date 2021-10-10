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

    public const RELATIVE_RELATION_SELECT = [
        'father'  => 'father',
        'brother' => 'brother',
        'driver'  => 'driver',
    ];

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
        '7'  => 'seventh grade',
        '8'  => 'eight grade',
        '9'  => 'ninth grade',
        '10' => 'tenth grade',
        '11' => 'eleventh grade',
        '12' => 'twelve grade',
    ];

    public $table = 'students';

    protected $appends = [
        'identitty_photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'number',
        'school_id',
        'academic_level',
        'relative_relation',
        'company_name',
        'license_number',
        'user_id',
        'identity_num',
        'class_number',
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

    public function getIdentittyPhotoAttribute()
    {
        $files = $this->getMedia('identitty_photo');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
