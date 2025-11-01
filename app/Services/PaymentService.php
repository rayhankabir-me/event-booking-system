<?php

namespace App\Services;

use App\Enum\BookingStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Http\Requests\PaymentRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentService
{

    public function pay(Booking $booking, PaymentRequest $request)
    {
        
        try {

            if($booking->status === BookingStatusEnum::CANCELLED){
                throw new Exception("Cannot pay for a cancelled booking.", 422);
            }

            $payment = Payment::create([
                'user_id' => Auth::id(),
                'booking_id' => $booking->id,
                'amount' => $request->amount,
                'status' => PaymentStatusEnum::SUCCESS,
            ]);

            if($payment && $booking->status === BookingStatusEnum::PENDING){
                $booking->status = BookingStatusEnum::CONFIRMED;
                $booking->save();
            }

            return $payment;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function show(Payment $payment)
    {
        try {
            return $payment->load('user', 'booking');
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

}
