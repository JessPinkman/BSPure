<?php

namespace BSPure\Components;

use BSPure\BSPure;

class Breadcrumb extends BSBaseComponent
{
    public BSBaseComponent $list;

    public function __construct()
    {
        parent::__construct('nav');
        $this->aria('label', 'breadcrumb');
        parent::___($this->list = BSPure::ol()->class('breadcrumb'));
    }

    public function divider(string $divider = '>'): static
    {
        return $this->styleBS('breadcrumb-divider', $divider);
    }

    public function ___(...$children): static
    {
        $this->list->___(...$children);
        return $this;
    }
}
