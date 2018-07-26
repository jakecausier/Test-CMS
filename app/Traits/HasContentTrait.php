<?php

namespace App\Traits;

trait HasContentTrait
{

    /**
     * Return content
     *
     * @return App\Content
     */
    public function content()
    {
        return $this->morphMany('App\Content', 'contentable');
    }

    /**
     * Return the content filtered by type
     *
     * @return string $type
     */
    public function contentByType($type)
    {
        return $this->content->where('type', $type);
    }

}
