<?php

namespace Src\Controllers;

use Src\Models\City;

class CityController
{

    public function index(): array
    {
        return City::with(['state'])->get()->toArray();
    }

    public function show(int $id): array
    {
        return City::with(['state'])->find($id)->toArray();
    }

}
