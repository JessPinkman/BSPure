<?php

namespace BSPure\Components;

use BSPure\BSPure;

class BreadcrumbItem extends BSBaseComponent
{

    public ?BSBaseComponent $link = null;

    public function __construct(?string $href = null)
    {
        parent::__construct('li');
        $this
            ->class('breadcrumb-item')
            ->isActive((bool) $href, 'page');
        if ($href) {
            parent::___(
                $this->link = BSPure::a()->href($href)
            );
        }
    }

    public function ___(...$children): self
    {
        if ($this->link) {
            $this->pureAccess('link', ...$children);
        } else {
            parent::___(...$children);
        }
        return $this;
    }
}
