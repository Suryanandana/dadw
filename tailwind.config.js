/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // or 'media' or 'class'
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        serif: ['Newsreader', 'serif'],
      },
      animation: {
        fadein: 'fadeIn .3s ease-in forwards',
        fadeout: 'fadeOut .3s ease-in forwards',
        textfadein: 'textFadeIn .3s ease-in forwards',
        textfadein: 'textFadeOut .3s ease-in forwards',
      },
      keyframes: theme => ({
        fadeIn: {
          '0%': { 
            backgroundColor: theme('colors.transparent'),
            borderBottom: "0px solid theme('colors.gray.100')",
          },
          '100%': { 
            backgroundColor: theme('colors.white'),
            borderBottom: "2px solid theme('colors.gray.100')",
            color: theme('colors.black')
          },
        },
        fadeOut: {
          '0%': { 
            backgroundColor: theme('colors.white'),
            borderBottom: "2px solid theme('colors.gray.100')",
            color: theme('colors.black')
          },
          '100%': { 
            backgroundColor: theme('colors.transparent'),
            borderBottom: "0px solid theme('colors.gray.100')",
            color: theme('colors.white')
          },  
        },
      }),
    },
  },
  plugins: [],
}

