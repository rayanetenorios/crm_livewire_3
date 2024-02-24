import forms from '@tailwindcss/forms'
import typo from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
		"./resources/**/*.blade.php",
		 "./resources/**/*.js",
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],
	theme: {
		extend: {},
	},

  	// daisyui: {
	// 	themes: [
	// 		{
	// 			mytheme: {
	// 				"primary": "#991b1b",	
	// 				"secondary": "#1c1917",
	// 				"accent": "#991b1b",
	// 				"neutral": "#f3f4f6",
	// 				"base-100": "#ffffff",
	// 				"info": "#0ea5e9",
	// 				"success": "#22c55e",
	// 				"warning": "#eab308",
	// 				"error": "#dc2626",
	// 			},
	// 		},
	// 	],
  	// },
  	plugins: [
		forms,
		typo,
		require("daisyui")
	],
}

