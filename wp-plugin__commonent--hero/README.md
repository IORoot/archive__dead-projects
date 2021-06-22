# C-HERO-CONTAINER & PANEL  

## Contents

- [Contents](#contents)
- [What is it?](#what-is-it)
  - [Fallbacks support](#fallbacks-support)
  - [Responsive](#responsive)
    - [Viewport sizes](#viewport-sizes)
  - [Testing](#testing)
    - [CSS-Grid enabled Web](#css-grid-enabled-web)
    - [Flexbox enabled web](#flexbox-enabled-web)
    - [CSS-Grid enabled mobile](#css-grid-enabled-mobile)
    - [Flexbox enabled mobile & tablet](#flexbox-enabled-mobile--tablet)
  - [Vendor Prefix to watch out for](#vendor-prefix-to-watch-out-for)
    - [Notes on fallbacks & responsiveness](#notes-on-fallbacks--responsiveness)

## What is it?

The C-HERO-CONTAINER v2 contains two new parts: Fallbacks and Responsive.

## Fallbacks support

We define bottom up. Reason is because CSS-grid will override the others. Like Mobile-first creation.
https://browserl.ist/?q=last%2010%20version

## Responsive

- Web : 1024px+
- Tablet : max-width(1024px)****
- Mobile : max-width(768px)

### Viewport sizes

| unit   | alternative   | browser |
| ------ | ------------- | ------- |
| `vmin` | `vm`          | IE 9    |
| `vmax` | not supported | IE 9    |


## Testing
https://www.browserstack.com/test-on-the-right-mobile-devices
The testing is done on the following devices:

### CSS-Grid enabled Web

| Test | Device | OS           | Browser | Ver | Grid | Flex | Foat | Notes                                |
| ---- | ------ | ------------ | ------- | --- | ---- | ---- | ---- | ------------------------------------ |
| x    | Laptop | MacOS Mojave | Safari  | 12  | x    | x    | x    |                                      |
|      | Laptop | MacOS Mojave | Firefox | 68  | x    | x    | x    |                                      |
|      | Laptop | MacOS Mojave | Chrome  | 76  | x    | x    | x    |                                      |
| x    | Laptop | Windows 10   | IE      | 11  | x    | x    | x    | `-ms-grid` no `unset` no `@supports` |
|      | Laptop | Windows 10   | Edge    | 16  | x    | x    | x    |                                      |
|      | Laptop | Windows 10   | Firefox | 68  | x    | x    | x    |                                      |
|      | Laptop | Windows 10   | Chrome  | 76  | x    | x    | x    |                                      |

### Flexbox enabled web

| Test | Device | OS               | Browser | Ver | Grid | Flex | Foat | Notes |
| ---- | ------ | ---------------- | ------- | --- | ---- | ---- | ---- | ----- |
| x    | Laptop | MacOS El Capitan | Safari  | 9   |      | x    | x    |       |
|      | Laptop | MacOS El Capitan | Firefox | 51  |      | x    | x    |       |
| xx   | Laptop | MacOS El Capitan | Chrome  | 56  |      | x    | x    |       |
| x    | Laptop | Windows 7        | IE      | 9   |      | x    | x    |       |
|      | Laptop | Windows 7        | Firefox | 51  |      | x    | x    |       |
|      | Laptop | Windows 7        | Chrome  | 56  |      | x    | x    |       |

### CSS-Grid enabled mobile

| Test | Device      | OS        | Browser | Ver | Grid | Flex | Foat | Notes |
| ---- | ----------- | --------- | ------- | --- | ---- | ---- | ---- | ----- |
|      | iPhone XS   | iOS 12    | Safari  | 12  | x    | x    | x    |       |
|      | iPhone XS   | iOS 12    | Chrome  | 75  | x    | x    | x    |       |
| x    | iPhone 8    | iOS 11    | Safari  | 11  | x    | x    | x    |       |
|      | iPhone 8    | iOS 11    | Chrome  | 75  | x    | x    | x    |       |
|      | iPad 6th    | iOS 11    | Safari  | 11  | x    | x    | x    |       |
| x    | iPad 6th    | iOS 11    | Chrome  | 75  | x    | x    | x    |       |
| x    | Galaxy S10+ | Android 9 | Chrome  | 74  | x    | x    | x    |       |
|      | Pixel       | Android 8 | Chrome  | 74  | x    | x    | x    |       |
|      | Galaxy S8+  | Android 7 | Chrome  | 74  | x    | x    | x    |       |
|      | Nexus 7     | Android 6 | Chrome  | 74  | x    | x    | x    |       |

### Flexbox enabled mobile & tablet

| Test | Device     | OS    | Browser | Ver | Grid | Flex | Foat | Notes |
| ---- | ---------- | ----- | ------- | --- | ---- | ---- | ---- | ----- |
| x    | iPhone 6S+ | iOS 9 | Safari  | 9   |      | x    | x    |       |
|      | iPad Air 2 | iOS 8 | Safari  | 8   |      | x    | x    |       |
|      | iPad Air 2 | iOS 8 | Chrome  | 47  |      | x    | x    |       |

## Vendor Prefix to watch out for

https://autoprefixer.github.io/

Use the vendor prefixes:

- `-ms-`
- `-webkit-`
- `-moz-`
- `-o-`

Mostly for:

| property                  | ms                            | webkit                                               | moz                  | o                            |
| ------------------------- | ----------------------------- | ---------------------------------------------------- | -------------------- | ---------------------------- |
| `display: flex`           | `display: -ms-flexbox;`       | `display: -webkit-box;` AND `display: -webkit-flex;` | `display: -moz-box;` |                              |
| `display:grid`            | `display: -ms-grid;`          |                                                      |                      |                              |
| `transform: translate();` | `-ms-transform: translate();` | `-webkit-transform: translate();`                    |                      | `-o-transform: translate();` |



### Notes on fallbacks & responsiveness

1. Flexbox isn't really helpful in some circumstances because it's only a 1-dimensional layout. Therefore, trying to fit a grid with 2-dimensional areas into a flexbox will require a nested flexbox. This means changing the child elements, which is a pain and probably better to just fallback to floats instead. 
2. This is why the container has it's flexbox fallback disabled by default.
3. IE Doesn't support `unset` for the grid height. Use `height: auto` instead.
4. IE Also doesn't like `@supports` either. Therefore, embracing the cascade. Float (default) < flex override < flex tablet < flex mobile < grid override < grid tablet < grid mobile. Therefore the grid mobile rules will trump all other rules. However, this is a good read: https://hacks.mozilla.org/2016/08/using-feature-queries-in-css/
5. Use `auto` for the columns and rows on the grid for tablet and mobile.
    ```
    grid-template-columns: repeat(2, auto);
    grid-template-rows: repeat(3, auto);
    ```

    This is so that different sized areas doen't override the values of `1fr`.

6. Don't use `vmax / vmin / vw / vh` viewport sizes on the default height / widths because these aren't supported in old browsers. Only use `px / % / em`.
7. Use the `flex` shorthand, not the longhand rules.
