<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Fine;
use App\FineStatus;

class SyncFineStatuses extends Command
{
    protected $signature = 'sync:fine-statuses';
    protected $description = 'Sync existing fines with fine statuses';

    public function handle()
    {
        $fines = Fine::all();
    
        foreach ($fines as $fine) {
            FineStatus::updateOrCreate(
                ['student_matricNumber' => $fine->student_matricNum],
                [
                    'fine_details' => json_encode([$fine->comment]),
                    'fine_date' => $fine->fine_date,
                    'fine_time' => $fine->fine_time,
                    'fine_status' => 'Active',
                    'kesalahan' => json_encode($fine->kesalahan), // Sync 'kesalahan'
                ]
            );
        }
    
        $this->info('Fine statuses synced successfully.');
    }
}
