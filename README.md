# Installation

## Dependecies:
- Tailwind CSS
- Alpine JS
- Blinq/Icons

## When you use Tailwind CSS

Edit your `tailwind.config.js` file and add the following lines:

```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // ..
    ...require('./vendor/blinq/ui/tailwind.content'), // Add this line
  ],
  theme: {
    extend: {
      fontFamily: {
        // ..
        sans: ["Poppins", "sans-serif"], // Add this line
      },
      colors: {
        // ..
        ...require('./vendor/blinq/ui/tailwind.colors'), // Add this line
      },
    },
  },
}

Add the following lines to your `resources/css/app.css` file:

```css
@import "tailwindcss/base";
...

@import "../../vendor/blinq/ui/resources/css/main.css"; // Add this line

```

# The font
```html
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
```



