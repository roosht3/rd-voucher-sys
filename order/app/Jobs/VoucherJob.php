<?php

namespace App\Jobs;

class VoucherJob extends Job
{
    public array $voucher;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $voucher)
    {
        $this->onQueue('vouchers');
        $this->voucher = $voucher;
    }
}
