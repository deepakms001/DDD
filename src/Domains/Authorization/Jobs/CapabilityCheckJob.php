<?php

namespace Lucid\Domains\Authorization\Jobs;

use Lucid\Authorization\Exceptions\UnauthorizedAccess;
use Lucid\Foundation\Job;

class CapabilityCheckJob extends Job
{
    protected $authorization;

    protected $closure;

    public function __construct(\Closure $closure)
    {
        $this->authorization = app('authorization');
        $this->closure       = $closure;
    }

    public function handle()
    {
        if ($this->authorization->capableIf($this->closure)) {
            return true;
        }

        throw new UnauthorizedAccess('Access Forbidden', 403);
    }
}