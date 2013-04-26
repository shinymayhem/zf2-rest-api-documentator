<?php
return array(
    // Configuration namespace within this module looking for data
    'zf2-rest-api-documentator' => array(
        // Contains collection of documentation descriptions.
        'docs' => array(
            // Namespace of module within REST API description resides. Must be unique per module.
            'zf2-rest-api-documentator' => array(
                'name' => 'widmogrod/zf2-rest-api-documentator',
                'version' => '1.0.0',
                'baseUrl' => 'http://127.0.0.1:8081/api',
                // Strategy is way, in which this configuration will be interpreted.
                'strategy' => 'standard',
                // General description for common thing in module, to skip redundancy
                'general' => array(
                    'params' => array(
                        'id' => array(
                            'type' => 'string',
                            'required' => true,
                            'description' => 'Resource identification'
                        ),
                    ),
                ),
                // REST API Endpoings, here you describing your API
                'resources' => array(
                    'POST: /request/<id>/<endpoint>' => array(
                        'description' => 'Perform request for given API <id> - <endpoint>',
                        'headers' => array(
                            'X-Test-Header' => array(
                                'type' => 'string',
                                'required' => true,
                                'description' => 'Header is test header. Nothing special.'
                            ),
                        ),
                        'body' => array(
                            'params' => array(
                                'urlParams' => array(
                                    'type' => 'array',
                                    'description' => 'Contains set of $key => $value pair, where $key is a url segment id and $value is it\'s value',
                                ),
                                'queryParams' => array(
                                    'type' => 'array',
                                    'description' => 'Contains set of $key => $value pair, where $key is a url query param id and $value is it\'s value',
                                ),
                                'headers' => array(
                                    'type' => 'array',
                                    'description' => 'Contains set of $key => $value pair, where $key is a header name and $value is it\'s value',
                                ),
                                'body' => array(
                                    'type' => 'array',
                                    'description' => 'Contains set of $key => $value pair, where $key is a body param name and $value is it\'s value',
                                ),
                            ),
                        ),
                        'params' => array(
                            'endpoint' => array(
                                'type' => 'string',
                                'required' => true,
                                'description' => 'Endpoint identification'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);