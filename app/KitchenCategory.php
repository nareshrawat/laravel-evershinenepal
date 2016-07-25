<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitchenCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'kcategories';

    /**
     * Get the user that owns the kitchen category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The kitchen that belong to the kitchen category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kitchens()
    {
        return $this->belongsToMany('App\Kitchen')->withTimestamps();
    }
}
