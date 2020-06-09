<?php
namespace Lucid\Foundation;

use Lucid\Foundation\Traits\JobDispatcherTrait;
use Lucid\Foundation\Traits\MarshalTrait;

abstract class Feature
{
    use MarshalTrait;
    use JobDispatcherTrait;
}