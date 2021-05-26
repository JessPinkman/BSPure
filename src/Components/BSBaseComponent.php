<?php

namespace BSPure\Components;

use Error;
use Pure\Component;

class BSBaseComponent extends Component
{

    public function __construct(string $tag = 'div')
    {
        parent::__construct($tag);
    }

    /**
     * @param string $modifiers
     * COLORS:
     *  {primary, secondary, success, danger, warning, info, light, dark, body, muted, white, black-50, white-50, reset}
     *
     * ALIGNEMENTS: ?({sm, md, lg, xl, xxl}-){start, center, end}
     *
     * WRAP: {wrap, nowrap, truncate}
     *
     * BREAK: {break}
     *
     * TRANSFORM: {lowercase, uppercase, capitalize}
     *
     * DECORATION: decoration-{underline, line-through, none}
     */
    public function text(string ...$modifiers): static
    {
        foreach ($modifiers as $prop) {
            $this->class('text-' . $prop);
        }
        return $this;
    }

    public function fontMonospace(): static
    {
        return $this->class('font-monospace');
    }

    /**
     * @param int $size {1...6}
     */
    public function fs(int $size): static
    {
        return $this->class("fs-$size");
    }

    /**
     * @param string $postion {baseline, top, middle, bottom, text-top, text-bottom}
     */
    public function align(string $position): static
    {
        return $this->class("align-$position");
    }

    /**
     * @param string $modifiers
     * WEIGHT: {bold, bolder, normal, light, lighter}
     *
     * STYLE: {italic, normal}
     */
    public function fw(string ...$modifiers): static
    {
        foreach ($modifiers as $prop) {
            $this->class('fw-' . $prop);
        }
        return $this;
    }

    /**
     * line-height
     * @param string $size {1, sm, base, lg}
     */
    public function lh(string $size): static
    {
        return $this->class("lh-$size");
    }

    /**
     * colors: {primary, secondary, success, danger, warning, info, light, dark, body, muted, white, black-50, white-50}
     */
    public function bg(string $color, bool $gradient = false): static
    {
        $this->class('bg-' . $color);
        $gradient && $this->class('bg-gradient');
        return $this;
    }

    /**
     * {primary, secondary, success, danger, warning, info, light, dark, body, muted, white, black-50, white-50, reset}
     */
    public function colors(?string $text = null, ?string $bg = null, ?string $border = null): static
    {
        $text && $this->text($text);
        $bg && $this->bg($bg);
        $border && $this->border($border);

        return $this;
    }

    public function dismissModal(string $label = 'close'): static
    {
        return $this->data_bs_dismiss('modal')->aria_label($label);
    }

    public function disabled(bool $is_disabled = true): static
    {
        if ($is_disabled) {
            parent::class('disabled')
                ->aria_disabled('true')
                ->tabindex('-1');
        }

        return $this;
    }

    public function active(bool $is_active = true, $aria = 'true'): static
    {
        if ($is_active) {
            $this->class('active')->aria_current($aria);
        }
        return $this;
    }

    /**
     * @param string $variant
     *  {primary, secondary, success, danger, warning, info, light, dark, body, muted, white, black-50, white-50, reset}
     */
    public function btn(string $variant = 'primary'): static
    {
        return $this->class("btn btn-$variant")->type('button');
    }

    public function visuallyHidden(bool $with_focus = false): static
    {
        return $this->class($with_focus ? 'visually-hidden-focusable' : 'visually-hidden');
    }

    /**
     * @param string $additionals
     * {action, primary, secondary, success, danger, warning, info, light, dark}
     */
    public function listGroupItem(string ...$additionals): static
    {
        $this->class('list-group-item');
        foreach ($additionals as $class) {
            $this->class("list-group-item-$class");
        }
        return $this;
    }

    public function targetModal(string $target_id): static
    {
        return $this
            ->data_bs_toggle('modal')
            ->data_bs_target("#$target_id");
    }

    public function fixed(bool $top = true): static
    {
        return $this->class($top ? 'fixed-top' : 'fixed-bottom');
    }

    /**
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function sticky(?string $bp = null): static
    {
        return $this->class($bp ? "sticky-$bp-top" : 'sticky-top');
    }

    /**
     * @param string $position {top, right, bottom, left}
     */
    public function tooltip(string $text, string $position = 'top'): static
    {
        Loader::loadTooltip();
        return $this
            ->data_bs_toggle('tooltip')
            ->data_bs_placement($position)
            ->title($text);
    }

    /**
     * @param string $position {top, right, bottom, left}
     */
    public function popover(?string $title, ?string $text, string $position = 'top'): static
    {
        Loader::loadPopover();
        $this
            ->data_bs_toggle('popover')
            ->data_bs_container('body')
            ->data_bs_placement($position);

        $title && $this->title($title);
        $text && $this->data_bs_content($text);

        return $this;
    }

    /**
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function flexRow(bool $reverse = false, ?string $bp = null): static
    {
        $class = 'flex-row';
        $bp && $class .= "-$bp";
        $reverse && $class .= '-reverse';

        return $this->class($class);
    }
    /**
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function flexColumn(bool $reverse = false, ?string $bp = null): static
    {
        $class = 'flex-column';
        $bp && $class .= "-$bp";
        $reverse && $class .= '-reverse';

        return $this->class($class);
    }

    /**
     * @param string $type start / end / none
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function float(string $type, ?string $bp = null): static
    {
        $class = 'float';
        $bp && $class .= "-$bp";
        $class .= "-$type";

        return $this->class($class);
    }

    /**
     * @param string $type {start, end, center, between, around, evenly}
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function justifyContent(string $type, ?string $bp = null): static
    {
        $class = 'justify-content';
        $bp && $class .= "-$bp";
        $class .= "-$type";

        return $this->class($class);
    }

    /**
     * @param string $type {start, end, center, baseline, stretch}
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function alignItems(string $type, ?string $bp = null): static
    {
        $class = 'align-items';
        $bp && $class .= "-$bp";
        $class .= "-$type";

        return $this->class($class);
    }

    /**
     * @param string $type {start, end, center, baseline, stretch}
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function alignSelf(string $type, ?string $bp = null): static
    {
        $class = 'align-self';
        $bp && $class .= "-$bp";
        $class .= "-$type";

        return $this->class($class);
    }

    /**
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function flexWrap(bool $wrap = true, ?string $bp = null, bool $reverse = false): static
    {
        $class = 'flex';
        $bp && $class .= "-$bp";
        $class .= '-' . ($wrap ? 'wrap' : 'nowrap');
        $reverse && $wrap && $class .= '-reverse';

        return $this->class($class);
    }

    /**
     * @param int $order {1...12}
     * @param string|null $bp {null, sm, md, lg, xl}
     */
    public function order(int $order, ?string $bp = null): static
    {
        $class = 'order';

        $bp && $class .= "-$bp";

        if ($order <= 1) {
            $class .= '-first';
        } elseif ($order >= 12) {
            $class .= '-last';
        } else {
            $class .= "-$order";
        }
        return $this->class($class);
    }

    /**
     * @param string $displays
     *      ?({sm, md, xl, xxl}-)
     *      {none, inline, inline-block, block, grid, table, table-cell, table-row, flex, inline-flex}
     */
    public function d(string ...$displays): static
    {
        foreach ($displays as $prop) {
            $this->class("d-$prop");
        }
        return $this;
    }

    /**
     * @param string $type {static, relative, absolute, fixed, sticky}
     * @param string $positions {top, start, bottom, end}-{0, 50, 100}
     */
    public function position(string $type, string ...$positions): static
    {
        $this->class("position-$type");
        foreach ($positions as $prop) {
            $this->class($prop);
        }
        return $this;
    }


    /**
     * @param string $variant {primary, secondary, success, danger, warning, info, light, dark}
     */
    public function link(string $variant = 'primary'): static
    {
        return $this->class("link-$variant");
    }

    /**
     * @param string|int $ratio {1x1 / 4x3 / 16x9 / 21x9, 0...100}
     */
    public function ratio($ratio): static
    {
        $this->class('ratio');

        switch (gettype($ratio)) {
            case 'string':
                $this->class("ratio-$ratio");
                break;
            case 'int':
                $this->style("--bs-aspect-ratio: $ratio%");
        }
        return $this;
    }

    /**
     * @param mixed ...$i
     *                      {0...5, auto}
     *
     *                      1: global //
     *                      2: x, y //
     *                      3: t, e, b //
     *                      4: t, e, b, s //
     *                      if null, then class not applied
     */
    public function g(...$i): static
    {
        return $this->class(self::getCrossProp('g', ...$i));
    }

    /**
     * @param mixed ...$i
     *                      {0...5, auto}
     *
     *                      1: global //
     *                      2: x, y //
     *                      3: t, e, b //
     *                      4: t, e, b, s //
     *                      if null, then class not applied
     */
    public function p(...$i): static
    {
        return $this->class(self::getCrossProp('p', ...$i));
    }

    /**
     * @param mixed ...$i
     *                      {0...5, auto}
     *
     *                      1: global //
     *                      2: x, y //
     *                      3: t, e, b //
     *                      4: t, e, b, s //
     *                      if null, then class not applied
     */
    public function m(...$i): static
    {
        return $this->class(self::getCrossProp('m', ...$i));
    }

    /**
     * @param int $i {0...5}
     * @param string|null $bp {null, sm, md, lg, xl, xxl}
     */
    public function gap(int $i, ?string $bp = null): static
    {
        $class = 'gap';
        $bp && $class .= "-$bp";
        $class .= "-$i";

        return $this->class($class);
    }

    /**
     * @param string $modifiers {top, end, bottom, start, circle, pill, 0...3}
     */
    public function rounded(string ...$modifiers): static
    {

        if (!$modifiers) {
            return $this->class('rounded');
        }
        foreach ($modifiers as $prop) {
            $this->class("rounded-$prop");
        }
        return $this;
    }

    /**
     * @param string $modifiers
     * POSITION {TRUE, top, end, bottom, start} append '-0' for opposite effect
     *
     * WIDTH {1...5}
     *
     * COLOR: {primary, secondary, success, danger, warning, info, light, dark}
     */
    public function border(?string ...$modifiers): static
    {

        if (!$modifiers) {
            return $this->class('border');
        }

        foreach ($modifiers as $prop) {
            switch (true) {
                case is_string($prop):
                    $this->class("border-$prop");
                    break;
                case $prop === null:
                    $this->class('border');
                    break;
            }
        }

        return $this;
    }


    private static function getCrossProp(string $prop, ...$i): array
    {
        $class = [];

        switch (count($i)) {
            case 1:
                $i[0] !== null && $class[] = self::crossSection($prop, null, $i[0]);
                break;
            case 2:
                $i[0] !== null && $class[] = self::crossSection($prop, 'x', $i[0]);
                $i[1] !== null && $class[] = self::crossSection($prop, 'y', $i[1]);
                break;
            case 3:
                $i[0] !== null && $class[] = self::crossSection($prop, 't', $i[0]);
                $i[1] !== null && $class[] = self::crossSection($prop, 'e', $i[1]);
                $i[2] !== null && $class[] = self::crossSection($prop, 'b', $i[2]);
                break;
            case 4:
                $i[0] !== null && $class[] = self::crossSection($prop, 't', $i[0]);
                $i[1] !== null && $class[] = self::crossSection($prop, 'e', $i[1]);
                $i[2] !== null && $class[] = self::crossSection($prop, 'b', $i[2]);
                $i[3] !== null && $class[] = self::crossSection($prop, 's', $i[3]);
                break;
            default:
                throw new Error("Too many properties passed");
        }
        return $class;
    }

    private static function crossSection(string $prop, ?string $modifier, $i): string
    {

        return $prop . $modifier . '-' . $i;
    }

    public function dataBS(string $prop, string $val): static
    {
        return $this->{"data-bs-${prop}"}($val);
    }

    public function aria(string $prop, string $val): static
    {
        return $this->{"aria-${prop}"}($val);
    }

    public function styleBS(string $prop, string $val): static
    {
        return $this->style("--bs-$prop: $val");
    }

    /**
     * @param string $type {none / all / auto}
     */
    public function userSelect(string $type = 'none'): static
    {
        return $this->class("user-select-$type");
    }

    public function pe(bool $no_events): static
    {
        return $this->class($no_events ? 'pe-none' : 'pe-auto');
    }

    /**
     * @param string $type {hidden / visible / auto / scroll}
     */
    public function overflow(string $type = 'hidden'): static
    {
        return $this->class("overflow-$type");
    }

    /**
     * @param string|null $modifier {null / sm / lg / none}
     */
    public function shadow(?string $modifier = null): static
    {
        return $this->class($modifier ? "shadow-$modifier" : 'shadow');
    }

    /**
     * @param int $value {25 / 50 / 75 /100 / auto}
     * @param bool $rel_to_viewport
     * @param string|null $modifier {null / min / max}
     */
    public function w(int $value, bool $rel_to_viewport = false, ?string $modifier = null): static
    {
        $class = '';
        $modifier && $class .= $modifier . '-';
        $rel_to_viewport && $class .= 'v';
        $class .= 'w-' . $value;

        return $this->class($class);
    }

    /**
     * @param int $value {25 / 50 / 75 /100 / auto}
     * @param bool $rel_to_viewport
     * @param string|null $modifier {null / min / max}
     */
    public function h(int $value, bool $rel_to_viewport = false, ?string $modifier = null): static
    {
        $class = '';
        $modifier && $class .= $modifier . '-';
        $rel_to_viewport && $class .= 'v';
        $class .= 'h-' . $value;

        return $this->class($class);
    }

    public function visible(bool $is_visible = false): static
    {
        return $this->class($is_visible ? 'visible' : 'unvisible');
    }

    public function stretchedLink(): static
    {
        return $this->class('stretched-link');
    }
}
