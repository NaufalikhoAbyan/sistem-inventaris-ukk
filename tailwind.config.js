/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#4e73df',
                'primary-dark': '#224abe',
                'admin-gray': '#f8f9fc',
                'admin-gray-dark': '#858796',
                'admin-warning': '#f6c23e',
                'admin-danger': '#e74a3b'
            },
            fontFamily: {
                'nunito': ['Nunito', '-apple-system', 'BlinkMacSystemFont', "Segoe UI", 'Roboto', "Helvetica Neue", 'Arial', 'sans-serif', "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"],
            },
        },
    },
    plugins: [],
}
