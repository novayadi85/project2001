<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitccd525825fb8c3f2c655c9949b5c6d98
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SqlFire' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitccd525825fb8c3f2c655c9949b5c6d98::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
