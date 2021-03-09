<?php

namespace BSPure\Components;

class BSComponent extends BSPure
{

    public static function accordion(string $accordion_id): Accordion
    {
        return (new Accordion($accordion_id));
    }

    public static function accordionItem(bool $show = false): AccordionItem
    {
        return new AccordionItem($show);
    }

    public static function alert(): BSBaseComponent
    {
        return self::div()
            ->class('alert')
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
        return BSPure::$tag()->class('card-body');
    }

    public static function cardFooter(string $tag = 'div'): BSBaseComponent
    {
        return BSPure::$tag()->class('card-footer');
    }

    public static function cardHeader(string $tag = 'div'): BSBaseComponent
    {
        return BSPure::$tag()->class('card-header');
    }

    public static function cardLink(string $href): BSBaseComponent
    {
        return BSPure::a()->class('card-link')->href($href);
    }

    public static function cardTitle(string $tag = 'h4'): BSBaseComponent
    {
        return BSPure::$tag()->class('card-title');
    }

    public static function cardText(string $tag = 'p'): BSBaseComponent
    {
        return BSPure::$tag()->class('card-text');
    }

    public static function cardSubTitle(string $tag = 'h6'): BSBaseComponent
    {
        return BSPure::$tag()->class('card-subtitle');
    }

    public static function collapse(string $tag = 'div', bool $show = false): BSBaseComponent
    {
        return self::$tag()->class($show ? 'collapse show' : 'collapse');
    }

    public static function collapseButton(string $target, bool $is_button = true): BSBaseComponent
    {
        $tag = $is_button ? 'button' : 'a';
        $button = BSPure::$tag();
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
        return BSPure::a()
            ->href($href)
            ->class('nav-link');
    }

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
        return BSPure::div()->class('navbar-nav');
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
