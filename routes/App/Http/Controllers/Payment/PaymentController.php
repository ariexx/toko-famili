<?php

namespace App\Http\Controllers\Payment;


use App\Models\Order;
use Response;

class PaymentController
{
    public function callback(\Illuminate\Http\Request $request)
    {
        $privateKey = config('tripay.private_key');
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $privateKey);

        if ($signature !== (string)$callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string)$request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $uniqueRef = $data->merchant_ref;
        $status = strtoupper((string)$data->status);

        if ($data->is_closed_payment === 1) {
            $invoice = Order::where('payment_reference', $uniqueRef)
                ->where('payment_status', '=', 'pending')
                ->first();


            if (!$invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $uniqueRef,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'paid']);
                    break;

                case 'FAILED':
                case 'EXPIRED':
                    $invoice->update(['status' => 'failed']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Unrecognized payment status #1',
        ]);
    }
}
