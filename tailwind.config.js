/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      screens: {
        'xs': '320px',  // Custom breakpoint for 320px screens
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

