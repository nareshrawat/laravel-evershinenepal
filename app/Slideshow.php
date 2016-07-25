<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'slideshows';

    /**
     * Get the user that owns the slideshow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
