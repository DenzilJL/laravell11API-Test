<?php
namespace App\Filters;

use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter
{
    protected $availableParms = [
        'customerId' => ['eq', 'neq'],
        'title' => ['eq', 'neq'],
        'description' => ['eq', 'neq'],
        'amount' => ['eq', 'lt', 'gt', 'gte', 'lte', 'neq'],
        'status' => ['eq', 'neq'],
        'active' => ['eq', 'neq'],
        'billedDate' => ['eq', 'neq'],
        'paidDate' => ['eq', 'neq'],
    ];

    // columnMap used to transform the query string value to equalent db value
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid _date',
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
