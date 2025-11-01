<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Ticket;
use App\Services\BookingService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(PaginateRequest $request) : Response | BookingResource | AnonymousResourceCollection
    {
        try {
            return BookingResource::collection($this->bookingService->index($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }


    public function book(Ticket $ticket, BookingRequest $request)
    {
        try {
            $booking = $this->bookingService->book($ticket, $request);
            return new BookingResource($booking);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function cancel(Booking $booking)
    {
        try {
            $booking = $this->bookingService->cancel($booking);
            return new BookingResource($booking);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }
}
