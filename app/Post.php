<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\LiveScope;

class Post extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new LiveScope);
    }

    public static $snippet_limit = 60;
    public static $main_content_name = 'Main Content';
    public static $main_content_type = 'text';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id_author', 'live_at',
    ];

    /**
     * The attributes that append to the model.
     *
     * @var array
     */
    protected $appends = [
        'edit_path', 'live',
    ];

    /**
     * Define dates setup
     *
     * @var array
     */
    protected $dates = [
        'live_at'
    ];

    /**
     * Get the edit path attributes
     *
     * @return string
     */
    public function getEditPathAttribute()
    {
        return route('posts.edit', $this);
    }

    /**
     * Uppercase the name
     *
     * @var string $name
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }

    public function getLiveAttribute()
    {
        return [
                'date' => optional($this->live_at)->format('D-M-Y'),
                'live' => $this->live_at ? true : false,
        ];
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

    /**
     * Return the content of the post
     *
     * @return App\Content
     */
    public function content()
    {
        return $this->hasMany('App\Content');
    }

    /**
     * Create a snippet of the content to show as the brief
     *
     * @return string
     */
    public function getSnippetAttribute()
    {
        return str_limit($this->main_content, static::$snippet_limit);
    }

    /**
     * Gets content of a post by the name.
     *
     * @return App\Content
     */
    public function getContentByName($name)
    {
        return $this->content->where('name', $name)->first();
    }

    /**
     * Cets content of a post by the name.
     *
     * @return App\Content
     */
    public function getMainContentAttribute()
    {
        return optional($this->getContentByName(static::$main_content_name))->content;
    }


    /**
     * Sync posts content with the boxes
     *
     * @var array $contents
     * @return void
     */
    public function syncContent($contents)
    {
        foreach ($contents as $key => $content) {
            $this->content()->updateOrCreate([
                'name' => $content['name'],
                'type' => $content['type'],
            ],[
                'content' => $content['content'],
            ]);
        }
    }

}
