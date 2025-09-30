<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Beasiswa extends Model
{
    use HasSEO;
    //

    // add fillable
    protected $fillable = [
        'kode_beasiswa',
        'nama_beasiswa',
        'potongan_biaya',
        'deskripsi',
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
}
