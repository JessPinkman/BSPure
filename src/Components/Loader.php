<?php

namespace BSPure\Components;

use Pure\Fragment;

class Loader extends Fragment
{
    private const CDN_CSS_URL = 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css';
    private const CDN_JS_URL = 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js';

    private const CDN_CSS_INTEGRITY = 'sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl';
    private const CDN_JS_INTEGRITY = 'sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0';

    public static bool $load_tooltip = false;
    public static bool $load_popover = false;
    public static bool $load_toast = false;

    public function __construct(bool $with_js = true)
    {
        $this(
            BSPure::link()
                ->href($this::CDN_CSS_URL)
                ->rel("stylesheet")
                ->integrity($this::CDN_CSS_INTEGRITY)
                ->crossorigin('anomymous')
        );

        if ($with_js) {
            $this(
                BSPure::script()
                    ->src($this::CDN_JS_URL)
                    ->integrity($this::CDN_JS_INTEGRITY)
                    ->crossorigin('anonymous')
            );
        }
    }

    public static function getCSSCDN(): BSBaseComponent
    {
        return BSPure::link()
            ->href(self::CDN_CSS_URL)
            ->rel("stylesheet")
            ->integrity(self::CDN_CSS_INTEGRITY)
            ->crossorigin('anomymous');
    }

    public static function getJSCDN(): BSBaseComponent
    {
        return BSPure::script()
            ->src(self::CDN_JS_URL)
            ->integrity(self::CDN_JS_INTEGRITY)
            ->crossorigin('anonymous');
    }

    public static function loadTooltip(): void
    {
        self::$load_tooltip = true;
    }

    public function __toString(): string
    {
        if (self::$load_tooltip) {
            $this(BSPure::script()(self::getJSScript('tooltip')));
        }
        if (self::$load_popover) {
            $this(BSPure::script()(self::getJSScript('popover')));
        }
        if (self::$load_toast) {
            $this(BSPure::script()(self::getJSScript('toast')));
        }
        return parent::__toString();
    }

    public static function loadPopover(): void
    {
        self::$load_popover = true;
    }

    public static function loadToast(): void
    {
        self::$load_toast = true;
    }

    public static function getJSScript(string $type): string
    {

        switch ($type) {
            case 'toast':
                $selector = '.toast';
                $property = 'Toast';
                $options = '{autohide: false}';
                break;
            case 'tooltip':
                $selector = '[data-bs-toggle="tooltip"]';
                $property = 'Tooltip';
                $options = null;
                break;
            case 'popover':
                $selector = '[data-bs-toggle="popover"]';
                $property = 'Popover';
                $options = null;
                break;
        }

        $string = <<<END
            window.addEventListener('load', (event) => {
                [].slice.call(document.querySelectorAll('$selector')).map((el) => {
                    return new bootstrap.$property(el, $options);
                });
            });
        END;

        return $string;
    }
}
