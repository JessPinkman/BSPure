# BSPure

This is a Bootstrap extension of the Library [Pure](https://github.com/JessPinkman/Pure).

- Create reusable Bootstrap components and layouts.
- Easily use all Bootstrap utilities on any component.
- Reduce your code by 60%.
- Benefit from autocompletion and helpful documentation while typing.

# 3 FACTORIES
all of them output Bootstrap Base Components (BSBaseComponent):

## BSPure::{tag}

BSPure class is the base factory, use it to create any DOM elements with any html tag, just like Pure. The only difference is that the component has access to all bootstrap utilities. (see BSBaseComponent)
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
there is also some magic involved when calling specific tags, such as 'head', which adds the necessary meta tags for bootstrap.
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

This is the factory to create Boostrap core components (accordions, buttons, modals, ...)
```php
BSComponent::button('alert')('CLICK HERE');
```
```html
<button type="button" class="btn btn-alert">CLICK HERE</button>
```
## BSLayout::{layout}

This is the factory to create Boostrap layout components (col, row, container)
```php
BSComponent::col(5, 'md-3')('This is a column');
```
```html
<div class="col-5 col-md-3">This is a column</div>
```