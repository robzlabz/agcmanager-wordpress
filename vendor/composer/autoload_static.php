<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitccaa43cd93b7dd011482dff7a5f2dba2
{
    public static $files = array (
        '8a5319651390109aa9b2681698590a30' => __DIR__ . '/../..' . '/agc/Helper/Helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Agc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Agc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/agc',
        ),
    );

    public static $classMap = array (
        'Agc\\Application' => __DIR__ . '/../..' . '/agc/Application.php',
        'Agc\\Controller\\AttachmentController' => __DIR__ . '/../..' . '/agc/Controller/AttachmentController.php',
        'Agc\\Controller\\DashboardController' => __DIR__ . '/../..' . '/agc/Controller/DashboardController.php',
        'Agc\\Controller\\PostController' => __DIR__ . '/../..' . '/agc/Controller/PostController.php',
        'Agc\\Controller\\VerifyController' => __DIR__ . '/../..' . '/agc/Controller/VerifyController.php',
        'Agc\\Http\\Request' => __DIR__ . '/../..' . '/agc/Http/Request.php',
        'Agc\\Http\\Response' => __DIR__ . '/../..' . '/agc/Http/Response.php',
        'Agc\\Repositories\\AttachmentRepository' => __DIR__ . '/../..' . '/agc/Repositories/AttachmentRepository.php',
        'Agc\\Repositories\\HttpRepository' => __DIR__ . '/../..' . '/agc/Repositories/HttpRepository.php',
        'Agc\\Repositories\\LogRepository' => __DIR__ . '/../..' . '/agc/Repositories/LogRepository.php',
        'Agc\\Repositories\\PostRepository' => __DIR__ . '/../..' . '/agc/Repositories/PostRepository.php',
        'Agc\\Repositories\\RouteRepository' => __DIR__ . '/../..' . '/agc/Repositories/RouteRepository.php',
        'Agc\\Repositories\\TokenRepository' => __DIR__ . '/../..' . '/agc/Repositories/TokenRepository.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitccaa43cd93b7dd011482dff7a5f2dba2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitccaa43cd93b7dd011482dff7a5f2dba2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitccaa43cd93b7dd011482dff7a5f2dba2::$classMap;

        }, null, ClassLoader::class);
    }
}
