<?php

namespace App\Clusters\SentinelCluster\Commands;

use App\Clusters\SentinelCluster\Models\UserLoginLog;
use App\Clusters\SentinelCluster\Models\UserRouteLog;
use Illuminate\Console\Command;

class CleanVisitedRouteLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:routelogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean the visited route logs older than 30 days.';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = new \DateTime;
        $date->modify('-30 days');
        $formattedDate = $date->format('Y-m-d H:i:s');

        $affectedRows = UserRouteLog::where('updated_at', '<=', $formattedDate)->delete();

        $this->info('Successfully deleted ' . $affectedRows . ' visited route logs.');
    }
}
