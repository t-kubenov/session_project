<?php

namespace App\Session;
use Jenssegers\Agent\Agent;

class DatabaseSessionHandler extends \Illuminate\Session\DatabaseSessionHandler
{
    /**
     * {@inheritDoc}
     */
    public function write($sessionId, $data)
    {
        $user_id = (auth()->check()) ? auth()->user()->id : null;

        $agent = new Agent();
        $browser = $agent->browser();
        $browserVersion = $agent->version('browser');
        $device = $agent->device();
        $platform = $agent->platform();
        $deviceType = $agent->deviceType();


        if ($this->exists) {
            $this->getQuery()->where('id', $sessionId)->update([
                'payload' => base64_encode($data), 'last_activity' => time(),
            ]);
        } else {
            $this->getQuery()->insert([
                'id' => $sessionId, 'payload' => base64_encode($data), 'last_activity' => time(), 'user_id' => $user_id,
                'browser' => $browser, 'browserVersion' => $browserVersion, 'device' => $device, 'platform' => $platform,
                'deviceType' => $deviceType,
            ]);
        }

        $this->exists = true;
    }
}
