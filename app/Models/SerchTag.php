<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SerchTag extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'serch_tags';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function serchTagWorks()
    {
        return $this->belongsToMany(Work::class);
    }


    public function type_of_works()
    {
        return $this->belongsToMany(WorkCategory::class)->select(['id', 'type_name']);
    }
}
