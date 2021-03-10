<?php

namespace BSPure\Components;

class Card extends BSBaseComponent
{
    public ?BSBaseComponent $header = null;
    public ?BSBaseComponent $body = null;
    public ?BSBaseComponent $title = null;

    public function __construct(?string $card_subclass = null, string $tag = 'div')
    {
        parent::__construct($tag);
        $this->class($card_subclass ? "card-$card_subclass" : 'card');
    }

    public function header($request): self
    {

        if (!$this->header) {
            $this->___($this->header = new Card('header', 'h5'));
        }


        $this->pureAccess('header', $request);

        return $this;
    }

    public function body($request): self
    {

        if (!$this->body) {
            $this->___($this->body = new Card('body', 'div'));
        }

        $this->pureAccess('body', $request);

        return $this;
    }

    public function title($request): self
    {

        if (!$this->title) {
            $this->___($this->title = new Card('title', 'h6'));
        }

        $this->pureAccess('title', $request);

        return $this;
    }

    public function text($request): self
    {

        if (!$this->text) {
            $this->___($this->text = new Card('text', 'p'));
        }

        $this->pureAccess('text', $request);

        return $this;
    }
}
