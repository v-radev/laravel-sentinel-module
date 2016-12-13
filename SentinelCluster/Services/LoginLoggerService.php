<?php

namespace App\Clusters\SentinelCluster\Services;

use App\Clusters\SentinelCluster\Models\UserLoginLog;
use Illuminate\Foundation\Auth\User;

class LoginLoggerService extends LogServiceAbstract
{

    private $userData = [];


    public static function login( User $user )
    {
        $self = new static;

        $self->setUserData($user, 'login');

        return $self;
    }

    public static function logout( User $user )
    {
        $self = new static;

        $self->setUserData($user, 'logout');

        return $self;
    }

    private function setUserData( User $user, $type )
    {
        $this->userData = [
            'ip'         => $this->getIP(),
            'type'       => $type,
            'user_id'    => $user->id,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ];
    }

    public function log()
    {
        $serviceEnabled = config('sentinel.login_logging_enabled');

        if ( !$serviceEnabled ) {
            return null;
        }

        return UserLoginLog::create( $this->userData );
    }
}
