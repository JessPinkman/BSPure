<?php

namespace BSPure\Components;

use BSPure\BSPure;

class NavBar extends BSBaseComponent
{
    public BSBaseComponent $container;

    public function __construct(bool $fluid = true)
    {
        parent::__construct('nav');
        $this->class('navbar');
        parent::___(
            $this->container = BSPure::container($fluid ? 'fluid' : null)
        );
    }

    public function container($request): self
    {
        return $this->pureAccess('container', $request);
    }

    public function ___(...$children): self
    {
        $this->container->___(...$children);
        return $this;
    }

    public function expand(string $bp = 'md'): self
    {
        return $this->class("navbar-expand-$bp");
    }

    public function variant(string $color): self
    {
        return $this->class("navbar-$color");
    }
}
