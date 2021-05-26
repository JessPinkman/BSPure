<?php

namespace BSPure\Components;

use BSPure\BSPure;

class Spinner extends BSBaseComponent
{
    public function __construct(bool $border)
    {
        parent::__construct('div');
        $this
            ->class($border ? 'spinner-border' : 'spinner-grow')
            ->role('status')
            ->___(
                BSPure::span()->visuallyHidden()('loading...')
            );
    }

    public function color(string $color): static
    {
        return $this->class("text-$color");
    }
}
