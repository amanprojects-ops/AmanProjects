<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            if (!Schema::hasTable('settings')) {
                return $default;
            }

            return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
                $setting = static::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }

    public static function set(string $key, mixed $value): void
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            if (is_bool($value)) {
                $value = $value ? '1' : '0';
            }

            static::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget("setting.{$key}");
            Cache::forget('ap_settings');
        } catch (\Exception $e) {
            // Silently fail if table doesn't exist
        }
    }

    public static function getMany(array $keys): array
    {
        $settings = [];
        foreach ($keys as $key => $default) {
            if (is_numeric($key)) {
                $settings[$default] = static::get($default);
            } else {
                $settings[$key] = static::get($key, $default);
            }
        }
        return $settings;
    }

    public static function clearCache(): void
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            Cache::forget('ap_settings');

            $settings = static::all();
            foreach ($settings as $setting) {
                Cache::forget("setting.{$setting->key}");
            }
        } catch (\Exception $e) {
            // Silently fail
        }
    }
}
