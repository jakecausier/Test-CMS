<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content', 'id_author',
    ];

    /**
     * The attributes that append to the model.
     *
     * @var array
     */
    protected $appends = [
        'edit_path'
    ];

    /**
     * Get the edit path attributes
     *
     * @return string
     */
    public function getEditPathAttribute() {
        return route('posts.edit', $this);
    }

    /**
     * Uppercase the name
     *
     * @var string $name
     * @return void
     */
    public function setNameAttribute($name) {
        $this->attributes['name'] = ucfirst($name);
    }

    /**
     * Return the author of the post
     *
     * @return App\User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'id_author');
    }

}
