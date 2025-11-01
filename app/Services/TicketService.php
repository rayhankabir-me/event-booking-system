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
