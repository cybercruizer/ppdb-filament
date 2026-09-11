<?php

namespace App\Models;

use App\Models\CalonMurid;
use Illuminate\Database\Eloquent\Model;

class MuridAktif extends Model
{
    //

    // add fillable
    protected $fillable = ['kelas', 'nis', 'nama'];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    // add relationship
    public function calonMurids()
    {
        return $this->hasMany(CalonMurid::class, 'murid_pendamping_id');
    }
}
