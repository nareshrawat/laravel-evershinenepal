<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the images for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * Get the Kitchens for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kitchens()
    {
        return $this->hasMany('App\Kitchen');
    }

    /**
     * Get the Kitchen Categories for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kcategories()
    {
        return $this->hasMany('App\KitchenCategory');
    }

    /**
     * Get the Posts for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Kitchen');
    }

    /**
     * Get the Post Categories for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pcategories()
    {
        return $this->hasMany('App\PostCategory');
    }

    /**
     * Get the Pages for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    /**
     * Get the app settings for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany('App\AppSetting');
    }

    /**
     * Get the app seo for this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seos()
    {
        return $this->hasMany('App\SeoSetting');
    }
}
