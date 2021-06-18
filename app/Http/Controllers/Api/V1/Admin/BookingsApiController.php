<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\BookingRequest;

class BookingsApiController extends Controller
{
    public function index()
    {
        $bookings = BookingRequest::all();

        return $bookings;
    }

    public function store(StoreBookingRequest $request)
    {
        return Booking::create($request->all());
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        return $booking->update($request->all());
    }

    public function show(BookingRequest $bookingrequest)
    {
        return $bookingrequest;
    }

    public function destroy(BookingRequest $bookingrequest)
    {
        return $bookingrequest->delete();
    }
}
