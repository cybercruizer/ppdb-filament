<?php

namespace App\Models;

use App\Models\Tahun;
use App\Models\Jurusan;
use App\Models\Tagihan;
use App\Models\Tesfisik;
use App\Models\Gelombang;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    //

    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->whereHas('tahun', function (Builder $query) {
                $query->where('is_active', true);
            });
        });
    }
    public function getNamaTahunAttribute()
    {
        return $this->tahun->nama_tahun;
    }
    /**
     * Get all of the pembayarans for the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
    /**
     * Get the tagihan associated with the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tagihan(): HasOne
    {
        return $this->hasOne(Tagihan::class);
    }
    /**
     * Get the tesfisik associated with the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tesfisik(): HasOne
    {
        return $this->hasOne(Tesfisik::class);
    }
    /**
     * Get the jurusan that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }
    /**
     * Get the gelombang that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gelombang(): BelongsTo
    {
        return $this->belongsTo(Gelombang::class);
    }
    /**
     * Get the tahun that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class);
    }
    
}
