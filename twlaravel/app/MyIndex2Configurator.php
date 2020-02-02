<?php

namespace App;

use ScoutElastic\IndexConfigurator;
// use ScoutElastic\Migratable;

class MyIndex2Configurator extends IndexConfigurator
{
    // use Migratable;
    protected $name = 'my_index2';
    /**
     * @var array
     */
    protected $settings = [
        'analysis' => 
        [
             'analyzer' => [
                 'autocomplete' => [
                     'tokenizer' => 'autocomplete',
                     'filter' => [
                         'lowercase',
                     ],
                 ],
                 'autocomplete_search' => [
                     'tokenizer' => 'lowercase',
                 ],
             ],
             'tokenizer' => [
                 'autocomplete' => [
                     'type' => 'edge_ngram',
                     'min_gram' => 1,
                     'max_gram' => 20,
                     'token_chars' => [
                         'letter'
                     ]
                 ]
             ]
        ]
    ];
}