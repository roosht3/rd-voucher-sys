<?php

declare(strict_types=1);

namespace QoreWorks\Qore\Mail;

use App\Models\Voucher;
use Illuminate\Mail\Mailable;

class VoucherCreated extends Mailable {

    private Voucher $vocher;

    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function build()
    {
        return $this
            ->subject('Hooray, You won a gift card for our recent purchase')
            ->view('emails.voucher', [
                'code' => $this->voucher->code
            ]);
    }
}
