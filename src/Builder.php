<?php

namespace WpFreak\EasyPostTypes;

use WpFreak\EasyPostTypes\CustomPostType;
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
            $postType = new CustomPostType($postName, $args, $labels);
            if(isset($arr['taxonomies'])):
                foreach($arr['taxonomies'] as $taxonomyName => $arr):
                    $args = isset($arr['args']) ? $arr['args'] : [];
                    $labels = isset($arr['labels']) ? $arr['labels'] : [];
                    $postType->add_taxonomy( $taxonomyName, $args, $labels );
                endforeach;
            endif;
        endforeach;

    }

}