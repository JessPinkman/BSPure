<?php

namespace BSPure\Components;

use BSPure\BSPure;

class PageItem extends BSBaseComponent
{
    public ?BSBaseComponent $link = null;

    public function __construct(?string $href = null)
    {
        parent::__construct('li');
        $this->class('page-item');
        parent::___($this->link = BSPure::a()->class('page-link')->href($href));
    }

    public function ___(...$children): self
    {
        $this->link->___(...$children);
        return $this;
    }
}
