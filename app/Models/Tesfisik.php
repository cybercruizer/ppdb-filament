<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tesfisik extends Model
{
    //

    // add fillable
    protected $fillable = [];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
    protected static function booted()
    {
        static::addGlobalScope('activeTahunAjaran', function (Builder $builder) {
            $builder->whereHas('siswa.tahun', function ($query) {
                $query->where('is_active', true);
            });
        });
    }
    /**
     * Get the siswa that owns the Tesfisik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
    /**
     * Get the user that owns the Tesfisik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
