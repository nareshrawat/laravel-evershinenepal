<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'app_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url', 'email', 'logo', 'phone', 'address', 'facebook_url', 'twitter_url', 'linkedin_url', 'googleplus_url'
    ];

    /**
     * Get the user that owns the app settings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
