<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'images';

    /**
     * Get the user that owns the image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The products that belong to the image.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }

    /**
     * The kitchens that belong to the image.
     */
    public function kitchens()
    {
        return $this->belongsToMany('App\Kitchen')->withTimestamps();
    }

    /**
     * The photo gallery that belong to the image.
     */
    public function pgalleries()
    {
        return $this->belongsToMany('App\PhotoGallery')->withTimestamps();
    }
}
