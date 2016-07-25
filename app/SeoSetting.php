<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'seo_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'gAnalyticsCode'
    ];

    /**
     * Get the user that owns the seo setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
