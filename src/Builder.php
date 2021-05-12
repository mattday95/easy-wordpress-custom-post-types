<?php

namespace WpFreak\EasyPostTypes;

use CustomPostType;
use Symfony\Component\Yaml\Yaml;

class Builder {

    public static function init( string $pathToYml )
    {

        if (!file_exists( $pathToYml )):
            return;
        endif;

        $posts = Yaml::parseFile($pathToYml)['posts'];

        foreach( $posts as $postName => $arr):
            $postName = ucfirst($postName);
            $args = isset($arr['args']) ? $arr['args'] : [];
            $labels = isset($arr['labels']) ? $arr['labels'] : [];
            new CustomPostType($postName, $args, $labels);
        endforeach;

    }

}