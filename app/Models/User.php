<?php

namespace App\Models;

use App\Enums\Role;
use App\Enums\Config as ConfigEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user's profile picture
     *
     * @return Attribute
     */
    public function profilePicture(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value) return $value;

                $url = 'https://ui-avatars.com/api/?background=6D67E4&color=fff&name=';
                return $url . urlencode($this->name);
            },
        );
    }

    /**
     * Scope untuk pengguna yang aktif
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk pengguna berdasarkan peran (role)
     *
     * @param $query
     * @param Role $role
     * @return mixed
     */
    public function scopeRole($query, Role $role)
    {
        return $query->where('role', $role->status());
    }

    /**
     * Scope untuk pencarian berdasarkan nama, telepon, atau email
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->when($search, function($query, $find) {
            return $query
                ->where('name', 'LIKE', $find . '%')
                ->orWhere('phone', $find)
                ->orWhere('email', $find);
        });
    }

    /**
     * Scope untuk render dengan pencarian dan pagination
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeRender($query, $search)
    {
        return $query
            ->search($search)
            ->role(Role::USER)
            ->paginate(Config::getValueByCode(ConfigEnum::PAGE_SIZE))
            ->appends([
                'search' => $search,
            ]);
    }

    /**
     * Relasi satu ke banyak dengan Pengajuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
