<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nip', 'nama', 'jenis_kelamin', 'jabatan', 'telp', 'alamat'])]
class Pegawai extends Model
{
    use HasFactory;

    /**
     * Get the penilaians for the pegawai.
     */
    public function penilaians(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
