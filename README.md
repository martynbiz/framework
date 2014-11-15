#Introduction

This is a PHP MVC framework built to be simple to use yet flexible enough to alter where needed. It relies heay upon dependency injection to allow components to swapped out and replaced. This is very well suited to unit testing or where a component needs to be altered.

Also, it shared it's routes and templates with the client side Javascript. The framework will automatically provide everything the front end needs to load templates using AJAX for much faster page loads. It also works fully without JavaScript falling back to traditional page loads to ensure that the site doesn't hand with JavaScript errors.

#Installation

##Composer (coming soon)

```
{
    "require": {
        "martynbiz/framework": "master-dev"
    }
}
```

#Getting started

```php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// require composer autoloader for loading classes
require realpath(APPLICATION_PATH . '/../vendor/autoload.php');

require realpath(APPLICATION_PATH . '/config.php');

$app = new MartynBiz\Application($config);

// Run it!
$app->run();
```

##Configuration

```php
return array(
    
    // directories
    // these are the default direvctories but can easily be changed
    'controllersDir' => APPLICATION_PATH . '/controllers/',
    'layoutsDir' => realpath(APPLICATION_PATH . '/views/layouts/'),
    'templatesDir' => realpath(APPLICATION_PATH . '/../public/templates/'),
    
    // routes
    // routes are defined - [group/...]pattern/METHOD
    // patterns use perl regular expressions to allow for string verification
    'routes' => array(
        '/' => array(
            'GET' => array(
                'controller' => 'home',
                'action' => 'index',
            )
        ),
        '/accounts' => array( // route group
            '/(\d+)' => array(
                'GET' => array(
                    'controller' => 'accounts',
                    'action' => 'show',
                ),
            ),
        ),
    )
    
    // services
    // services allow access to all the apps dependencies. Great for unit testing
    'services' => array(
        'controllers.home' => new App\Controller\HomeController(),
        'controllers.accounts' => new App\Controller\AccountsController(),
    ),
);
```

#Controllers

```php
class HomeController extends \MartynBiz\Controller
{
    function showAction($id)
    {
        // choose your orm, table tabele gateway, etc 
        $accountsTable = $this->app->service('models.accounts');
        
        $accounts = $accountsTable->find($id);
        
        // return to the front controller, it will determine which request
        // it is (e.g. XHR) and handle it automatically
        return array(
            'account' => $account,
        );
    }
}
```

#Templates

Create a template in Handlebars (or replace the View class with your own and render in whatever manner you wish)

```html
<ol class="breadcrumb">
    <li><a href="/accounts" data-data="/accounts" data-template="/templates/accounts/index.php">Accounts</a></li>
    <li class="active">{{ name }}</li>
</ol>

<table class="table table-striped">
    <tr>
        <th>id</th>
        <td>{{ id }}</td>
    </tr>
    <tr>
        <th>name</th>
        <td>{{ name }}</td>
    </tr>
    <tr>
        <th>amount</th>
        <td>{{ amount }}</td>
    </tr>
    <tr>
        <th>created_at</th>
        <td>{{ created_at }}</td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td>{{ updated_at }}</td>
    </tr>
    <tr>
    </tr>
</table>

<div>
    <a href="/accounts/{{ id }}/edit" data-data="/accounts/{{ id }}" data-template="/templates/accounts/edit.php" class="btn btn-primary" role="button">Edit</a>
</div>
```

##All done

And that's it. The skeleton app has everything it needs to handle even the template loading and rendering on the front end.