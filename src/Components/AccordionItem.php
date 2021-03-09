<?php

namespace BSPure\Components;

use Closure;

class AccordionItem extends BSBaseComponent
{
    public BSBaseComponent $header;
    public BSBaseComponent $button;

    public BSBaseComponent $collapse;
    public BSBaseComponent $body;

    public static string $header_tag = 'h2';

    public function __construct(bool $show = false)
    {
        parent::__construct('div');

        $this->class('accordion-item');
        parent::___(
            $this->header = BSPure::{static::$header_tag}()
                ->class('accordion-header')
                ->___(
                    $this->button = BSComponent::button()
                        ->class(false, $show ? 'accordion-button' : 'accordion-button collapsed')
                        ->dataBS('toggle', 'collapse')
                        ->aria('expanded', $show ? 'true' : 'false')
                ),
            $this->collapse = BSPure::div()
                ->class($show ? 'accordion-collapse collapse show' : 'accordion-collapse collapse')
                ->___(
                    $this->body = BSPure::div()
                        ->class('accordion-body')
                )
        );
    }

    public function button($request): self
    {
        return $this->pureAccess('button', $request);
    }

    public function body($request): self
    {
        return $this->pureAccess('body', $request);
    }
}
