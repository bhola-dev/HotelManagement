<?php

namespace App\Jobs;

use App\Models\Room;
use App\Models\User;
use App\Models\RoomBooking;
use Illuminate\Bus\Queueable;
use App\Mail\BookRoomAdminMail;
use App\Mail\BookRoomGuestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class EmailQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $guestId = $this->details['guest_id'];
        $roomId = $this->details['room_id'];
        $guest = User::find($guestId);
        $roomBook = RoomBooking::with('room')->where('room_id', $roomId)->where('guest_id', $guestId)->where('status', 'Booked')->first();
        
        $admin = User::where('role_id', 1)->first();

        $guestEmail = new BookRoomGuestMail($guest, $roomBook);
        Mail::to($guest['email'])->send($guestEmail);

        $adminEmail = new BookRoomAdminMail($admin, $guest, $roomBook);
        Mail::to($admin['email'])->send($adminEmail);
    }
}
