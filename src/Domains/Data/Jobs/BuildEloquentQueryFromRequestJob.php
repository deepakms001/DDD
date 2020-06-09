<?php

namespace Lucid\Domains\Data\Jobs;

use Lucid\Domains\Data\Traits\EloquentRequestQueryable;
use Lucid\Foundation\Http\Request;
use Lucid\Foundation\Job;

class BuildEloquentQueryFromRequestJob extends Job
{
    use EloquentRequestQueryable;

    protected $model;

    protected $paginateResult;

    protected $dataKey;

    public function __construct($model, $paginate = true, $dataKey = 'data')
    {
        if (is_string($model)) {
            $this->model = new $model;
        } else {
            $this->model = $model;
        }

        $this->paginateResult = $paginate;
        $this->dataKey        = $dataKey;
    }

    public function handle(Request $request)
    {
        $this->setModel($this->model);
        $this->captureRequestQuery($request);

        $builder = $this->buildQuery();

        if (! $this->paginateResult) {
            return $builder->get();
        }

        return $this->paginateResult($builder, $this->dataKey);
    }
}