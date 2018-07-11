<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

/**
 *  Get a scope of all posts that have the 'Live' checkbox checked
 */
class LiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!Auth::check()) {
            $builder->where('live_at', '<=', now()->toDateTimeString());
        }
    }
}
