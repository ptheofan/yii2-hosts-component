<?php
namespace common\components;

use common\components\hosts\Host;
use yii\base\Component;



/**
 * @property Host $portal
 * @property Host $admin
 * @property Host $ice The domain used by icecast to authenticate a user
 * @property Host $zen The domain where BARIX submits the heartbeats
 * @property Host $api The Platform API
 * @property Host $device The device where BARIX gets the configuration, playlists and mp3 from
 * @property Host $storage This is the public accessible storage
 * @property Host $internalStorageProxy This is where DJ will get the audio files from
 */
class Hosts extends Component
{
    /**
     * @var array
     */
    public $config;

    /**
     * @var Host[]
     */
    private array $hosts;

    /**
     * @param string $name
     * @return mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($name)
    {
        if (isset($this->hosts[$name])) {
            return $this->hosts[$name];
        }

        if (isset($this->config[$name])) {
            $this->config[$name]['name'] = $name;
            $this->hosts[$name] = new Host($this->config[$name]);
            return $this->hosts[$name];
        }

        return parent::__get($name);
    }
}
