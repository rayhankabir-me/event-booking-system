<?php

namespace App\Services;

use App\Enum\BookingStatusEnum;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\PaginateRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TicketRequest;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class BookingService
{

    /**
     * @throws Exception
     */
    public function index(PaginateRequest $request)
    {
        try {
            $method      = $request->get('paginate', 0) == 1 ? 'paginate' : 'get';
            $methodValue = $request->get('paginate', 0) == 1 ? $request->get('per_page', 10) : '*';
            $orderColumn = $request->get('order_column') ?? 'id';
            $orderType   = $request->get('order_type') ?? 'desc';

            $query = Booking::with('user', 'ticket');

            return $query->orderBy($orderColumn, $orderType)->$method($methodValue);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    public function book(Ticket $ticket, BookingRequest $request)
    {
        
        try {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'ticket_id' => $ticket->id,
                'quantity' => $request->quantity,
                'status' => BookingStatusEnum::PENDING,
            ]);

            return $booking;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }


    public function update(TicketRequest $request, Ticket $ticket)
    {
        try {

            if ($ticket->event?->created_by !== Auth::id()) {
                throw new Exception('You are not authorized to update this ticket', 403);
            }

            $ticket->update([
                'type' => $request->type,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            return $ticket;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

}
