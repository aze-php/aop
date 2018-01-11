<?php
namespace AZE\aop\utils;

class ClassFinder
{
    private static $dir = __DIR__ . "/../../../../";

    public static function getClassesInNamespace($namespace)
    {
        $dir = self::getNamespaceDirectory($namespace);
        $files = self::getFilesInDirectory($dir, true);

        $files = array_map(function ($file) use ($dir) {return str_replace($dir . DIRECTORY_SEPARATOR, '', $file); }, $files);

        $classes = array_map(function ($file) use ($namespace){
            return $namespace . '\\' . str_replace('.php', '', $file);
        }, $files);

        return array_filter($classes, function ($possibleClass){
            return class_exists($possibleClass);
        });
    }

    public static function getDefinedNamespaces()
    {
        $composerJsonPath = self::$dir . 'composer.json';
        $composerConfig = json_decode(file_get_contents($composerJsonPath));

        //Apparently PHP doesn't like hyphens, so we use variable variables instead.
        $psr4 = "psr-4";
        return (array) $composerConfig->autoload->$psr4;
    }

    private static function getNamespaceDirectory($namespace)
    {
        $composerNamespaces = self::getDefinedNamespaces();

        $namespaceFragments = explode('\\', $namespace);
        $undefinedFragments = [];

        while($namespaceFragments) {
            $possibleNamespace = implode('\\', $namespaceFragments) . '\\';

            if(array_key_exists($possibleNamespace, $composerNamespaces)){
                return realpath(self::$dir . $composerNamespaces[$possibleNamespace] . '/' . implode('/', array_reverse($undefinedFragments)));
            }

            $undefinedFragments[] = array_pop($namespaceFragments);
        }

        return false;
    }

    private static function getFilesInDirectory($dir, $searchSubdirectory)
    {
        $files = array();
        $searchSubdirectory = $searchSubdirectory ?: false;
        if (is_dir($dir) && is_readable($dir)) {
            $files = array_map(function ($file) use ($dir) { return $dir . DIRECTORY_SEPARATOR . $file; }, scandir($dir));
            $files = array_filter($files, function ($file) { return basename($file) !== '.' && basename($file) !== '..'; });

            if ($searchSubdirectory) {
                foreach ($files as $file) {
                    if (is_dir($file) && is_readable($file)) {
                        $files = array_merge($files, self::getFilesInDirectory($file, true));
                    }
                }
            }
        }

        return $files;
    }
}