<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDriverRequest;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Driver;

class DriverController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('driver_access'), 403);

        $drivers = Driver::all();

        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('driver_create'), 403);

        return view('admin.drivers.create');
    }

    public function store(StoreDriverRequest $request)
    {
        
        abort_unless(\Gate::allows('driver_create'), 403);

        $driver = Driver::create($request->all());

        return redirect()->route('admin.drivers.index');
    }

    public function edit(Driver $driver)
    {
        abort_unless(\Gate::allows('driver_edit'), 403);

        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        abort_unless(\Gate::allows('driver_edit'), 403);

        $driver->update($request->all());

        return redirect()->route('admin.drivers.index');
    }

    public function show(Driver $driver)
    {
        abort_unless(\Gate::allows('driver_show'), 403);

        return view('admin.drivers.show', compact('driver'));
    }

    public function destroy(Driver $driver)
    {
        abort_unless(\Gate::allows('driver_delete'), 403);

        $driver->delete();

        return back();
    }

    public function massDestroy(MassDestroyDriverRequest $request)
    {
        Driver::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
