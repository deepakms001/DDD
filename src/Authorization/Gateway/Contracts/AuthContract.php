<?php

namespace Lucid\Authorization\Gateway\Contracts;

use Illuminate\Http\Request;

interface AuthContract
{
    public function handle(Request $request);
}