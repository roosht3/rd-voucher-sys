<?php

namespace App\Jobs;

class OrderJob extends Job
{
    public array $order;

    public function __construct(array $order)
    {
        $this->onQueue('orders');
        $this->order = $order;
    }
}
