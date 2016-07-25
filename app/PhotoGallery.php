<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'photo_galleries';

    /**
     * Get the user that owns the photo gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The images that belong to the photo gallery.
     */
    public function images()
    {
        return $this->belongsToMany('App\Image')->withTimestamps();
    }
}
