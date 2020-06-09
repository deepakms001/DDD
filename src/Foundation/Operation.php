<?php
namespace Lucid\Foundation;

use Lucid\Foundation\Traits\JobDispatcherTrait;
use Lucid\Foundation\Traits\MarshalTrait;

abstract class Operation
{
    use MarshalTrait;
    use JobDispatcherTrait;
}