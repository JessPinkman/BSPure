<?php

namespace BSPure\Components;

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

    public function color(string $color): self
    {
        return $this->class("text-$color");
    }
}
