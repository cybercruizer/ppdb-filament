<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanWebsite extends Model
{
    protected $table = 'pengaturan_website';
    // add fillable
    protected $fillable = [
        'key',
        'value',
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
}
