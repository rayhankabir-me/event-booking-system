<?php

namespace App\Services;

use App\Http\Requests\EventRequest;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PaginateRequest;
use App\Models\Event;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class EventService
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

            $query = Event::with('organizer');

            if ($request->filled('created_by')) {
                $query->where('created_by', $request->get('created_by'));
            }

            if ($request->filled('title')) {
                $query->search($request->get('title'));
            }

            if ($request->filled('description')) {
                $query->search($request->get('description'));
            }

            if ($request->filled('location')) {
                $query->search($request->get('location'));
            }

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('date', [
                    $request->get('date_from'),
                    $request->get('date_to')
                ]);
            } else if ($request->filled('date_from')) {
                $query->whereDate('date', '>=', $request->get('date_from'));
            } else if ($request->filled('date_to')) {
                $query->whereDate('date', '<=', $request->get('date_to'));
            }

            return $query->orderBy($orderColumn, $orderType)->$method($methodValue);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function show(Event $event): Event
    {
        try {
            return $event->load('organizer', 'tickets');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    public function create(EventRequest $request)
    {
        try {
            $event = Event::create([
                'title'       => $request->title,
                'description' => $request->description ?? "",
                'location'    => $request->location,
                'date'        => $request->date,
                'created_by'  => auth()->user()->id,
            ]);

            return $event;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }


    public function update(EventRequest $request, Event $event)
    {
        try {

            if ($event->created_by !== Auth::id()) {
                throw new Exception('You are not authorized to update this event', 403);
            }

            $event->update([
                'title'       => $request->title,
                'description' => $request->description ?? "",
                'location'    => $request->location,
                'date'        => $request->date,
            ]);

            return $event;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function destroy(Event $event)
    {
        try {

            if ($event->created_by !== Auth::id()) {
                throw new Exception('You are not authorized to delete this event', 403);
            }

            $event->delete();
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
