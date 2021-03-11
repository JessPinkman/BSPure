# BSPure

This is a Bootstrap extension of the Library [Pure](https://github.com/JessPinkman/Pure).

- Create reusable Bootstrap components and layouts.
- Easily use all Bootstrap utilities on any component.
- Reduce lines of code.
- Easier Typing (autocompletion, docblock documentation, type hints, ...).

# 3 Factories and 1 Base Component

Whereas [Pure\Pure](https://github.com/JessPinkman/Pure) outputs 'Pure\Component' instances, BSPure factories output 'BSPure\Components\BSBaseComponent' instances.
BSBaseComponent instances have access to bootstrap utilities.

## BSPure::{tag}

BSPure class is a low level factory, use it to create any DOM elements with any html tag.
```php
BSPure::div()->bg('primary', true)->m(5, 2)('Hello World');
```
```html
<div class="bg-primary bg-gradient mx-5 my-2">Hello World</div>
```
It also offers some core functions such as loading Boostrap stylesheets/scripts via CDN.
```php
BSPure::loader();
```
```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anomymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
```
there is also some abstraction involved when calling specific tags, such as 'head', which adds the necessary meta tags for bootstrap.
```php
BSPure::head()(
  BSPure::title()('this is the page title')
);
```
```html
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>this is the page title</title>
</head>
```

## BSComponent::{component}

This is the factory to create Boostrap core components (accordions, buttons, modals, carousels ...).
```php
BSComponent::button('alert')('CLICK HERE');
```
```html
<button type="button" class="btn btn-alert">CLICK HERE</button>
```
## BSLayout::{layout}

This is the factory to create Boostrap layout components (col, row, container).
```php
BSComponent::col(5, 'md-3')('This is a column');
```
```html
<div class="col-5 col-md-3">This is a column</div>
```

# PAGE EXAMPLE

Here is an example of a basic page. With a responsive navbar [how it looks on codepen](https://codepen.io/JessPinkman/full/wvoRzVd)
```php

$base_url = 'https://github.com/JessPinkman/';

BSPure::html()(
    BSPure::head()(
        BSPure::title('BSPure'),
        BSPure::loader()
    ),
    BSPure::body()(
        BSComponent::navBar()->expand('lg')->variant('dark')->bg('dark')->sticky()(
            BSComponent::navBarBrand()->href($base_url)('JessPinkman'),
            BSComponent::navBarToggler('#menu'),
            BSComponent::navBarCollapse('menu')->justifyContent('end')(
                BSComponent::navBarNav()(
                    BSComponent::navLink('/')('HOME'),
                    BSComponent::navLink('/products')('CATALOGUE')
                )
            )
        ),
        BSLayout::container('fluid')->h(100, true)->d('flex')->alignItems('center')->justifyContent('center')(
            BSPure::a()->href('https://github.com/JessPinkman/BSPure')(
                BSComponent::button('danger')->rounded('pill')->p(5, 2)->shadow()(
                    BSPure::h1()('BSPure')
                )
            )
        ),
    )
);
```
BSPURE character count: **930**

```html
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BSPure</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anomymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">BSPure</a>
                <button data-bs-toggle="collapse" aria-expanded="false" aria-controls="#menu" data-bs-target="#menu"
                    class="navbar-toggler" aria-label="toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="menu">
                    <div class="navbar-nav">
                        <a href="/" class="nav-link">HOME</a>
                        <a href="/products" class="nav-link">CATALOGUE</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
            <a href="https://github.com/JessPinkman/BSPure">
                <button class="btn btn-danger rounded-pill px-5 py-2 shadow" type="button">
                    <h1>BSPure</h1>
                </button>
            </a>
        </div>
    </body>

</html>
```
HTML character count: **1831**

## Object Oriented

Because BSPure revolves around objects, the possibilities are endless.
Inheritance, composition, loops, strict typing, etc ...

```php
/**
 * Custom factory to create app components
 */
class AppComponentFactory extends BSComponent
{
    /**
     * Make a reusable component to create uniform buttons.
     *
     * Added classes: btn-warning rounded-pill px-3 py-1 m-3
     */
    public static function appButton(string $label): BSBaseComponent
    {
        return parent::button('warning')
            ->rounded('pill')
            ->p(3, 1)
            ->m(3)
            ->___($label);
    }
}

echo AppComponentFactory::appButton('BUY NOW');
```
```html
<button class="btn btn-warning rounded-pill px-3 py-1 m-3" type="button">BUY NOW</button>
```

# Full Page

rendered in [codepen](https://codepen.io/JessPinkman/full/zYoyZaL?editors=1000)

```php
BSPure::html()(
    BSPure::head()(
        BSPure::title('BSPure'),
        BSPure::loader()
    ),
    BSPure::body()(
        BSComponent::navBar()->variant('dark')->expand('lg')->bg('success', true)->sticky()->shadow('sm')(
            BSComponent::navBarBrand()->href($git_url)('JessPinkman'),
            BSComponent::navBarToggler('#menu'),
            BSComponent::navBarCollapse('menu')->justifyContent('end')->m(5, 0)(
                BSComponent::navBarNav()->gap(2)(
                    BSComponent::navLink($pure)->target('_blank')('Pure'),
                    BSComponent::navLink($BSpure)->target('_blank')('BSPure'),
                    BSComponent::navLink($bootstrap)->target('_blank')('Bootstrap'),
                )
            )
        ),
        BSLayout::container('fluid')->text('center')->gap(5)->flexColumn()->d('flex')->p(5)(
            BSPure::h1()("Visit the git repos !"),
            BSLayout::row('fluid')->gap(5)->p(5)(
                BSLayout::col('lg')(
                    BSComponent::card()->text('start')->shadow()(
                        BSComponent::cardHeader()->colors('light', 'dark')('Pure'),
                        BSComponent::cardBody()(
                            BSPure::h6()('Library to create, use and reuse components to generate html'),
                            BSPure::ul()(
                                BSPure::li()('Combine elements freely and seamlessly.'),
                                BSPure::li()('Easily add attributes to any element with the use of magic __call.'),
                                BSPure::li()('Create structures that you can interact with by extending the class'),
                                BSPure::li()('Make your code shorter, clean, and readable.'),
                            ),
                            BSComponent::cardLink($pure)->target('_blank')->stretchedLink()
                        )
                    )
                ),
                BSLayout::col('lg')(
                    BSComponent::card()->text('start')->shadow()(
                        BSComponent::cardHeader()->colors('light', 'dark')('BSPure'),
                        BSComponent::cardBody()(
                            BSPure::h6()('This is a Bootstrap extension of the Library Pure'),
                            BSPure::ul()(
                                BSPure::li()('Create reusable Bootstrap components and layouts.'),
                                BSPure::li()('Easily use all Bootstrap utilities on any component.'),
                                BSPure::li()('Reduce lines of code.'),
                                BSPure::li()('Easier Typing (autocompletion, docblock documentation, type hints, ...)
                                '),
                            ),
                            BSComponent::cardLink($BSpure)->target('_blank')->stretchedLink()
                        )
                    )
                ),
            ),
        ),
        BSPure::div()->text('center')(
            BSComponent::button('info')
                ->targetModal('modal')
                ->text('light')
                ->rounded('pill')
                ->p(5, 2)
                ->shadow()
                ->___(
                    BSPure::h1()('show me')
                ),
            BSComponent::modal('modal')->fade()->centered()(
                BSComponent::modalBody()->rounded()->border(0)->text('start')(
                    BSPure::code()('BSComponent::alert("danger")->text("center")("Alert");'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::alert("success")->text("center")("SAVED !");'),
                    BSPure::br(),
                    BSComponent::alert('danger')->text('center')->m(0, 1)("Alert"),
                    BSComponent::alert('success')->text('center')->m(0, 1)("SAVED !"),
                    BSPure::hr(),
                    BSPure::code()('BSComponent::spinner(true)->text("warning");'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::spinner(true)->text("danger");'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::spinner(true)->text("success");'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::spinner(false)->text("warning");'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::spinner(false)->text("danger");'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::spinner(false)->text("success");'),
                    BSPure::br(),
                    BSComponent::spinner(true)->text('warning'),
                    BSComponent::spinner(true)->text('danger'),
                    BSComponent::spinner(true)->text('success'),
                    BSComponent::spinner(false)->text('warning'),
                    BSComponent::spinner(false)->text('danger'),
                    BSComponent::spinner(false)->text('success'),
                    BSPure::hr(),
                    BSPure::code()('BSComponent::progress(30);'),
                    BSPure::br(),
                    BSPure::code()('BSComponent::progress(80);'),
                    BSComponent::progress(30)->m(0, 1),
                    BSComponent::progress(80)->m(0, 1),
                )
            )
        ),
    )
);
```