<?php

namespace JTI\LaravelFilter\Trait;

use Illuminate\Database\Eloquent\Builder;
use JTI\LaravelFilter\LaravelFilter;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param LaravelFilter $filter
     */
    public function scopeFilter(Builder $builder, LaravelFilter $filter): void
    {
        $filter->apply($builder);
    }
}
