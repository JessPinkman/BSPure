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

    public function ___(...$children): self
    {
        $this->content->___(...$children);
        return $this;
    }

    public function fade(): self
    {
        return $this->class('fade');
    }

    public function static(): self
    {
        return $this
            ->dataBS('backdrop', 'static')
            ->dataBS('keyboard', "false");
    }

    public function scrollable(): self
    {
        $this->dialog->class('modal-dialog-scrollable');
        return $this;
    }

    public function centered(): self
    {
        $this->dialog->class('modal-dialog-centered');
        return $this;
    }
}
