<?php

namespace BSPure\Blocks;

use BSPure\BSPure;
use BSPure\Components\BSBaseComponent;
use BSPure\Components\NavBar;
use Closure;
use Stringable;

class NavBlock extends NavBar
{

    public BSBaseComponent $brand;
    public BSBaseComponent $menu;

    public function __construct()
    {
        parent::__construct(true);
        $this(
            $this->brand = BSPure::navBarBrand()->href('/'),
            BSPure::navBarToggler('#nav-menu'),
            BSPure::navBarCollapse('nav-menu')(
                $this->menu = BSPure::navBarNav()
            )
        );
    }

    public function brand(Stringable|string|array|Closure|null $request): static
    {
        return $this->pureAccess('brand', $request);
    }

    public function menu(Stringable|string|array|Closure|null $request): static
    {
        return $this->pureAccess('menu', $request);
    }
}
