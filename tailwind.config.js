/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [".storage/framework/views/*.php", "./resources/**/*.blade.php", "./resources/js/**/*.vue", "./resources/**/*.js"],
  theme: {
    extend: {
      screens: {
        tm: "800px",
        // => @media (min-width: 800px) { ... }
      },
    },
    fontFamily: {
      "custom-font": [
        "ui-sans-serif",
        "system-ui",
        "-apple-system",
        "BlinkMacSystemFont",
        "Segoe UI",
        "Roboto",
        "Helvetica Neue",
        "Arial",
        "Noto Sans",
        "sans-serif",
        "Apple Color Emoji",
        "Segoe UI Emoji",
        "Segoe UI Symbol",
        "Noto Color Emoji",
      ],
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/aspect-ratio"),
    require("tailwindcss"),
    // require("@tailwindcss-plugins/pagination"),
  ],
};
