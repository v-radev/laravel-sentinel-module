<?php

namespace App\Clusters\SentinelCluster\Commands;

use App\Clusters\SentinelCluster\Models\UserLoginLog;
use Illuminate\Console\Command;

class CleanUserLoginLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:loginlogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean the user login logs older than 30 days.';


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

        $affectedRows = UserLoginLog::where('updated_at', '<=', $formattedDate)->delete();

        $this->info('Successfully deleted ' . $affectedRows . ' user login logs.');
    }
}
