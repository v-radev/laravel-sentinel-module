<?php

namespace App\Clusters\SentinelCluster\Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FileLoggingHandlerService extends StreamHandler
{
    /**
     * Channel name
     *
     * @var String
     */
    protected $channel;

    /**
     * @param string          $channel
     * @param resource|string $stream
     * @param bool|int        $level
     * @param bool            $bubble
     *
     * @see parent __construct for params
     */
    public function __construct( $channel, $stream, $level = Logger::DEBUG, $bubble = true )
    {
        $this->channel = $channel;

        parent::__construct($stream, $level, $bubble);
    }

    /**
     * When to handle the log record.
     *
     * @param array $record
     * @return bool
     */
    public function isHandling( array $record )
    {
        if( isset($record['channel']) ){
            return (
                $record['level'] >= $this->level &&
                $record['channel'] == $this->channel
            );
        }

        return $record['level'] >= $this->level;
    }

}
