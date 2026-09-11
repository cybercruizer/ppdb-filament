<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonMurid extends Model
{
    //

    // add fillable
    protected $fillable = ['nik', 'nama', 'asal_smp', 'alamat', 'nama_ortu', 'no_wa', 'scan_kk', 'murid_pendamping_id'];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    // add relationship
    public function muridPendamping()
    {
        return $this->belongsTo(MuridAktif::class);
    }
}
