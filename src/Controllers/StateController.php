<?php

namespace Src\Controllers;

use Src\Models\State;

class StateController
{

    public function index(): array
    {
        return State::with(['cities'])->get()->toArray();
    }

    public function show(int $id): array
    {
        return State::with(['cities'])->find($id)->toArray();
    }

}
