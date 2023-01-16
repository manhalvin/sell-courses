<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\API\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $inputData;
    protected $userData;

    public function __construct($inputData, $userData)
    {
        $this->inputData = $inputData;
        $this->userData = $userData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->inputData['email'])->send(new RegisterMail($this->userData));
        // php artisan make:event CreateUserEvent
        // php artisan make:listener CreateUserListener --event="CreateUserEvent"
        // php artisan event:generate
    }
}
