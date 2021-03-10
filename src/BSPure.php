<?php

namespace BSPure;

use BSPure\Components\BSBaseComponent;
use BSPure\Components\Loader;
use Pure\Fragment;
use Pure\Pure;

/**
 * @method static BSBaseComponent div
 * @method static BSBaseComponent p
 * @method static BSBaseComponent a
 * @method static BSBaseComponent span
 * @method static BSBaseComponent ul
 * @method static BSBaseComponent ol
 * @method static BSBaseComponent li
 * @method static BSBaseComponent h1
 * @method static BSBaseComponent h2
 * @method static BSBaseComponent h3
 * @method static BSBaseComponent h4
 * @method static BSBaseComponent h5
 * @method static BSBaseComponent h6
 * @method static BSBaseComponent head
 * @method static BSBaseComponent title
 * @method static BSBaseComponent meta
 * @method static BSBaseComponent body
 */
class BSPure extends Pure
{

    public static function __callStatic(string $tag, array $children): BSBaseComponent
    {
        $component = new BSBaseComponent($tag);
        if (count($children)) {
            $component->___($children);
        }
        return $component;
    }

    public static function img(bool $fluid = false, bool $thumbnail = false): BSBaseComponent
    {
        $img = (new BSBaseComponent('img'));
        $fluid && $img->class('img-fluid');
        $thumbnail && $img->class('img-thumbnail');

        return $img;
    }

    public function table(string ...$modifiers): BSBaseComponent
    {
        $table = (new BSBaseComponent('table'));

        $table->class('table');

        foreach ($modifiers as $prop) {
            $table->class("table-$prop");
        }

        return $table;
    }

    public static function loader(): Loader
    {
        return new Loader;
    }

    public function head(): BSBaseComponent
    {
        return (new BSBaseComponent('head'))(self::requiredMeta());
    }

    public static function requiredMeta(): Fragment
    {
        return new Fragment(
            self::meta()->charset('utf-8'),
            self::meta()->name('viewport')->content('width=device-width, initial-scale=1, shrink-to-fit=no'),
        );
    }
}
