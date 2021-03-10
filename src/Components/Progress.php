<?php

namespace BSPure\Components;

use BSPure\BSPure;

class Progress extends BSBaseComponent
{

    public BSBaseComponent $bar;

    public function __construct(int $value, int $min, int $max)
    {
        $percentage = (int) ($value * 100 / ($max - $min));
        parent::__construct('div');
        $this->class('progress')(
            $this->bar = BSPure::div()
                ->class('progress-bar')
                ->role('progressbar')
                ->style("width: {$percentage}%")
                ->aria('valuenow', $value)
                ->aria('valuemin', $min)
                ->aria('valuemax', $max)
        );
    }

    public function color(string $color): self
    {
        $this->bar->bg($color);
        return $this;
    }

    public function isStriped(bool $animated = false): self
    {
        $this->bar->class($animated ? 'progress-bar-striped progress-bar-animated' : 'progress-bar-striped');
        return $this;
    }
}
