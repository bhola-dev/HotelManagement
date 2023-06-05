<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\DailyMail;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:send-daily-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (date('H:i') == '06:30') {
            $users = User::all();
    
            if ($users->count() > 0) {
                foreach ($users as $user) {
                    Mail::to($user)->send(new DailyMail($user));
                }
            }
        }
  
        return 0;
    }
}
