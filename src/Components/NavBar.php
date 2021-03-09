<?php

namespace BSPure\Components;

class NavBar extends BSBaseComponent
{
    public BSBaseComponent $container;
    public BSBaseComponent $toggle;

    public function __construct(bool $fluid = true)
    {
        parent::__construct('nav');
        $this->class('navbar');
        parent::___(
            $this->container = BSLayout::container($fluid ? 'fluid' : null)
        );
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

    public function navStyle(string $color): self
    {
        return $this->class("navbar-$color");
    }
}
