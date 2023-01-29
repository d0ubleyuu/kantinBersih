/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js"
    ],
    darkMode: 'class',
    theme: {
        customForms: (theme) => ({
            default: {
                'input, textarea': {
                    '&::placeholder': {
                        color: theme('colors.gray.400'),
                    },
                },
            },
        }),
        extend: {
            colors: {
                primary: {
                    50: '#feefee',
                    100: '#fbcfcd',
                    200: '#f8afab',
                    300: '#f58f89',
                    400: '#f26f68',
                    500: '#ef4f46',
                    DEFAULT: '#ee4036',
                    600: '#ee4036',
                    700: '#da1d12',
                    800: '#b91910',
                    900: '#97140d',
                },
                teal: colors.teal,
                orange: colors.orange,
                coolGray: colors.gray,
            },
            maxHeight: {
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
                outline: '0 0 0 3px rgba(66, 153, 225, 0.5)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ],
}
