<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    /**
     * @throws Exception
     */
    // public function index(PaginateRequest $request)
    // {
    //     try {
    //         $method      = $request->get('paginate', 0) == 1 ? 'paginate' : 'get';
    //         $methodValue = $request->get('paginate', 0) == 1 ? $request->get('per_page', 10) : '*';
    //         $orderColumn = $request->get('order_column') ?? 'id';
    //         $orderType   = $request->get('order_type') ?? 'desc';

    //         $query = Event::with('organizer');

    //         if ($request->filled('created_by')) {
    //             $query->where('created_by', $request->get('created_by'));
    //         }

    //         if ($request->filled('title')) {
    //             $query->where('title', 'like', '%' . $request->get('title') . '%');
    //         }

    //         if ($request->filled('location')) {
    //             $query->where('location', 'like', '%' . $request->get('location') . '%');
    //         }

    //         if ($request->filled('date_from') && $request->filled('date_to')) {
    //             $query->whereBetween('date', [
    //                 $request->get('date_from'),
    //                 $request->get('date_to')
    //             ]);
    //         } else if ($request->filled('date_from')) {
    //             $query->whereDate('date', '>=', $request->get('date_from'));
    //         } else if ($request->filled('date_to')) {
    //             $query->whereDate('date', '<=', $request->get('date_to'));
    //         }

    //         return $query->orderBy($orderColumn, $orderType)->$method($methodValue);
    //     } catch (Exception $exception) {
    //         Log::info($exception->getMessage());
    //         throw new Exception($exception->getMessage(), 422);
    //     }
    // }

    /**
     * @throws Exception
     */
    // public function show(Event $event): Event
    // {
    //     try {
    //         return $event->load('organizer', 'tickets');
    //     } catch (Exception $exception) {
    //         Log::info($exception->getMessage());
    //         throw new Exception($exception->getMessage(), 422);
    //     }
    // }

    public function create(Event $event, TicketRequest $request)
    {
        
        try {

            if ($event->created_by !== Auth::id()) {
                throw new Exception('You are not authorized to create ticket under this event', 403);
            }

            $ticket = Ticket::create([
                'type' => $request->type,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'event_id' => $event->id,
            ]);

            return $ticket;
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

    /**
     * @throws Exception
     */
    public function destroy(Ticket $ticket)
    {
        try {

            if ($ticket->event?->created_by !== Auth::id()) {
                throw new Exception('You are not authorized to delete this ticket', 403);
            }

            $ticket->delete();
            return true;

        } catch (QueryException $e) {

            if ($e->getCode() == '23000') {
                throw new Exception('Cannot delete: resource is linked to another record.', 409);
            }
            
            Log::error('Database error during deletion: ' . $e->getMessage());
            throw new Exception('Database error: ' . $e->getMessage(), 422);

        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

}
