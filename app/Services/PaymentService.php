<?php

namespace App\Services;

use App\Enum\BookingStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Http\Requests\PaymentRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Payment;
use App\Notifications\BookingConfirmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentService
{

    public function pay(Booking $booking, PaymentRequest $request)
    {
        DB::beginTransaction();
        try {

            if($booking->status === BookingStatusEnum::CANCELLED){
                throw new Exception("Cannot pay for a cancelled booking.", 422);
            }

            if($booking->status === BookingStatusEnum::CONFIRMED){
                throw new Exception("Cannot pay for a confirmed booking.", 422);
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

                $booking->user->notify(new BookingConfirmed($booking));
            }
            DB::commit();
            return $payment;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            DB::rollBack();
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
