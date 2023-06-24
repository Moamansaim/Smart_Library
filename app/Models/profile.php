<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [

        "image",
        "first_name",
        "last_name",
        "email",
        "organization",
        "phone_number",
        "address",
        "state",
        "zip_code",
        "country",
        "language",
        "currency",
        "admin_id"

    ];

    public function admin()
    {
        return  $this->belongsTo(admin::class, 'admin_id', 'id')->withDefault([]);
    }
}
