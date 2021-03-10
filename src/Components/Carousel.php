<?php

namespace BSPure\Components;

use BSPure\BSPure;

class Carousel extends BSBaseComponent
{

    public BSBaseComponent $inner;
    protected bool $controls = false;
    protected bool $indicators = false;
    public string $id;
    private $active = 1;

    public function __construct(string $id)
    {
        parent::__construct('div');
        $this
            ->id($this->id = $id)
            ->class('carousel slide')
            ->dataBS('ride', 'carousel');

        parent::___($this->inner = BSPure::div()->class('carousel-inner'));
    }

    public function ___(...$children): self
    {
        foreach ($children as $child) {
            $this->inner->___(
                BSPure::div()
                    ->class('carousel-item')
                    ->___($child)
            );
        }

        return $this;
    }

    public function setActive(int $index): self
    {
        $this->active = $index;
        return $this;
    }

    public function withControls(bool $activate): self
    {
        $this->controls = $activate;
        return $this;
    }

    public function withIndicators(bool $activate): self
    {
        $this->indicators = $activate;
        return $this;
    }

    public function __toString(): string
    {
        $this->inner->children[$this->active - 1]->active(true, false);

        if ($this->indicators) {
            array_unshift($this->children, $this->getIndicators($this->active));
        }

        if ($this->controls) {
            parent::___(
                $this->getControl(true),
                $this->getControl(false)
            );
        }
        return parent::__toString();
    }

    protected function getControl(bool $previous): BSBaseComponent
    {
        return BSPure::a()
            ->class($previous ? 'carousel-control-prev' : 'carousel-control-next')
            ->href("#$this->id")
            ->role('button')
            ->dataBS('slide', $previous ? 'prev' : 'next')
            ->___(
                BSPure::span()
                    ->class($previous ? 'carousel-control-prev-icon' : 'carousel-control-next-icon'),
                BSPure::span()
                    ->visuallyHidden()
                    ->___($previous ? 'Previous' : 'Next'),
            );
    }

    protected function getIndicators(int $active): BSBaseComponent
    {
        $list = BSPure::ol()->class('carousel-indicators');
        $count = count($this->inner->children);
        for ($i = 0; $i < $count; $i++) {
            $list->___(
                BSPure::li()
                    ->dataBS('target', "#$this->id")
                    ->dataBS('slide-to', $i)
                    ->class($i === $active ? 'active' : false)
            );
        }
        return $list;
    }

    public function isFade(): self
    {
        return $this->class('carousel-fade');
    }

    public function isDark(): self
    {
        return $this->class('carousel-dark');
    }
}
