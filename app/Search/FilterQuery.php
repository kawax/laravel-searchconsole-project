<?php

namespace App\Search;

use Revolution\Google\SearchConsole\Query\AbstractQuery;
use Google_Service_Webmasters_ApiDimensionFilter as Filter;
use Google_Service_Webmasters_ApiDimensionFilterGroup as FilterGroup;

class FilterQuery extends AbstractQuery
{
    public function init()
    {
        $this->setDimensions(['page']);
        $this->setAggregationType(['auto']);
        $this->setRowLimit(100);
    }

    /**
     * @param  string  $filter_dimension
     * @param  string  $filter_expression
     */
    public function filter(string $filter_dimension, string $filter_expression)
    {
        if (empty($filter_expression)) {
            return;
        }

        $filter = new Filter();
        $filter->setDimension($filter_dimension);
        $filter->setExpression($filter_expression);
        $filter->setOperator('equals');

        $filter_group = new FilterGroup();
        $filter_group->setFilters([$filter]);
        $this->setDimensionFilterGroups([$filter_group]);
    }
}
