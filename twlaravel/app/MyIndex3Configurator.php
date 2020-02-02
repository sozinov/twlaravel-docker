<?php

namespace App;

use ScoutElastic\IndexConfigurator;
// use ScoutElastic\Migratable;

class MyIndex3Configurator extends IndexConfigurator
{
    // use Migratable;
    protected $name = 'my_index3';
    /**
     * @var array
     */
    protected $settings = [
        'analysis'  => [
                'filter'    =>  [
                    'autocomplete_filter' =>  [
                        'type'  =>  'edge_ngram',
                        'min_gram'  =>  2,
                        'max_gram'  =>  12,
                    ],
                ],
                'analyzer'  =>  [
                    'autocomplete' =>  [
                        'type'  =>  'custom',
                        'tokenizer' =>  'standard',
                        'filter'    =>  ['lowercase', 'autocomplete_filter']
                    ]
                ]
        ]
    ];
}