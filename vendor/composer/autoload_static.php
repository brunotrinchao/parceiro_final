<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1cf4fc993e3fd96f8ce37e2b0fdc7921
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Curl\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Curl\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-curl-class/php-curl-class/src/Curl',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1cf4fc993e3fd96f8ce37e2b0fdc7921::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1cf4fc993e3fd96f8ce37e2b0fdc7921::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
