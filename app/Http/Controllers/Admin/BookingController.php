<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookingRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Bookinginfo;
use App\Bookingrequest;
use App\Driver;
use App\Cab;
use App\User;

class BookingController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('booking_access'), 403);

        $bookings = Bookingrequest::all()->sortByDesc("created_at");

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('booking_create'), 403);
        
        // attach user information
        $users = User::where('name', '!=' , 'Admin')->get();
       
        return view('admin.bookings.create', compact('users'));
    }

    public function store(StoreBookingRequest $request)
    {
        
        abort_unless(\Gate::allows('booking_create'), 403);

        $booking = Bookingrequest::create($request->all());

        return redirect()->route('admin.bookings.index');
    }

    public function edit(Bookingrequest $booking)
    {
        abort_unless(\Gate::allows('booking_edit'), 403);
        
        // attach driver information
        $drivers = Driver::all()->sortByDesc("created_at");

        // attach cab information
        $cabs   = Cab::all()->sortByDesc("created_at");

        // attach user information
        $user = User::where('id',$booking->user_id)->first();

        return view('admin.bookings.edit', compact('booking','drivers','cabs','user'));
    }

    public function update(UpdateBookingRequest $request, Bookingrequest $booking)
    {
       
        abort_unless(\Gate::allows('booking_edit'), 403);
        
        $bookinginfo = new Bookinginfo; 

        // Another way to insert records
        if($request->status == 'accept'){
            $bookinginfo->create($request->all());
        }
        // else do nothing
        // if status value is accept just update the status value
        $booking->where('id', $booking->id)->update(['status' => $request->status]);

        return redirect()->route('admin.bookings.index');
    }

    public function show(Bookingrequest $booking)
    {
        abort_unless(\Gate::allows('booking_show'), 403);

        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy(Bookingrequest $booking)
    {
        abort_unless(\Gate::allows('booking_delete'), 403);

        $booking->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingRequest $request)
    {
        Bookingrequest::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
