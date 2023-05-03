<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DeleteExpiredReservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $reservations = Reservation::whereNotNull('course_id')
        ->whereNull('paid_at')
        ->where('created_at', '<=', Carbon::now()->subMinutes(30))
        ->get();

        foreach ($reservations as $reservation) {
            $reservation->delete();
        }

        $this->info('Expired reservations deleted successfully.');
    }
}
