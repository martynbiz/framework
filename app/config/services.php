<?php
/**
* Services can be regarded here as anything is required by controllers, or for testing
* To test how controllers are handled in the Application, we need to be able to set them 
* here too.
*
* ****Some objects need to be instantiated after we have a app with config (e.g. models for db configs)
* Think I'll have a boostrap for that purpose.
*
*/

return array(
    'services' => array(
        'controllers.accounts' => new App\Controller\AccountsController(),
        
        'View' => function() {
            $engine = new Handlebars\Handlebars();
            return new \App\View\HandlebarsView($engine);
        },
    ),
);