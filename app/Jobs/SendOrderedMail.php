<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// メール用
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderedMail;

class SendOrderedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product;
    public $user;

    public function __construct($product, $user)
    {
        //  handle側で使えるようにする
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // メール送信
        Mail::to($this->product['email']) //受信者の指定 
            ->send(new OrderedMail($this->product, $this->user)); //Mailableクラス
    }
}
