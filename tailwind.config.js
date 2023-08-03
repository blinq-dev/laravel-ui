/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    ...require('./tailwind.content'),
  ],
  theme: {
    extend: {
      ...require('./tailwind.colors'),
    },
  },
  plugins: [],
}

