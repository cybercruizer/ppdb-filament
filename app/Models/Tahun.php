<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Gelombang;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tahun extends Model
{
    //

    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get all of the siswas for the Tahun
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
    /**
     * Get all of the pembayarans for the Tahun
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function pembayarans(): HasManyThrough
    {
        return $this->hasManyThrough(Pembayaran::class, Tagihan::class);
    }
    /**
     * Get all of the gelombangs for the Tahun
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gelombangs(): HasMany
    {
        return $this->hasMany(Gelombang::class);
    }
}
