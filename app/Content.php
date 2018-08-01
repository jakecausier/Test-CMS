<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Events\ContentCreated;

class Content extends Model
{

    protected $dispatchesEvents = [
        'created' => ContentCreated::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'contentable_id',
        'contentable_type',
        'name',
        'content',
        'type',
        'meta',
        'parent_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array'
    ];

    protected $appends = [
        'image_url',
        'child_type'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Content', 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Content', 'parent_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->type === 'media') {
            return Storage::disk($this->meta['disk'])->url("{$this->content}/{$this->name}");
        }
        return null;
    }

    public function getChildTypeAttribute()
    {
        if ($this->parent_id) {
            return $this->meta['child_type'] ?? null;
        }
        return null;
    }

    public function getImagePathAttribute()
    {
        if ($this->type === 'media') {
            return Storage::disk($this->meta['disk'])->path("{$this->content}/{$this->name}");
        }
        return null;
    }

    public function getImageAttribute()
    {
        if ($this->type === 'media') {
            return Storage::disk($this->meta['disk'])->get("{$this->content}/{$this->name}");
        }
        return null;
    }

    public function mimeTypeIsManipulatable()
    {
        $mime = $this->meta['mime'] ?? null;
        return ($mime === 'image/jpeg' ||
                $mime === 'image/jpg' ||
                $mime === 'image/png' ||
                $mime === 'image/gif' );
    }

    public function scopeOnlyParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
