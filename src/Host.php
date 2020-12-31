<?php
namespace common\components\hosts;

use yii\base\BaseObject;

class Host extends BaseObject
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var bool
     */
    public bool $http = false;

    /**
     * @var bool
     */
    public bool $https = true;

    /**
     * @var string
     */
    public string $hostname;

    /**
     *
     */
    public function init(): void
    {
        if (empty($this->name)) {
            throw new \RuntimeException('Name is required');
        }

        if (empty($this->hostname)) {
            throw new \RuntimeException('Host is required');
        }
    }

    /**
     * @return string
     */
    public function host(): string
    {
        return $this->hostname;
    }

    /**
     * @param string|null $path
     * @param string|null $scheme
     * @return string
     */
    public function url(?string $path = null, ?string $scheme = null): string
    {
        if ($scheme === null) {
            $scheme = $this->https ? 'https' : 'http';
        }
        return sprintf('%s://%s%s', $scheme, $this->hostname, $path);
    }
}
