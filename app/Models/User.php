<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getTitleAndFolderPath()
    {
        $title = $this->role == 'vendor' ? 'Vendor' : ($this->role == 'admin' ? 'Admin' : 'User');
        $folderPath = $this->role == 'vendor' ? 'vendor_images' : ($this->role == 'admin' ? 'admin_images' : 'user_images');

        return [
            'title' => $title,
            'folderPath' => $folderPath,
        ];
    }

    public function getUserTitle()
    {
        if ($this->role == 'vendor') {
            $title = 'Vendor';
        } else if ($this->role == 'user') {
            $title = 'User';
        } else {
            $title = 'Admin';
        }

        return $title;
    }
}
