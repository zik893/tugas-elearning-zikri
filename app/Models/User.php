<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // ✅ tambahkan

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // ✅ tambahkan HasRoles

    protected $fillable = [
        'name',
        'email',
        'password',
        'occupation',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi: 1 user bisa punya banyak transaksi
    public function subscribeTransactions()
    {
        return $this->hasMany(SubscribeTransaction::class);
    }

    // Function cek apakah user masih berlangganan aktif
    public function hasActiveSubscription()
    {
        $latestTransaction = $this->subscribeTransactions()
            ->where('is_paid', true)
            ->latest('subscription_start_date')
            ->first();

        if (!$latestTransaction) {
            return false;
        }

        $expiryDate = \Carbon\Carbon::parse($latestTransaction->subscription_start_date)
            ->addMonth();

        return \Carbon\Carbon::now()->lessThanOrEqualTo($expiryDate);
    }
}