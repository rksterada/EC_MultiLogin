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
use App\Mail\ThanksMail;

class SendThanksMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // インスタンス
    public $products;
    public $user;

    public function __construct($products, $user)
    {
        //
        $this->products = $products;
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
        Mail::to($this->user) //受信者の指定 
            ->send(new ThanksMail($this->products, $this->user)); //Mailableクラス
    }
}
