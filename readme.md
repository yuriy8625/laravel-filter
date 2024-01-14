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
    public function email($email = '')
    {
        if ($email) {
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

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email yuriy.kernytskyi@jointoit.com instead of using the issue tracker.

## Credits

- [Yuriy Kernytskyi][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jti/laravelfilter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jti/laravelfilter.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jti/laravelfilter/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/jti/laravelfilter
[link-downloads]: https://packagist.org/packages/jti/laravelfilter
[link-travis]: https://travis-ci.org/jti/laravelfilter
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/jti
[link-contributors]: ../../contributors



