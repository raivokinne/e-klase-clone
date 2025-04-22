/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./view/**/*.php"],
  theme: {
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
        kanit: ["Kanit", "sans-serif"],
        playfair: ["Playfair Display", "serif"],
        libre_baskerville_regular: ["Libre Baskerville", "serif"],
      },
    },
  },
  plugins: [],
};
