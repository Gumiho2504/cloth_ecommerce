import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    safelist: [
        "bg-red-500",
        "bg-green-500",
        "bg-blue-500",
        "bg-yellow-500",
        "bg-black",
        "bg-white",
        "bg-gray-500",
        "bg-orange-500",
        "bg-purple-500",
        "bg-pink-500",
        "border-red-500",
        "border-green-500",
        "border-blue-500",
        "border-yellow-500",
        "border-black",
        "border-white",
        "border-gray-500",
        "border-orange-500",
        "border-purple-500",
        "border-pink-500",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
