<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class WorkCategory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'work_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function serch_tags()
    {
        return $this->belongsToMany(SerchTag::class)->select(['id', 'name']);
    }

    public function typeOfWorkWorks()
    {
        return $this->belongsToMany(Work::class)->select(['id']);
    }
}
