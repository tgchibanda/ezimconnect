<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    // User Active Now 
    public function UserOnline(){
        return Cache::has('user-is-online' . $this->id);
    }

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
        $title = $this->role == 'vendor' ? 'Shop' : ($this->role == 'admin' ? 'Admin' : 'User');
        $folderPath = $this->role == 'vendor' ? 'vendor_images' : ($this->role == 'admin' ? 'admin_images' : 'user_images');

        return [
            'title' => $title,
            'folderPath' => $folderPath,
        ];
    }

    public function getUserTitle()
    {
        if ($this->role == 'vendor') {
            $title = 'Shop';
        } else if ($this->role == 'user') {
            $title = 'User';
        } else {
            $title = 'Admin';
        }

        return $title;
    }
}
