<?php

namespace BSPure\Components;

class Breadcrumb extends BSBaseComponent
{
    public BSBaseComponent $list;

    public function __construct()
    {
        parent::__construct('nav');
        $this->aria('label', 'breadcrumb');
        parent::___($this->list = BSPure::ol()->class('breadcrumb'));
    }

    public function divider(string $divider = '>'): self
    {
        return $this->styleBS('breadcrumb-divider', $divider);
    }

    public function ___(...$children): self
    {
        $this->list->___(...$children);
        return $this;
    }
}
