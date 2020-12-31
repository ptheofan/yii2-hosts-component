Easily manage your domains and subdomains across multiple environments

In your config (example `/common/main-local.php`)
```php
'components' => [
    'host' => [
        'class' => \ptheofan\components\Hosts::class,
        'config' => [
            'storage' => [
                'http' => false, // set to false by default
                'https' => true, // this is by default set to true
                'hostname' => 'storage.example.com', // the domain of interest
            ],
        ],
    ],
],
```

Then you can access the following
```php
echo Yii::$app->host->storage->url();
// will return https://storage.example.com/

echo Yii::$app->host->storage->url('/avatars');
// will return https://storage.example.com/avatars

echo Yii::$app->host->storage->url('/avatars/avatar.png');
// will return https://storage.example.com/avatars/avatar.png
```

To support autocomplete you have two options
1. Extend the Hosts class with your own component and add @property annotations
1. Create a mock file and mark the original file as text-only (if your IDE supports it). Then add the @property annotations you want to the class.

Here's a simple example of the first method
```php
// @file /common/components/Hosts.php
/**
 * @property Host $storage
 */
class Hosts extends \ptheofan\components\Hosts
{

}

// @file /common/config/main-local.php
'components' => [
    'host' => [
        'class' => \common\components\Hosts::class,
        'config' => [
            'storage' => [
                'http' => false, // set to false by default
                'https' => true, // this is by default set to true
                'hostname' => 'storage.example.com', // the domain of interest
            ],
        ],
    ],
],

// if you have properly configured the stubs for autocomplete then you should get autocomplete when you write
Yii::$app->host-> // (autocomplete here all the Hosts annnotated @properties)
```