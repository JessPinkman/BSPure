<?php

namespace BSPure\Components;

/*
       XS           SM             MD            LG              XL             XXL
--------------+-------------+-------------+--------------+----------------+--------------
              >576          >768          >992           >1200            >1400
*/

class BSLayout extends BSPure
{

    public static function container(?string $modifier = null): BSBaseComponent
    {
        return self::div()->class($modifier ? "container-$modifier" : 'container');
    }

    public static function col(...$variants): BSBaseComponent
    {
        $col = self::div();

        !$variants && $col->class('col');

        foreach ($variants as $variant) {
            $col->class("col-$variant");
        }

        return $col;
    }

    public static function row(): BSBaseComponent
    {
        return self::div()->class('row');
    }

    public static function media(): BSBaseComponent
    {
        return self::div()->class('media');
    }

    public static function mediaBody(): BSBaseComponent
    {
        return self::div()->class('media-body');
    }
}
