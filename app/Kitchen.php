<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'kitchens';

    /**
     * Get the user that owns the kitchen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The images that belong to the kitchen.
     */
    public function images()
    {
        return $this->belongsToMany('App\Image')->withTimestamps();
    }

    /**
     * The kitchen categories that belong to the kitchen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kcategories()
    {
        return $this->belongsToMany('App\KitchenCategory')->withTimestamps();
    }
}
