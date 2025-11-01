<?php

namespace App\Http\Middleware;

use App\Enum\BookingStatusEnum;
use App\Models\Booking;
use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventDoubleBooking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        $ticket = $request->route('ticket');
        if(!$ticket) return response()->json(['status' => false, 'message'=>'Ticket not found'],404);

        $exists = Booking::where('user_id', $user->id)
            ->where('ticket_id', $ticket->id)
            ->where('status','!=',BookingStatusEnum::CANCELLED)
            ->exists();

        if($exists) return response()->json(['status' => false, 'message'=>'You already have a booking for this ticket'], 422);

        return $next($request);
    }
}
