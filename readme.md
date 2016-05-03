![The Dojocat](http://octodex.github.com/images/dojocat.jpg =250x)
# Laravel Routes

[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)]()

Inspired by [Laravel Multiple Routes](http://laravel-tricks.com/tricks/laravel-5-multiple-routes-files)

This package allow grouping routes by namespace, you only need to create a directory with the namespace on "../Http/Controllers/". Also it is necessary to create the file routes.php on that directory.

**This package doesn't disable the default routes of Laravel.**

### Required

PHP 5.5+ Laravel 5.x+ are required

### Installation
You can install this package quickly and easily with Composer.

Run the following command in your terminal:

```
composer require tohuma/laravel-routes
```

Add **RouteServiceProvider** in **config/app.php**

``` 
'providers' => [
     ...
     Tohuma\Laravel\Routes\Providers\RouteServiceProvider::class,
],
``` 

### Example Usage

Open file: **config/routes.php** and add **'blog' => 'App\Http\Controllers\Blog'**

``` 
<?php

return [
	'blog' => 'App\Http\Controllers\Blog'
];
``` 

Create directory **Blog** in **App\Http\Controllers**.

Create file **routes.php** in **App\Http\Controllers\Blog** and add yours routes.

``` 
<?php

Route::get('welcome', function () {
    return 'Welcome to my blog';
});

```

Callback in browser

``` 
http://<servername>/blog/welcome

```

### Other Example

Create file **BlogController.php** in **App\Http\Controllers\Blog** and add this script.

``` 
<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
	public function comments()
	{
		return 'This is my list comments';
	}
}

```

Add in **App\Http\Controllers\Blog\routes.php**

``` 
<?php
...
Route::get('comments', 'BlogController@comments'); 
``` 

Callback

``` 
http://<servername>/blog/comments

```

### Version
0.1.0

### License
Laravel Routes is licensed The MIT License (MIT).
