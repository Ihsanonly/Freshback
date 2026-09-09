<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'quantity',
        'purchase_date',
        'shelf_life_days',
        'category',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'shelf_life_days' => 'integer',
    ];

    /**
     * Menghitung tanggal batas masa simpan makanan.
     */
    public function getExpiryDateAttribute(): ?Carbon
    {
        if (!$this->purchase_date || $this->shelf_life_days === null) {
            return null;
        }

        return $this->purchase_date
            ->copy()
            ->addDays($this->shelf_life_days);
    }

    /**
     * Menghitung jumlah hari yang tersisa.
     *
     * > 5  = masih aman
     * 3-5  = perlu dipantau
     * 0-2  = segera digunakan
     * < 0  = sudah lewat masa simpan
     */
    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->expiry_date) {
            return null;
        }

        return (int) today()
            ->startOfDay()
            ->diffInDays(
                $this->expiry_date->copy()->startOfDay(),
                false
            );
    }

    /**
     * Menentukan status makanan secara otomatis.
     */
    public function getStatusAttribute(): string
    {
        if ($this->days_remaining === null) {
            return 'Data Tidak Lengkap';
        }

        if ($this->days_remaining < 0) {
            return 'Sudah Lewat Masa Simpan';
        }

        if ($this->days_remaining <= 2) {
            return 'Segera Digunakan';
        }

        if ($this->days_remaining <= 5) {
            return 'Perlu Dipantau';
        }

        return 'Masih Aman';
    }

    /**
     * Menentukan class CSS berdasarkan status.
     */
    public function getStatusKeyAttribute(): string
    {
        return match ($this->status) {
            'Segera Digunakan' => 'danger',
            'Perlu Dipantau' => 'warning',
            'Masih Aman' => 'safe',
            'Sudah Lewat Masa Simpan' => 'expired',
            default => 'unknown',
        };
    }

    /**
     * Membuat insight/catatan otomatis berdasarkan kondisi makanan.
     *
     * Catatan ini tidak berasal dari input user.
     */
    public function getAutoNoteAttribute(): string
    {
        if ($this->days_remaining === null) {
            return 'Lengkapi data makanan agar FRESHBACK dapat memberikan insight.';
        }

        if ($this->days_remaining < 0) {
            $days = abs($this->days_remaining);

            return "Masa simpan yang dicatat sudah terlewati {$days} hari. "
                . "Periksa kondisi makanan sebelum memutuskan penggunaannya.";
        }

        if ($this->days_remaining === 0) {
            return '⚠️ Batas masa simpan hari ini. Sebaiknya segera digunakan.';
        }

        if ($this->days_remaining === 1) {
            return '🚨 Tinggal 1 hari lagi. Prioritaskan makanan ini untuk digunakan.';
        }

        if ($this->days_remaining === 2) {
            return '⚠️ Tinggal 2 hari lagi. Mulai prioritaskan penggunaannya.';
        }

        if ($this->days_remaining <= 5) {
            return "👀 Masih ada {$this->days_remaining} hari. "
                . "Sebaiknya mulai dipantau dan direncanakan penggunaannya.";
        }

        return "✅ Masih ada {$this->days_remaining} hari. "
            . "Belum menjadi prioritas untuk segera digunakan.";
    }
}