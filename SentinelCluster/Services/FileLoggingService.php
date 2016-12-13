<?php

namespace App\Clusters\SentinelCluster\Services;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Prophecy\Exception\Doubler\MethodNotFoundException;

class FileLoggingService
{
    /**
     * The Log channels.
     *
     * @var array
     */
    protected $channels = [];

    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    public function __construct()
    {
        $this->channels = config('sentinel.file_log_channels');
    }

    /**
     * Write to log based on the given channel and log level set
     *
     * @param string $channel
     * @param string $message
     * @param string $level
     */
    protected function writeLog( $channel, $message, $level = null )
    {
        if( !in_array($channel, array_keys($this->channels)) ){
            throw new \InvalidArgumentException('Invalid logging channel used.');
        }

        if( !isset($this->channels[$channel]['instance']) ){
            $this->channels[$channel]['instance'] = new Logger($channel);
            $this->channels[$channel]['instance']->pushHandler(
                (new FileLoggingHandlerService(
                    $channel,
                    storage_path() .'/'. $this->channels[$channel]['path'],
                    $this->channels[$channel]['level']
                ))->setFormatter(new LineFormatter(null, null, true, true))
            );
        }

        if ( !$level ) {
            $level = $this->channels[$channel]['default'];
        }

        $this->channels[$channel]['instance']->{$level}($message);
    }

    public function __call( $methodName, $params )
    {
        $message = reset($params);
        $levelFound = false;
        $channel = '';

        // Check if channel is used with level (e.g. infoLogin, errorPayments, debugRegistrations)
        foreach ( $this->levels as $level => $code ) {
            $levelLength = strlen($level);
            $calledLevel = substr($methodName, 0, $levelLength);

            if ( $calledLevel == $level ) {
                $levelFound = $level;
                $channel = strtolower(substr($methodName, $levelLength));
                break;
            }
        }

        // Check if channel is used without level (e.g. login, payments, registrations)
        if ( in_array($methodName, array_keys($this->channels)) ) {
            $levelFound = null;
            $channel = $methodName;
        }

        if ( $levelFound === false ) {
            throw new MethodNotFoundException('Invalid logging level used.', __CLASS__, $methodName);
        }

        $this->writeLog($channel, $message, $levelFound);
    }

}
