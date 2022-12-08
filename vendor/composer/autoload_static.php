<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfc5960d16cf0e636e956f932c588d7b4
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfc5960d16cf0e636e956f932c588d7b4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfc5960d16cf0e636e956f932c588d7b4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfc5960d16cf0e636e956f932c588d7b4::$classMap;

        }, null, ClassLoader::class);
    }
}
