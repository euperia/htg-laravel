## HTG Laravel

A basic Laravel project aimed at facilitating rapid prototyping. Why write yet
another login form when you just want to try something out?

This project has:

* User Registration and Authentication
* Admin area with user management.
* Admin area using the excellent AdminLTE theme from Abdullah Almaseed (https://almsaeedstudio.com/)

![Screenshot](htg-admin.png)

# Requirements

* PHP 5.6+ (recommended PHP7+)
* MySQL 5.6
* Apache or Nginx web server
* composer installed

# Installation
1. Clone the repository to a local folder
2. Install the dependencies with composer: `composer install`
3. Copy the `.env.example` file to `.env`.  `cp .env.example .env`
4. Set up a MySQL Schema and add the credentials to `.env`.
5. Create a security key: `php artisan key:generate`
6. Run the migrations to install the database tables: `php artisan migrate`
7. Run the database seeds: `php artisan db:seed`
8. Start the web server `php artisan serve` should be enough to get you up and running.
9. Finally, browse to http://localhost:8000, and go make something awesome.

---
# Module Structure

This application consists of a modular strucure. For example, if you wanted to implement a contact us form on your website you would add this to a separate module.

Create a new directory inside the `modules` directory, and create new directories inside that for `Controllers`, `Models`, and `Views`.  Your directory structure should look like this:

    app/
        ...
        Modules/
            Contact/
                Controllers/
                Models/
                Views/

Edit the `config/module.php` file and add the directory name of your module to the array:

    <?php
    
    return [
        'modules' => [
            'User',
            'Contact'
        ]
    ];

Great, your module is good to go.

## Using Modules
You would use your modules as you would any other part of Laravel. Your module's Controller classes go in your module's `Controller` directory, models in the `Models` directory, and the views in the `Views` directory.

### Module routing
Routes for your modules are added to a `routes.php` file in the root of your module's directory. A prefix and namespace are added to the Route::group() method allowing your routes to be separated away.
For example, a route for the Contact module looks like this:

    <?php
    // app/Modules/Contact/routes.php
    
    Route::group([
            'prefix' => 'contact',
            'namespace' => 'App\Modules\Contact\Controllers'
        ],
        function () {
            Route::get('/', ['as' => 'contact_index', 'uses' => 'IndexController@index']);
            Route::post('/', ['as' => 'contact_submit', 'uses' => 'IndexController@submit']);
    });

You would use the route in your template as:

    <a href="{{ URL::route('contact_index') }}" title="contact">Contact</a>

### Module Views
To use your module's views from your controller classes you should reference them using the namespace you set up in the routes file:

    <?php
    namespace App\Modules\Contact\Controllers;

    use App\Http\Controllers\Controller;

    class IndexController extends Controller {

        public function index()
        {
            return View('contact::index');
        }

     }

### Module modules
TBC



## References

Module structure based on Kamran Ahmed's blog post at http://kamranahmed.info/blog/2015/12/03/creating-a-modular-application-in-laravel/


