<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class book extends Model
{
    use HasFactory;
    use SoftDeletes, HasRoles ;

    public function category()
    {

        return $this->belongsTo(category::class, 'category_id', 'id')->withDefault(['name' => 'null']);
    }

    public function writer()
    {

        return $this->belongsTo(writer::class, 'writer_id', 'id')->withDefault(['name' => 'null']);
    }

    public function homePublish()
    {

        return $this->belongsTo(homePublish::class, 'homePublish_id', 'id')->withDefault(['name' => 'null']);
    }

    
    public function users()
    {

        return $this->hasMany(User::class)->withDefault();
    }
}
