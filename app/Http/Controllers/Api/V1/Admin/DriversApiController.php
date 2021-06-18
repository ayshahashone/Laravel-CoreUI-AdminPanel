<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Driver;

class DriversApiController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();

        return $drivers;
    }

    public function store(StoreDriverRequest $request)
    {
        return Driver::create($request->all());
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        return $driver->update($request->all());
    }

    public function show(Driver $driver)
    {
        return $driver;
    }

    public function destroy(Driver $driver)
    {
        return $driver->delete();
    }
}
