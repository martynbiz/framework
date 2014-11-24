#Introduction

This is a PHP MVC framework built to be simple to use yet flexible enough to alter where needed. It relies upon dependency injection to allow components to swapped out and replaced. This is very well suited to unit testing.

Also, it shares it's routes and templates with the client side Javascript. The framework will automatically provide everything the front end needs to load templates using AJAX for much faster page loads. It also works fully without JavaScript falling back to traditional page loads to ensure that the site doesn't hand with JavaScript errors.

#What's new?

- Shared templates between the server and front end
- Service container which handles factories
- Mock environments for unit tests
- Powerful ORM (optional)
- Simple, flexible means to setting configuration

#Getting started

Although the framework alone can be used to write applications, it doesn't do much more that a micro framework (e.g. Slim) with some basic MVC implementation. To get the most out of it (e.g. shared templates) it is recommended to install the skeleton app. This will allow you to access the template view classes and JavaScript where required (e.g. switch template engines)

The example below uses Git and Composer to install dependencies. If using this method please ensure both are installed on your machine first.

```
git clone ...
composer.sh install
```

##/public/index.php

```php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// require composer autoloader for loading classes
require realpath(APPLICATION_PATH . '/../vendor/autoload.php');

// config is expected to be a PHP array
require realpath(APPLICATION_PATH . '/config.php');

$app = new MartynBiz\Application($config);

// Run it!
$app->run();
```

##Configuration

Configuration for the framework only requires a PHP array. But to simplify setting configuration in the skeleton app and handling different environments (e.g. development), config files have been organized into folders within the /app/config directory. To combine the config arrays within each folder, the skeleton app uses the app/config loader file which loads all the configs for the current environment producing a resulting PHP array. These files/folder and loader could quite easily be replaced with any other means (ini file(s), xml file(s), from a database etc) so long as the Application instance receives a resulting PHP array.

###/app/config/routes.php

Routes are required to be set within the application. Athough the Application can be instantiated without any routes, in the current implementation of the framework, that would be pretty pointless. Below is a snippet of routes from the routes config file. Notice how url patterns can be grouped in the case of /accounts/show. Also, routes use Perl regular expressions to allow URL validation (e.g. only accepting numbers for IDs).

```php
return array(
    
    // ...
    
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
    
    // ...
    
);
```



#Controllers

**Detecting request type 

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

Add to services config


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

#TODO

- create/test default Martyn\View\View which renders PHP layouts/scripts
- create/test App\View\Handlebars
- Composer
- Validation
- Security - xsfr