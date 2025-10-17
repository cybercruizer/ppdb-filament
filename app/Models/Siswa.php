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
    protected $fillable = [
        'kategori',
        'nomor_pendaftaran',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_telepon',
        'asal_sekolah',
        'nama_ayah',
        'nama_ibu',
        'alamat',
        'catatan',
        'tahun_id',
        'jurusan_id',
        'gelombang_id',
        'is_accepted'
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    //protected $connection = 'db2';
    //protected $table = 'siswas';
    

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
    public function getSudahduAttribute()
    {
        return $this->pembayarans()->exists();
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
    public function getSudahtesfisikAttribute()
    {
        return $this->tesfisik()->exists();
    }

    public static function generateNomor($jurusanId, $gelombangId, $kategori)
    {
        $jurusan  = Jurusan::findOrFail($jurusanId);
        $gelombang = Gelombang::findOrFail($gelombangId);

        // Ambil hanya 2 karakter pertama dari kategori
        $kategori2 = substr($kategori, 0, 2);

        // contoh: TKJ-26IDN-RE001
        $prefix = "{$jurusan->kode_jurusan}-{$gelombang->kode_gelombang}-{$kategori2}";

        // Cari nomor terakhir dengan prefix ini
        $last = self::where('nomor_pendaftaran', 'like', "{$prefix}%")
            ->orderByDesc('nomor_pendaftaran')
            ->first();

        if ($last) {
            $lastNumber = (int) substr($last->nomor_pendaftaran, -3);
            $newNumber  = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return "{$prefix}{$newNumber}";
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->nomor_pendaftaran) {
                $model->nomor_pendaftaran = self::generateNomor(
                    $model->jurusan_id,
                    $model->gelombang_id,
                    $model->kategori,
                );
            }
        });
    }
    
}
