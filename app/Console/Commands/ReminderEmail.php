<?php

namespace App\Console\Commands;

// use App\Mail\ReminderEmail as MailReminderEmail;

use App\Mail\ReminderEmail as MailReminderEmail;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');
        $reservations = Reservation::whereDate(DB::raw('Date(start_at)'), $today)->get();
        $users = collect([]);
        foreach ($reservations as $reservation) {
            $users->push($reservation->user);
        };
        foreach ($users as $user) {
            Mail::to($user)->send(new MailReminderEmail);
        };
        $this->info('Reminder email sent successfully.'); // コマンド実行時に表示するメッセージ
    }
}