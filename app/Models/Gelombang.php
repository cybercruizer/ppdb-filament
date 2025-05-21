<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Tahun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gelombang extends Model
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

    /**
     * Get all of the siswas for the Gelombang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
    /**
     * Get the tahun that owns the Gelombang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class);
    }
}
