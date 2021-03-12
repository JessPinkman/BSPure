<?php

namespace BSPure;

use BSPure\Components\Accordion;
use BSPure\Components\AccordionItem;
use BSPure\Components\Breadcrumb;
use BSPure\Components\BreadcrumbItem;
use BSPure\Components\BSBaseComponent;
use BSPure\Components\Carousel;
use BSPure\Components\Dropdown;
use BSPure\Components\Loader;
use BSPure\Components\Modal;
use BSPure\Components\NavBar;
use BSPure\Components\PageItem;
use BSPure\Components\Progress;
use BSPure\Components\Spinner;
use Pure\Fragment;
use Pure\Pure;

/**
 * @method static BSBaseComponent div
 * @method static BSBaseComponent p
 * @method static BSBaseComponent a
 * @method static BSBaseComponent span
 * @method static BSBaseComponent ul
 * @method static BSBaseComponent ol
 * @method static BSBaseComponent li
 * @method static BSBaseComponent h1
 * @method static BSBaseComponent h2
 * @method static BSBaseComponent h3
 * @method static BSBaseComponent h4
 * @method static BSBaseComponent h5
 * @method static BSBaseComponent h6
 * @method static BSBaseComponent head
 * @method static BSBaseComponent title
 * @method static BSBaseComponent meta
 * @method static BSBaseComponent body
 */
class BSPure extends Pure
{

    public static function __callStatic(string $tag, array $children): BSBaseComponent
    {
        $component = new BSBaseComponent($tag);
        if (count($children)) {
            $component->___($children);
        }
        return $component;
    }

    public static function img(bool $fluid = false, bool $thumbnail = false): BSBaseComponent
    {
        $img = (new BSBaseComponent('img'));
        $fluid && $img->class('img-fluid');
        $thumbnail && $img->class('img-thumbnail');

        return $img;
    }

    public function table(string ...$modifiers): BSBaseComponent
    {
        $table = (new BSBaseComponent('table'));

        $table->class('table');

        foreach ($modifiers as $prop) {
            $table->class("table-$prop");
        }

        return $table;
    }

    public static function loader(): Loader
    {
        return new Loader;
    }

    public static function head(): BSBaseComponent
    {
        return (new BSBaseComponent('head'))(self::requiredMeta());
    }

    public static function requiredMeta(): Fragment
    {
        return new Fragment(
            self::meta()->charset('utf-8'),
            self::meta()->name('viewport')->content('width=device-width, initial-scale=1, shrink-to-fit=no'),
        );
    }

    /**
     * Layout starts here
     */

    public static function container(?string $modifier = null): BSBaseComponent
    {
        return self::div()->class($modifier ? "container-$modifier" : 'container');
    }

    public static function col(...$variants): BSBaseComponent
    {
        $col = self::div();

        !$variants && $col->class('col');

        foreach ($variants as $variant) {
            $col->class("col-$variant");
        }

        return $col;
    }

    public static function row(): BSBaseComponent
    {
        return self::div()->class('row');
    }

    /**
     * Components starts here
     */

    public static function accordion(string $accordion_id): Accordion
    {
        return (new Accordion($accordion_id));
    }

    public static function accordionItem(bool $show = false): AccordionItem
    {
        return new AccordionItem($show);
    }

    public static function alert(string $variant = 'primary'): BSBaseComponent
    {
        return self::div()
            ->class("alert alert-$variant")
            ->role('alert');
    }

    public static function badge(): BSBaseComponent
    {
        return self::span()->class('badge');
    }

    public static function breadcrumb(): Breadcrumb
    {
        return new Breadcrumb();
    }

    public static function breadcrumbItem(?string $href = null): BreadcrumbItem
    {
        return new BreadcrumbItem($href);
    }

    public static function carousel(string $id): Carousel
    {
        return new Carousel($id);
    }

    public static function button(string $variant = 'primary'): BSBaseComponent
    {
        return (new BSBaseComponent('button'))
            ->class("btn btn-$variant")
            ->type('button');
    }

    public static function buttonGroup(): BSBaseComponent
    {
        return self::div()
            ->class('btn-group')
            ->role('group')
            ->aria('label', 'button group');
    }

    public static function closeButton(bool $white = false): BSBaseComponent
    {
        return self::button()
            ->class(false, $white ? 'btn-close btn-close-white' : 'btn-close')
            ->aria('label', 'close');
    }

    public static function dropdown(string $label, string $button_id, string $variant = 'primary'): Dropdown
    {
        return new Dropdown($label, $button_id, $variant);
    }

    public static function card($tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('card');
    }

    public static function cardImg(string $src, string $alt, ?string $variant = null): BSBaseComponent
    {
        return self::img()
            ->class($variant ? "card-img-$variant" : 'card-img')
            ->src($src)
            ->alt($alt);
    }

    public static function cardBody($tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('card-body');
    }

    public static function cardFooter(string $tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('card-footer');
    }

    public static function cardHeader(string $tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('card-header');
    }

    public static function cardLink(string $href): BSBaseComponent
    {
        return self::a()->class('card-link')->href($href);
    }

    public static function cardTitle(string $tag = 'h4'): BSBaseComponent
    {
        return self::$tag()->class('card-title');
    }

    public static function cardText(string $tag = 'p'): BSBaseComponent
    {
        return self::$tag()->class('card-text');
    }

    public static function cardSubTitle(string $tag = 'h6'): BSBaseComponent
    {
        return self::$tag()->class('card-subtitle');
    }

    public static function collapse(string $tag = 'div', bool $show = false): BSBaseComponent
    {
        return self::$tag()->class($show ? 'collapse show' : 'collapse');
    }

    public static function collapseButton(string $target, bool $is_button = true): BSBaseComponent
    {
        $tag = $is_button ? 'button' : 'a';
        $button = self::$tag();
        $button
            ->dataBS('toggle', 'collapse')
            ->aria('expanded', 'false')
            ->aria('controls', $target);

        switch ($button->pure_tag) {
            case 'a':
                $button
                    ->href($target)
                    ->role('button');
                break;
            case 'button':
                $button->dataBS('target', $target);
                break;
        }
        return $button;
    }

    public static function listGroup(string $tag = 'ul'): BSBaseComponent
    {
        return self::$tag()->class('list-group');
    }

    public static function listGroupItem(string $tag = 'li', ...$list_classes): BSBaseComponent
    {
        $item = self::$tag()->class(false, 'list-group-item');
        foreach ($list_classes as $prop) {
            $item->class("list-group-item-$prop");
        }
        return $item;
    }

    public static function modal(string $id): Modal
    {
        return new Modal($id);
    }

    public static function modalHeader(string $tag = 'h5'): BSBaseComponent
    {
        return self::$tag()->class('modal-header');
    }

    public static function modalBody(string $tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('modal-body');
    }

    public static function modalFooter(string $tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('modal-footer');
    }

    public static function nav(...$nav_classes): BSBaseComponent
    {
        $nav = (new BSBaseComponent('nav'))->class('nav');
        foreach ($nav_classes as $prop) {
            $nav->class("nav-$prop");
        }
        return $nav;
    }

    public static function navLink(string $href): BSBaseComponent
    {
        return self::a()
            ->href($href)
            ->class('nav-link');
    }

    /**
     * Create a navbar element
     * Use variant to change text colors
     * append BSComponent::{navBarBrand, navBarToggler, navBarCollapse }
     */
    public static function navBar(bool $fluid = true): NavBar
    {
        return new NavBar($fluid);
    }

    public static function navBarBrand(string $tag = 'a'): BSBaseComponent
    {
        return self::$tag()->class('navbar-brand');
    }

    public static function navBarToggler(string $target): BSBaseComponent
    {
        return self::collapseButton($target)
            ->class(false, 'navbar-toggler')
            ->aria('label', 'toggle navigation')
            ->___(
                BSPure::span()->class('navbar-toggler-icon')
            );
    }

    public static function navBarCollapse(string $id): BSBaseComponent
    {
        return self::collapse()
            ->id($id)
            ->class('navbar-collapse');
    }

    public static function navBarNav(): BSBaseComponent
    {
        return self::div()->class('navbar-nav');
    }

    public static function pagination(?string $size = null): BSBaseComponent
    {
        return self::ul()->class($size ? "pagination pagination-$size" : 'pagination');
    }

    public static function pageItem(?string $href = null): PageItem
    {
        return new PageItem($href);
    }

    public static function progress(int $value, int $min = 0, int $max = 100): Progress
    {
        return new Progress($value, $min, $max);
    }

    public static function spinner(bool $border = true): Spinner
    {
        return new Spinner($border);
    }

    public static function toast(bool $critical = false): BSBaseComponent
    {
        Loader::loadToast();

        return self::div()
            ->role('alert')
            ->class('toast')
            ->aria('live', $critical ? 'assertive' : 'polite')
            ->aria('atomic', 'true');
    }

    public static function toastHeader(string $tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('toast-header');
    }

    public static function toastBody(string $tag = 'div'): BSBaseComponent
    {
        return self::$tag()->class('toast-body');
    }
}
