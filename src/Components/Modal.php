<?php

namespace BSPure\Components;

use BSPure\BSPure;

class Modal extends BSBaseComponent
{
    public BSBaseComponent $dialog;
    public BSBaseComponent $content;

    public function __construct(string $id)
    {
        parent::__construct('div');
        $this
            ->class('modal')
            ->id($id)
            ->tabindex('-1');

        parent::___(
            $this->dialog = BSPure::div()->class('modal-dialog')(
                $this->content = BSPure::div()->class('modal-content')
            )
        );
    }

    public function ___(...$children): static
    {
        $this->content->___(...$children);
        return $this;
    }

    public function fade(): static
    {
        return $this->class('fade');
    }

    public function static(): static
    {
        return $this
            ->dataBS('backdrop', 'static')
            ->dataBS('keyboard', "false");
    }

    public function scrollable(): static
    {
        $this->dialog->class('modal-dialog-scrollable');
        return $this;
    }

    public function centered(): static
    {
        $this->dialog->class('modal-dialog-centered');
        return $this;
    }
}
