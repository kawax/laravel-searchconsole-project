<?php

namespace App\Search;

use Revolution\Google\SearchConsole\Query\AbstractQuery;

class SampleQuery extends AbstractQuery
{
    public function init()
    {
        $this->setStartDate(now()->subMonthWithoutOverflow()->toDateString());
        $this->setEndDate(now()->toDateString());
        $this->setDimensions(['query']);
        $this->setAggregationType(['auto']);
        $this->setRowLimit(100);
    }
}
