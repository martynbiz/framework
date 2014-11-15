<?php
/*
This is where our routes are defined so that we can generate js or json files

*/

return array(
    'routes' => array(
        '/' => array(
            'GET' => array(
                'controller' => 'index',
                'action' => 'index',
            ),
        ),
        '/about' => array(
            'GET' => array(
                'controller' => 'index',
                'action' => 'about',
            ),
        ),
        '/accounts' => array(
            '/' => array(
                'GET' => array(
                    'controller' => 'accounts',
                    'action' => 'index',
                ),
            ),
            '/(\d+)' => array(
                'GET' => array(
                    'controller' => 'accounts',
                    'action' => 'show',
                ),
            ),
            '/create' => array(
                'GET' => array(
                    'controller' => 'accounts',
                    'action' => 'create',
                ),
                'POST' => array(
                    'controller' => 'accounts',
                    'action' => 'create',
                ),
            ),
            '/(\d+)/edit' => array(
                'GET' => array(
                    'controller' => 'accounts',
                    'action' => 'edit',
                ),
                'PUT' => array(
                    'controller' => 'accounts',
                    'action' => 'edit',
                ),
            ),
            '/(\d+)/delete' => array(
                'GET' => array(
                    'controller' => 'accounts',
                    'action' => 'delete',
                ),
                'DELETE' => array(
                    'controller' => 'accounts',
                    'action' => 'delete',
                ),
            ),
        ),
    )
);