<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'pcategories';

    /**
     * Get the user that owns the post category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The post that belong to the post category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
