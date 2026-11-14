<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadOptOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_hash',
        'domain_hash',
        'phone_hash',
        'reason',
        'requested_by_ip',
        'opted_out_at',
    ];

    protected $casts = [
        'opted_out_at' => 'datetime',
    ];

    public static function isBlacklisted(?string $email, ?string $domain, ?string $phone): bool
    {
        $query = static::query();
        $conditions = false;

        if (!empty($email)) {
            $query->orWhere('email_hash', hash('sha256', strtolower(trim($email))));
            $conditions = true;
        }

        if (!empty($domain)) {
            $query->orWhere('domain_hash', hash('sha256', strtolower(trim($domain))));
            $conditions = true;
        }

        if (!empty($phone)) {
            $cleanPhone = preg_replace('/[^\d+]/', '', $phone);
            $query->orWhere('phone_hash', hash('sha256', $cleanPhone));
            $conditions = true;
        }

        return $conditions && $query->exists();
    }
}
