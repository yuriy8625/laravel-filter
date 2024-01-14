# LaravelFilter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

```bash
composer require jti/laravelfilter
```

## Usage


1. Use trait with scope in your Model

```php
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Filterable;
}


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

```

2. Create your Filter class

```php
class UserFilter extends \JTI\LaravelFilter\LaravelFilter
{

    protected function initBuilder(\Illuminate\Database\Eloquent\Builder $builder): \Illuminate\Database\Eloquent\Builder
    {
        return $this->builder = $builder; // your model builder
    }

    // function name equal key name from array of params
    public function email($name = '')
    {
        if ($name) {
            $this->builder->where('email', '=', $name);
        }
    }
}
}
```

3. Use filter in controller for example

```php

class BuilderController extends Controller
{
    public function index()
    {
        $filter = new UserFilter(['email' => 'example@gmail.com']);
        $users = \App\Models\User::query()->filter($filter)->get();
        
        return view('users', compact('users'));
    }

}

```



