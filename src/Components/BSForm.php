<?php

namespace BSPure\Components;

class BSForm extends BSPure
{
    public static function email(string $id, string $label): BSBaseComponent
    {
        return self::input()
            ->type('email')
            ->class('form-control');
    }
}
