module.exports = {
	paths: {
		sources: {
			js: 'src/js/**/*.js',
			jst: 'src/js/theme/**/*.js',
			jsv: 'src/js/vendor/**/*.js',
			stylus: 'src/styl/**/*.styl',
			stylusM: 'src/styl/style.styl',
			img: 'src/img/*',
			php: './**/*.php',
		},
		destinations: {
			js: 'assets/js',
			jsM: 'assets/js/scripts.js',
			css: 'assets/css',
			cssM: 'assets/css/style.css',
			img: 'assets/img',
		},
	},
};
