<?php

namespace Lucid\Foundation;

use Lucid\Foundation\Traits\ServesFeaturesTrait;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ServesFeaturesTrait;
}
