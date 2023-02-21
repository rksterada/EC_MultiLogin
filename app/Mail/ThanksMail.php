<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThanksMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    public $user;

    public function __construct($products, $user)
    {
        // ブレード側で使用可能にする
        $this->products = $products;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.thanks') //本文
        ->subject('ご購入ありがとうございます。'); //タイトル
    }
}
