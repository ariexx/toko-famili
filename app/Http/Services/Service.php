<?php

namespace App\Http\Services;

class Service
{
    const OK = true;
    const FAIL = false;

    public function successResponse(): object
    {
        return response()->json(['success' => true]);
    }

    public function failResponse(): object
    {
        return response()->json(['success' => false], 500);
    }
}
