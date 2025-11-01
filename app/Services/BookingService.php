<?php

namespace App\Services;

use App\Enum\BookingStatusEnum;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\PaginateRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $query = Booking::with('user', 'ticket')->where('user_id', Auth::id());

            return $query->orderBy($orderColumn, $orderType)->$method($methodValue);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    public function book(Ticket $ticket, BookingRequest $request)
    {
        
        DB::beginTransaction();
        try {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'ticket_id' => $ticket->id,
                'quantity' => $request->quantity,
                'status' => BookingStatusEnum::PENDING,
            ]);

            DB::commit();
            return $booking;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            DB::rollBack();
            throw new Exception($exception->getMessage(), 422);
        }
    }


    public function cancel(Booking $booking)
    {
        try {

            if ($booking->user_id !== Auth::id()) {
                throw new Exception('You are not authorized to cancel this booking', 403);
            }

            $booking->update([
                'status' => BookingStatusEnum::CANCELLED,
            ]);

            return $booking;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

}
