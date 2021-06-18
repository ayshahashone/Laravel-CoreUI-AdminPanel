<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCabRequest;
use App\Http\Requests\StoreCabRequest;
use App\Http\Requests\UpdateCabRequest;
use App\Cab;

class CabController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('cab_access'), 403);

        $cabs = Cab::all();

        return view('admin.cabs.index', compact('cabs'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('cab_create'), 403);

        return view('admin.cabs.create');
    }

    public function store(StoreCabRequest $request)
    {
        
        abort_unless(\Gate::allows('cab_create'), 403);

        $cab = Cab::create($request->all());

        return redirect()->route('admin.cabs.index');
    }

    public function edit(Cab $cab)
    {
        abort_unless(\Gate::allows('cab_edit'), 403);

        return view('admin.cabs.edit', compact('cab'));
    }

    public function update(UpdateCabRequest $request, Cab $cab)
    {
        abort_unless(\Gate::allows('cab_edit'), 403);

        $cab->update($request->all());

        return redirect()->route('admin.cabs.index');
    }

    public function show(Cab $cab)
    {
        abort_unless(\Gate::allows('cab_show'), 403);

        return view('admin.cabs.show', compact('cab'));
    }

    public function destroy(Cab $cab)
    {
        abort_unless(\Gate::allows('cab_delete'), 403);

        $cab->delete();

        return back();
    }

    public function massDestroy(MassDestroyCabRequest $request)
    {
        Cab::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
