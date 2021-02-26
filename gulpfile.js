'use strict';

var gulp = require('gulp'),
		watch = require('gulp-watch'),
		sourcemaps = require('gulp-sourcemaps'),
		cssmin = require('gulp-minify-css'),
		prefixer = require('gulp-autoprefixer'),
		rigger = require('gulp-rigger'),
		less = require('gulp-less');

var path = {
	build: {
		html: 'build/',
		js: 'build/js/',
		css: 'build/css/',
		img: 'build/img/',
		fonts: 'build/fonts/'
	},
	src: {
		html: 'src/*.html',
		js: 'src/js/main.js',
		style: 'src/style/*.less',
		img: 'src/img/**/*.*', 
		fonts: 'src/fonts/**/*.*'
	},
	watch: {
		html: 'src/**/*.html',
		js: 'src/js/**/*.js',
		style: 'src/style/**/*.less',
		img: 'src/img/**/*.*',
		fonts: 'src/fonts/**/*.*'
	},
	clean: './build'
};


gulp.task('html:build', function () {
	return gulp.src(path.src.html)
		.pipe(rigger())
		.pipe(gulp.dest(path.build.html));
		// .pipe(reload({stream: true}));
});

gulp.task('style:build', function () {
	 return gulp.src(path.src.style)
		.pipe(prefixer()) //Добавим вендорные префиксы
		.pipe(sourcemaps.init()) //То же самое что и с js
    .pipe(less())
		.pipe(cssmin()) //Сожмем
		.pipe(sourcemaps.write())
    .pipe(gulp.dest(path.build.css));

	// gulp.src(path.src.style) //Выберем наш main.scss
	// 	.pipe(prefixer()) //Добавим вендорные префиксы
	// 	.pipe(sourcemaps.init()) //То же самое что и с js
	// 	.pipe(sass()) //Скомпилируем
	// 	.pipe(cssmin()) //Сожмем
	// 	.pipe(sourcemaps.write())
	// 	.pipe(gulp.dest(path.build.css)); //И в build
		// .pipe(reload({stream: true}));
});

gulp.task('watch', function(){
	watch([path.watch.html], function(event, cb) {
			gulp.start('html:build');
	});
	watch([path.watch.style], function(event, cb) {
	    gulp.start('style:build');
	});
	// watch([path.watch.js], function(event, cb) {
	//     gulp.start('js:build');
	// });
	// watch([path.watch.img], function(event, cb) {
	//     gulp.start('image:build');
	// });
	// watch([path.watch.fonts], function(event, cb) {
	//     gulp.start('fonts:build');
	// });
});