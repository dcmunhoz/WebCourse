<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc945116bc2db1e95494516f028ef10c
{
    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rain' => 
            array (
                0 => __DIR__ . '/..' . '/rain/raintpl/library',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitdc945116bc2db1e95494516f028ef10c::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}