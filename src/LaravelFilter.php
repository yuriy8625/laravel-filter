<?php

namespace JTI\LaravelFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class LaravelFilter
{
    /** @var array */
    protected array $data;

    /** @var Builder */
    protected Builder $builder;

    /** @var array */
    protected array $sortFields = [];


    /**
     * QueryFilter constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->data = $params;
    }

    abstract protected function initBuilder(Builder $builder): Builder;

    /**
     * @param Builder $builder
     */
    public function apply(Builder $builder): void
    {
        $this->initBuilder($builder);

        if (! isset($this->data['sort_field'])) {
            $this->data['sort_field'] = null;
        }

        foreach ($this->data as $field => $value) {
            if (method_exists($this, Str::camel($field))) {
                $value = in_array(gettype($value), ['string', 'integer']) ? trim($value) : $value;
                if (! is_null($value) || $field == 'sort_field') {
                    call_user_func_array([$this, Str::camel($field)], (array)$value);
                }
            }
        }
    }

    /**
     * @param string $field
     * @param string $default
     * @return string
     */
    protected function getSortField(string $field, string $default): string
    {
        return $this->sortFields[$field] ?? $default;
    }

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    protected function getSortDirection(string $key, string $default = 'desc'): string
    {
        return isset($this->data[$key]) && in_array($this->data[$key], ['asc', 'desc'])
            ? $this->data[$key]
            : $default;
    }
}
