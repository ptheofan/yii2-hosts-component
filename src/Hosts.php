<?php
namespace ptheofan\components;

use yii\base\Component;

/**
 * For autocomplete you should add here the hosts configured in your app configuration
 * @example
 *  @ property Host $storage
 *  (without the space between @ and property)
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
