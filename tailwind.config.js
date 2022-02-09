require('dotenv').config();

const themeFolder = 'web/app/themes/brocooly';

module.exports = {
	content: [
		`${themeFolder}/resources/views/**/*.twig`,
		`${themeFolder}/resources/assets/js/**/*.js`,
	],
	theme: {
		screens: {
			'sm': '640px',
			// => @media (min-width: 640px) { ... }

			'md': '768px',
			// => @media (min-width: 768px) { ... }

			'lg': '1024px',
			// => @media (min-width: 1024px) { ... }

			'xl': '1280px',
			// => @media (min-width: 1280px) { ... }

			'2xl': '1536px',
			// => @media (min-width: 1536px) { ... }
		},
		container: {
			center: true,
			padding: {
				DEFAULT: '1rem', // 16px both sides
			}
		},
		extend: {
			maxWidth: {
				'1920': '1920px',
			},
		},
	},
	plugins: [],
}
