# for-examples

This exmples were built under laravel breeze install

`laravel new proyect`

Then
```
    composer require laravel/breeze --dev  
    php artisan breeze:install  
    npm install  
    npm run dev  
    php artisan migrate  
```

## For Vehicles Select2 using a controller and custom layout

> Our company sells vehicles and each vehicle has one code, a brand and can be in various colors.

Create or copy the migrations in _database/migrations_
- create_brands_table
- create_colors_table
- create_vehicles_table
- create_color_vehicle_table

Run the migrations `php artisan migrate`

Create o copy `Vehicle`, `Color` and `Brand` models in _app/Models_

Copy th layout backend in _resources/views/layouts/backend.blade.php_

Create a menu link in _resources/views/layouts/navigation.blade.php_
```html
<x-nav-link :href="route('vehicles')" :active="request()->routeIs('vehicles')">
    {{ __('Vehicles') }}
</x-nav-link>
```

Dont forget create the route
```php
Route::get('/vehicles', VehiclesController::class)->name('vehicles');
```

Create a vehicles controller.
`php artisan make:controller VehiclesController -i`
And add view
```php
public function __invoke(Request $request)
{
    return view('vehicles.index');
}
```

Copy the view in _resources/views/vehicles/index.blade.php_

Install packege _blockpc/select2-wire_
```
    composer require blockpc/select2-wire
```

Run Single Select2 command for **Brand** model
```
    php artisan select2:single brand -p vehicle
```

Run Multiple Select2 command form **Color** model
```
    php artisan select2:multiple color -p vehicle
```

At last, dont forget create or copy a livewire component for `Vehicle`
I used two components, one for a table, another for the form
```
    php artisan make:livewire vehicles.table
    php artisan make:livewire vehicles.form-vehicle
```

## For Blog Select2 using a livewire component and default app layout

> We have a blog, thats includes articles and each one has a title, a content, belongs to a category and has many tags

Create or copy the migrations in _database/migrations_
- create_categories_table
- create_tags_table
- create_articles_table
- create_article_tag_table

Run the migrations `php artisan migrate`

Create o copy `Article`, `Tag` and `Category` models in _app/Models_

Create a `Articles` livewire component and set the route.
Route: `Route::get('/articles', Articles::class)->name('articles')`

Add a new menu link in the navigation menu.
```html
<x-nav-link :href="route('articles')" :active="request()->routeIs('articles')">
    {{ __('Articles') }}
</x-nav-link>
```

Run Single Select2 command for **Category** model
```
    php artisan select2:single category -p article
```

Run Multiple Select2 command form **Tag** model
```
    php artisan select2:multiple tag -p article
```

At last, dont forget create or copy a livewire component for `Article`
I used two components, one for a table, another for the form
```
    php artisan make:livewire articles.table
    php artisan make:livewire articles.form-article
```

Dont forget include in the app layouts the `@livewireStyles` and `@livewireScripts` directives


### Remember this 👀
When we execute the select2 command passing the parent model, we must bind the events to a parent component directly in the events of the select2 component. The command cannot guess which component to interact with.
