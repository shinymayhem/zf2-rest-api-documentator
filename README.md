# Module generating REST API documentation v1.6.1 [![Build Status](https://travis-ci.org/widmogrod/zf2-rest-api-documentator.png?branch=master)](https://travis-ci.org/widmogrod/zf2-rest-api-documentator)
## Introduction

This module allow to create quick documentation of your REST API.

Main features that I want to implement:

 - Generate REST API documentation.
   - `[√]` Describe function of available parameters
   - `[√]` Create a general description of the parameters several times repeated
 - Unlimited number of documented APIs
   - `[√]` Create modules for ZF2 containing a good and standardized documentation
 - Elastic & simple to use.
   - `[√]` Use predefined interpreter for configuration or write it by your self
   - `[-]` Do you have a self-describing API and you want to automaticly build documentation from it? Help me, to write that kind of interpreter or wait until I'll do it
 - Well documented
   - `[√]` The module is shipped with API documentation, documented by this module.
   - `[√]` Some issues are described in tips & trick section
 - Posibility to test & play with API from docs page
   - `[√]` Execute API call from documentation
   - `[-]` Performing authorization (OAuth, BaseAuth, ...)

Read [TODO.md](https://github.com/widmogrod/zf2-rest-api-documentator/blob/master/TODO.md) for more information.

## Installation

  1. `cd my/project/directory`
  2. Create a `composer.json` file with following content:

``` json
{
    "require": {
        "widmogrod/zf2-rest-api-documentator": "1.*"
    }
}
```

  3. Run `php composer.phar install`
  4. Open ``my/project/folder/configs/application.config.php`` and:
    - add ``'WidRestApiDocumentator'`` to your ``'modules'`` parameter.
    - add ``'AsseticBundle'`` to your ``'modules'`` parameter (optional if you want to include CSS)


## Usage

Bellow is php configuration file that show haw to implement simple REST API documentation in your module.
This is a minimal configuration required to achieve result shown further dawn.

```php
<?php
return array(
    // Configuration namespace within this module looking for data
    'zf2-rest-api-documentator' => array(
        // Contains collection of documentation descriptions.
        'docs' => array(
            // Namespace of module within REST API description resides. Must be unique per module.
            'my_module_name' => array(
                'name' => 'api.example.com',
                'version' => '1.1',
                'baseUrl' => 'http://127.0.0.1:8080/api',
                // Strategy is the way in which this configuration will be interpreted.
                'strategy' => 'standard',
                // General description for common things in module, to skip redundancy
                'general' => array(
                    'headers' => array(
                        'accept' => array(
                            'name' => 'Accept'
                            'type' => 'string',
                            'required' => true,
                            'description' => 'Content type to return'
                        ),
                    ),
                    'params' => array(
                        'user' => array(
                            'type' => 'string',
                            'required' => true,
                            'description' => 'Username'
                        ),
                        'id' => array(
                            'type' => 'integer',
                            'required' => true,
                            'description' => 'Resource identifier'
                        ),
                        'limit' => array(
                            'type' => 'integer',
                            'description' => 'Limit API result to given value. Value must be between 1-100'
                        ),
                        'order' => array(
                            'type' => 'string',
                            'required' => false,
                            'description' => 'Retrieve API result ordered by given value. Acceptable values: asc, desc.'
                        ),
                    ),
                ),
                // REST API Endpoints, here you're describing your API
                'resources' => array(
                    'GET: /keywords' => 'Fetch list of keywords',
                    'POST: /keywords' => array(
                        'body' => array(
                            'type' => 'WidRestApiDocumentator\Body\JsonBody',
                            'params' => array(
                                'user',
                                'name' => array(
                                    'type' => 'string',
                                    'required' => true,
                                    'description' => 'Keyword name',
                                ),
                            ),
                        ),
                    ),
                    'GET: /keywords/<id>' => 'Fetch specific keyword',
                    'GET: /keywords/<id>/search_engines?limit=&order=',
                    'GET: /keywords/<id>/domains_positions_in_search_engine',
                    'PUT: /users/me' => array(
                        'description' => 'Demonstration endpoint that uses headers & body params',
                        'headers' => array(
                            'accept',
                            'X-Login' => array(
                                'type' => 'string',
                                'required' => true,
                                'description' => 'Header is test header. Nothing special.'
                            ),
                        ),
                        'body' => array(
                            'params' => array(
                                'token' => array(
                                    'type' => 'string',
                                    'description' => 'Authorization token',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);

```

Below is example showing how this configuration will look like.

To see this result, enter in browser your application addres and go to route `/rest-api-docs`.

![Example API](https://raw.github.com/widmogrod/zf2-rest-api-documentator/master/assets/generated-api.png)


## Tips & tricks
### Setup you own route to your documentation.

``` php
<?php
return array(
    'router' => array(
        'routes' => array(
            'rest-api-docs' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/my-api-doc',
                    'defaults' => array(
                        'controller' => 'WidRestApiDocumentator\Controller\Docs',
                        'action' => 'show',
                        // NOTE: "my_module_name" is name of key in which your documentation was defined (see usage above)
                        'id' => 'my_module_name',
                        // NOTE: This param, will disable back to list button. Is optional. Defaut value is "1".
                        'show_back_link' => 0,
))))));
```

### Write your own strategy

Currently module have one strategy named "standard".
Strategy is the way in which documentation configuration will be interpreted.
It's a very useful way to create your own interpreter.
To do that you need to do two things

  1. Write your strategy implementing this interface `WidRestApiDocumentator\StrategyInterface`
  2. Tell the module that there is new strategy. Create this configuration entry:

``` php
return array(
    'zf2-rest-api-documentator' => array(
        'strategies' => array(
            'invokables' => array(
                'myStrategy' => 'WidRestApiDocumentator\Strategy\Standard',
))));
```

### How to run this module without installing `ZendSkeletonApplication`

  1. Clone this module `git@github.com:widmogrod/zf2-rest-api-documentator.git`
  2. Go to module directory
  3. run `composer.phar install --dev`
  4. create file `index.php` in module directory with content:

``` php
<?php
chdir(__DIR__);
if (!is_dir('public/assets')) {
    mkdir('public/assets', 0777, true);
}

$config = array(
    'modules' => array(
        'AsseticBundle',
        'WidRestApiDocumentator',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'tests/config/autoload/{,*.}{global,local}.php',
        ),
        'config_static_paths' => array(
            'tests/config/autoload/assets.php',
            'config/api.config.php',
        ),
        'module_paths' => array(
            'WidRestApiDocumentator' => __DIR__
        ),
    ),
);

require_once 'vendor/autoload.php';

$app = Zend\Mvc\Application::init($config);
$app->run();
```

  5. Run web server in this directory f.e. `php -S 127.0.0.1:8080`

## Stability
[![Build Status](https://travis-ci.org/widmogrod/zf2-rest-api-documentator.png?branch=master)](https://travis-ci.org/widmogrod/zf2-rest-api-documentator)  on branch master

[![Build Status](https://travis-ci.org/widmogrod/zf2-rest-api-documentator.png?branch=devel)](https://travis-ci.org/widmogrod/zf2-rest-api-documentator)  on branch devel
