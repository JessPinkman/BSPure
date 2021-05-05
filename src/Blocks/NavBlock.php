<?php

namespace BSPure\Blocks;

use BSPure\BSPure;
use BSPure\Components\BSBaseComponent;
use BSPure\Components\NavBar;

class NavBlock extends NavBar
{

    public BSBaseComponent $brand;
    public BSBaseComponent $menu;

    public function __construct()
    {
        parent::__construct(true);
        $this->variant('dark')
            ->expand('md')
            ->bg('dark')
            ->shadow('sm')
            ->sticky()
            ->___(
                $this->brand = BSPure::navBarBrand()->href('/'),
                BSPure::navBarToggler('#nav-menu'),
                BSPure::navBarCollapse('nav-menu')(
                    $this->menu = BSPure::navBarNav()
                        ->m(null, 'lg-5', null, 'auto')
                )
            );
    }
}
