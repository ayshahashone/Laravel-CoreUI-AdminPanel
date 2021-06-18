<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCabRequest;
use App\Http\Requests\UpdateCabRequest;
use App\Cab;

class CabsApiController extends Controller
{
    public function index()
    {
        $cabs = Cab::all();

        return $cabs;
    }

    public function store(StoreCabRequest $request)
    {
        return Cab::create($request->all());
    }

    public function update(UpdateCabRequest $request, Cab $cab)
    {
        return $cab->update($request->all());
    }

    public function show(Cab $cab)
    {
        return $cab;
    }

    public function destroy(Cab $cab)
    {
        return $cab->delete();
    }
}
