<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $collectionReq = collect($request->all());
        $collectionReq->forget('_token');
        $totalProductUuid = count($collectionReq->get("product_uuid"));
        if ($totalProductUuid > 0) {
            for ($i = 0; $i < $totalProductUuid; $i++) {
                $dataToInsert[] = [
                    'product_uuid' => $collectionReq->get("product_uuid")[$i],
                    'quantity' => $collectionReq->get("quantity")[$i],
                    'total' => $collectionReq->get("total")[$i],
                ];
            }
        }
        try{
            \DB::transaction(function () use ($dataToInsert, $request) {
                //create order
                $createOrder = Order::create([
                    'invoice_id' => 'INV-'.time(),
                    'payment_reference' => 'REF-'.time(),
                    'user_uuid' => auth()->id(),
                    'detail_address' => \Auth::user()->userDetail->street_detail ?? "Jalan Ar Hakim",
                    'description' => \Auth::user()->userDetail->street_detail ?? "Jalan Ar Hakim",
                    'status' => 'pending',
                    'payment_status' => 'pending',
                ]);

                //create order detail
                $createOrder->orderDetails()->createMany($dataToInsert);

                //delete cart
                \DB::table('carts')->where('user_uuid', auth()->id())->delete();

                //update product stock
                $totalProductUuid = count($dataToInsert);
                if ($totalProductUuid > 0) {
                    for ($i = 0; $i < $totalProductUuid; $i++) {
                        \DB::table('products')->where('uuid', $dataToInsert[$i]['product_uuid'])->decrement('quantity', $dataToInsert[$i]['quantity']);
                    }
                }
            });

            //sum total from $dataToInsert
            $total = collect($dataToInsert)->sum('total');
            $dataToInsert['amount'] = $total;
            $reqTrx = $this->createTrxToTripay($dataToInsert);
            $resTrx = json_decode($reqTrx, true);
            if ($resTrx['success']) {
                //get payment url
                $paymentUrl = $resTrx['data']['checkout_url'];
                return redirect()->away($paymentUrl);
            }else{
                return redirect()->back()->withInput()->withErrors($resTrx['message']);
            }
            //redirect to midtrans
        }catch(\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    private function createTrxToTripay(array $data): array|string|bool {
        $merchantCode = app('config')->get('tripay.merchant_code');
        $merchantRef = 'INV-'.time();
        $privateKey = app('config')->get('tripay.private_key');
        $apiKey = app('config')->get('tripay.api_key');

        $data['method'] = 'QRIS';
        $data['merchant_ref'] = $merchantRef;
        $data['customer_name'] = auth()->user()->name;
        $data['customer_email'] = auth()->user()->email;
        $data['expired_time'] = (time() + (24 * 60 * 60)); // 24 jam
        $data['signature'] = hash_hmac('sha256', $merchantCode . $merchantRef . $data['amount'], $privateKey);
        $data['order_items'] = [
            [
                'name' => 'Pembayaran Produk',
                'price' => $data['amount'],
                'quantity' => 1,

            ]
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        return empty($error) ? $response : $error;
    }
}
