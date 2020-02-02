<?php

namespace App;

use ScoutElastic\SearchRule;

class MySearchRule extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildQueryPayload()
    {
        $query = $this->builder->query;
        // return [
        //     'should' => [
        //         [
        //             'match' => [
        //                 'login' => [
        //                     'query' => $query,
        //                     'boost' => 2
        //                 ]
        //             ]
        //         ],
        //         [
        //             'match' => [
        //                 'first_name' => [
        //                     'query' => $query,
        //                     'boost' => 1
        //                 ]
        //             ]
        //         ],
        //         [
        //             'match' => [
        //                 'lastt_name' => [
        //                     'query' => $query,
        //                     'boost' => 1
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];
         return [
            'must'  =>  [
                'multi_match' =>  [
                    // "type"  =>  "most_fields",
                    "type"      =>  'phrase_prefix',
                    "query"     =>  $query,
                    "fields"    =>  ["login","name"], //*_name
                    
                    // "minimum_should_match"  =>  '-10%',
                    // "fuzziness" =>  '2',
                     "prefix_length" => '1'
                ]
            ],
        ];
        // return [
        //     'must' => [
        //         'fuzzy' => [
        //             'login' =>$query 
        //         ]
        //     ]
        // ];
    }

    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {

    }
}