<?php
/*
    cd /home/admin/web/twlaravel.sozinov.space/public_html/docker-project/  

    make class searchable model with index congiguration class
    php artisan make:searchable-model MyModel --index-configurator=MyIndexConfigurator

    Update model with ES
    php artisan elastic:update-mapping "App\MyModel"


    Update model data in ES: 
    php artisan scout:import "App\MyModel"

    create class index config 
    php artisan make:index-configurator MyIndexConfigurator
    create index in ES
    php artisan elastic:create-index "App\MyIndexConfigurator"

    get data index
    curl localhost:9200/my_index?pretty

    delete index
    curl -XDELETE localhost:9200/my_index

    create index class



    список образов 
    docker images -a

    docker-compose up --build


 */
namespace App;

use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    use Searchable;
    public    $timestamps = false;
    protected $indexConfigurator = MyIndexConfigurator::class;
    protected $searchRules = [ 
        MySearchRule::class 
    ];

    // Here you can specify a mapping for model fields
    protected $mapping = [
        'properties' => [
            'id' => [
                'type' => 'integer'
            ],
            'name' => [
                'type' => 'text'
                // Also you can configure multi-fields, more details you can find here https://www.elastic.co/guide/en/elasticsearch/reference/current/multi-fields.html
            ],
            'login' => [
                'type' => 'text'    
                // Also you can configure multi-fields, more details you can find here https://www.elastic.co/guide/en/elasticsearch/reference/current/multi-fields.html
            ],
        ]
    ];

    protected $fillable = ['id', 'name', 'login' ];

}