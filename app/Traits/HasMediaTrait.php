<?php

namespace App\Traits;

trait HasMediaTrait
{

    /**
     * Return content
     *
     * @return App\Media
     */
    public function media()
    {
        return $this->morphToMany('App\Content', 'model', 'media_model', 'model_id', 'media_id')
                    ->withTimestamps()
                    ->withPivot('media_location');
    }

}
