<?php

namespace BSPure\Components;

class Accordion extends BSBaseComponent
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
        parent::__construct('div');
        $this->class('accordion');
        $this->id($id);
    }

    public function flush(): self
    {
        return $this->class('accordion-flush');
    }

    public function ___(...$children): self
    {
        foreach ($children as $child) {
            $count = count($this->children) + 1;
            $header_id = "$this->id-item-$count-header";
            $collapse_id = "$this->id-item-$count-collapse";

            if ($child instanceof AccordionItem) {
                $child->header->id($header_id);

                $child->button
                    ->dataBS('target', "#$collapse_id")
                    ->aria('controls', $collapse_id);

                $child->collapse
                    ->id($collapse_id)
                    ->aria('labelledby', $header_id)
                    ->dataBS('parent', "#$this->id");
            };
            parent::___($child);
        }
        return $this;
    }
}
