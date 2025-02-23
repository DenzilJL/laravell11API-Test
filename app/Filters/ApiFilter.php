<?php
namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $availableParms = [];

    // columnMap used to transform the query string value to equalent db value
    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $filteredQuery = [];

        foreach ($this->availableParms as $parm => $operators) {
            $query = $request->query($parm);
            if (!isset($query)) {
                continue;
            }
            $column = $this->columnMap[$parm] ?? $parm;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $filteredQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $filteredQuery;

    }
}
