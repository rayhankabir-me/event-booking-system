<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Event;
use App\Models\Ticket;
use App\Services\TicketService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function store(Event $event, TicketRequest $request)
    {
        try {
            $ticket = $this->ticketService->create($event, $request);
            return new TicketResource($ticket);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        try {
            $ticket = $this->ticketService->update($request, $ticket);
            return new TicketResource($ticket);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function destroy(Ticket $ticket)
    {
        try {
            $this->ticketService->destroy($ticket);
            return response([
                'status' => true,
                'message' => 'Ticket deleted successfully'
            ], 200);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }
}
