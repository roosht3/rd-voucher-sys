<?php

namespace App\Http\Controllers;

use App\Jobs\OrderJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/'
        ]);

        $order = $request->only([
            'email',
            'amount',
        ]);

        dispatch(new OrderJob($order));

        return response()->json($order, 200);
    }
}
