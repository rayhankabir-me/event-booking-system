<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\EventDetailsResource;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EventController extends Controller
{

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(PaginateRequest $request) : Response | EventResource | AnonymousResourceCollection
    {
        try {
            return EventResource::collection($this->eventService->index($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function show(Event $event) : EventDetailsResource | Response
    {
        try {
            return new EventDetailsResource($this->eventService->show($event));
        } catch (\Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function store(EventRequest $request)
    {
        try {
            $event = $this->eventService->create($request);
            return new EventResource($event);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function update(EventRequest $request, Event $event)
    {
        try {
            $event = $this->eventService->update($request, $event);
            return new EventResource($event);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function destroy(Event $event)
    {
        try {
            $this->eventService->destroy($event);
            return response([
                'status' => true,
                'message' => 'Event deleted successfully'
            ], 200);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

}
