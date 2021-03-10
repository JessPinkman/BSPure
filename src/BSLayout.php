<?php

namespace BSPure;

use BSPure\Components\BSBaseComponent;
use Error;
use Pure\Component;

/*
       XS           SM             MD            LG              XL             XXL
--------------+-------------+-------------+--------------+----------------+--------------
              >576          >768          >992           >1200            >1400
*/

/**
 * Factory for { container, row, col}
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
}
