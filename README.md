# Laravel Admin Panel
An admin panel for managing users, roles, permissions & crud.

### Requirements
    Laravel >=5.1
    PHP >= 5.5.9

## Installation

1. Run
    ```
    composer require appzcoder/laravel-admin:dev-master
    ```

2. Add service provider to **config/app.php** file.
    ```php
    'providers' => [
        ...

        Appzcoder\LaravelAdmin\LaravelAdminServiceProvider::class,
        // For crud generator & html
        Appzcoder\CrudGenerator\CrudGeneratorServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,
    ],
    ```
3. Add **Collective/Html** aliases to **config/app.php** file.
    ```php
    'aliases' => [
        ...

        'Form' => Collective\Html\FormFacade::class,
        'HTML' => Collective\Html\HtmlFacade::class,
    ],
    ```
4. Run ```composer dump-autoload```

5. Publish the resource file.
    ```
    php artisan vendor:publish
    ```

6. Make sure your user model's has a ```HasRoles``` trait **app/User.php**.
    ```php
    class User extends Authenticatable
    {
        use Notifiable, HasRoles;
        
        ...
    ```
7. Make sure your AuthServiceProvider **app/Providers/AuthServiceProvider.php** similiar [this file](https://github.com/appzcoder/laravel-admin/blob/master/src/publish/Providers/AuthServiceProvider.php).

8. Run migrate command.
    ```
    php artisan migrate
    ```

9. Put the routes definitions into ```Route``` file.

    ```php
    Route::get('admin', 'Admin\\AdminController@index');
    Route::get('admin/give-role-permissions', 'Admin\\AdminController@getGiveRolePermissions');
    Route::post('admin/give-role-permissions', 'Admin\\AdminController@postGiveRolePermissions');
    Route::resource('admin/roles', 'Admin\\RolesController');
    Route::resource('admin/permissions', 'Admin\\PermissionsController');
    Route::resource('admin/users', 'Admin\\UsersController');
    ```

10. If you don't have authentication resources then run below command.
    ```
    php artisan make:auth
    ```

11. Overwrite default layout file with [this file](https://github.com/appzcoder/laravel-admin/blob/master/src/publish/views/layouts/app.blade.php) in order to use the package's layout file.

12. You can generate CRUD easily through generator tool now.

## Usage

1. Create some roles.

2. Create some permissions.

3. Give permission(s) to a role.

4. Create user(s) with role.

5. For checking authenticated user's role see below:

    ```php
    // Check role anywhere
    if(Auth::user()->hasRole('admin')) {
        // Do admin stuff here
    } else {
        // Do nothing
    }

    // Check role in route middleware
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'admin'], function () {
       Route::get('/', ['uses' => 'AdminController@index']);
    });
    ```

6. For checking permissions see below:

    ```php
    if($user->can('permission-name')) {
        // Do something
    }
    ```

Learn more about ACL from [here](https://laravel.com/docs/5.3/authorization)

## Screenshots

![users](https://cloud.githubusercontent.com/assets/1708683/18842802/19563d0e-8438-11e6-8d2f-502dd121306e.png)

![roles](https://cloud.githubusercontent.com/assets/1708683/18842797/19400692-8438-11e6-9e4a-801fd55f3111.png)

![new role](https://cloud.githubusercontent.com/assets/1708683/18842801/1944fd96-8438-11e6-8428-afe6af3ceb46.png)

![permissions](https://cloud.githubusercontent.com/assets/1708683/18842799/19417130-8438-11e6-9119-b4961ba2c758.png)

![give permission to a role](https://cloud.githubusercontent.com/assets/1708683/18842800/1943a70c-8438-11e6-957a-a5c5cbf38c90.png)

![generator](https://cloud.githubusercontent.com/assets/1708683/18842798/1940cd70-8438-11e6-8619-7a9a8ab4bfa5.png)


##Author

[Sohel Amin](http://www.sohelamin.com)
