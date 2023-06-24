<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class homePublish extends Model
{
    use HasFactory;
    use SoftDeletes , HasRoles ;
    
    public function books()
    {

        return $this->hasMany(book::class, 'homePublish_id', 'id');
    }
}
