<?php

namespace App\Jobs;

use App\Exceptions\VoucherCreationFailedException;
use App\Models\Voucher;
use Carbon\Carbon;
use Coupon;
use Illuminate\Support\Facades\Mail;
use QoreWorks\Qore\Mail\VoucherCreated;


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

    public function handle(): void
    {
        $order = $this->voucher['order'];
        if ($order['amount'] > 100) {
            $voucher = Voucher::create([
                'email' => $order['email'],
                'code' => Coupon::generate(),
                'expiry' => Carbon::now()->addDays(config('voucher.expiry')),
                'value' => ($order['amount'] * config('voucher.value_percentage')) / 100,
            ]);

            if (!$voucher) {
                $this->fail(new VoucherCreationFailedException());
            }

            Mail::to($voucher->email)->send(new VoucherCreated($voucher));
        }

    }
}
