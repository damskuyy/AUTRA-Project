<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SensorReading;

class GenerateHourlyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:hourly {--from=} {--to=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate hourly sensor summary report when PLC is online';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $from = $this->option('from');
        $to = $this->option('to');

        $this->info('Checking PLC status and collecting last hour data...');

        $result = SensorReading::generateHourlySummary($from, $to);

        if (! $result) {
            $this->info('No report created: PLC offline or no data in the period.');
            return 0;
        }

        $this->info('Report generated at: ' . $result->received_at->toDateTimeString());

        // If condition is Danger, create a notification (redundant checks are safe)
        try {
            if (class_exists(\App\Models\Notification::class) && ($result->condition ?? null) === 'Danger') {
                \App\Models\Notification::create([
                    'title' => 'Danger detected in hourly summary',
                    'message' => 'An hourly summary has condition Danger. Check the Laporan page for details.',
                    'type' => 'danger',
                    'is_read' => false,
                ]);
            }
        } catch (\Exception $e) {
            // ignore notification errors
        }

        return 0;
    }
}
