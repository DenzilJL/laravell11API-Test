<?php
namespace App\Filters;

use Illuminate\Http\Request;



class CustomerFilter extends ApiFilter
{
    protected $availableParms = [
        'name' => ['eq', 'neq'],
        'type' => ['eq', 'neq'],
        'address' => ['eq', 'neq'],
        'city' => ['eq', 'neq'],
        'state' => ['eq', 'neq'],
        'active' => ['eq', 'neq'],
        'postalCode' => ['eq', 'lt', 'gt', 'gte', 'lte', 'neq'],
    ];

    // columnMap used to transform the query string value to equalent db value
    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
        'gt' => '>',
        'lt' => '<',
        'gte' => '>=',
        'lte' => '<=',
    ];
}
