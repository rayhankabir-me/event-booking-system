<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentDetailsResource;
use App\Http\Resources\PaymentResource;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\PaymentService;
use Exception;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function pay(Booking $booking, PaymentRequest $request)
    {
        try {
            $payment = $this->paymentService->pay($booking, $request);
            return new PaymentResource($payment);
        } catch (Exception $exception) {
            return response([
                'status' => false,
                'message' => $exception->getMessage()
            ], 422);
        }
    }

    public function show(Payment $payment) : PaymentDetailsResource | Response
    {
        try {
            return new PaymentDetailsResource($this->paymentService->show($payment));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }
}
