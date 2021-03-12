<?php

namespace BSPure\Components;

use BSPure\BSPure;

class Dropdown extends BSBaseComponent
{
    public BSBaseComponent $list;
    public BSBaseComponent $button;

    public function __construct(string $label, string $button_id, string $variant = 'primary')
    {
        parent::__construct('div');
        $this
            ->class('dropdown')
            ->___(
                $this->button = BSPure::button($variant)
                    ->id($button_id)
                    ->dataBS('toggle', 'dropdown')
                    ->aria('expanded', 'false')
                    ->___($label),
                $this->list = BSPure::ul()
                    ->class('dropdown-menu')
                    ->aria('labelledby', $button_id)
            );
    }

    public function addItem(string $label, string $href, bool $active = false, bool $disabled = false): self
    {
        $this->list->___(
            BSPure::li()(
                BSPure::a()
                    ->class('dropdown-item')
                    ->href($href)
                    ->active($active)
                    ->disabled($disabled)
                    ->___($label)
            )
        );

        return $this;
    }

    public function addDivider(): self
    {
        $this->list->___(
            BSPure::li()(BSPure::hr()->class('dropdown-divider'))
        );

        return $this;
    }
}
