<?php


namespace App\Channels;


use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SmsChannel
{

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        $mobile = $notifiable->phone;

        //todo: insert send sms code here
        Log::info($mobile);
    }
}
