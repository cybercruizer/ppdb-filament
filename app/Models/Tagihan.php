<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tagihan extends Model
{
    //
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->whereHas('siswa.tahun', function (Builder $query) {
                $query->where('is_active', true);
            });
        });
    }
    // add fillable
    protected $fillable = [
        'siswa_id',
        'nama_tagihan',
        'jumlah_tagihan',
        'keterangan',
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the siswa that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
    /**
     * Get all of the pembayarans for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
    /**
     * Get the tahun that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function tahun(): BelongsTo
//    {
//        return $this->belongsTo(Tahun::class);
//    }

    public function getTerbayarAttribute()
    {
        return $this->pembayarans()->sum('jumlah_pembayaran');
    }
    public function getStatusAttribute()
    {
        return $this->pembayarans()->sum('jumlah_pembayaran') >= $this->jumlah_tagihan ? 'Lunas' : 'Belum Lunas';
    }
    
}
