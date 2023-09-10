<?php

if(!function_exists('rupiah')) {
    function rupiah($v): string
    {
        return "Rp " . number_format($v,2,',','.');
    }
}

if(!function_exists('request_transaction')) {
    function request_transaction(\App\Http\Requests\RequestTransactionTripayRequest $request): bool|array
    {
        $validated = $request->validated();
        $merchantRef = uniqid() . time();
        $data = [
            'method' => "QRIS", //TODO: make this method dynamic
            'merchant_ref' => $merchantRef,
            'amount' => $request['amount'],
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'order_items' => [
                [
                    'name' => 'Deposit Saldo',
                    'price' => $request['amount'],
                    'quantity' => 1,
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $request['amount'], $privateKey)
        ];


        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => "https://tripay.co.id/api/open-payment/create",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$validated['api_key']],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        return empty($error) ? $response : $error;
    }
}
