<?php

namespace App\Jobs;

use App\Exceptions\OrderCreationFailedException;
use App\Models\Order;

class OrderJob extends Job
{
    public array $order;

    public function __construct(array $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        $order = Order::create($this->order);

        if (!$order) {
            $this->fail(new OrderCreationFailedException());
        }

        dispatch(new VoucherJob([
            'order' => $this->order
        ]));
    }
}
