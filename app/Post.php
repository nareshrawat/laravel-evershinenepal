<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'posts';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the user that owns the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The post categories that belong to the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pcategories()
    {
        return $this->belongsToMany('App\PostCategory')->withTimestamps();
    }
}
