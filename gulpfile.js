'use strict';

var gulp = require('gulp'),
		watch = require('gulp-watch'),
		sourcemaps = require('gulp-sourcemaps'),
		cssmin = require('gulp-minify-css'),
		uglify = require('gulp-uglify'),
		prefixer = require('gulp-autoprefixer'),
		fileinclude = require('gulp-file-include'),
		less = require('gulp-less');

var path = {
	build: {
		html: 'build/',
		js: 'build/js/',
		css: 'build/css/'
	},
	src: {
		html: 'src/*.html',
		js: 'src/js/main.js',
		style: 'src/style/*.less'
	},
	watch: {
		html: 'src/**/*.html',
		js: 'src/js/**/*.js',
		style: 'src/style/**/*.less'
	},
	clean: './build'
};


gulp.task('html:build', function () {
	return gulp.src(path.src.html)
		.pipe(fileinclude({
      prefix: '@@',
      basepath: '@file'
    }))
		.pipe(gulp.dest(path.build.html));
});

gulp.task('style:build', function () {
	return gulp.src(path.src.style)
		.pipe(prefixer()) //Добавим вендорные префиксы
		.pipe(sourcemaps.init()) //То же самое что и с js
		.pipe(less())
		.pipe(cssmin()) //Сожмем
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(path.build.css));
});

gulp.task('js:build', function () {
	return gulp.src(path.src.js)
		.pipe(sourcemaps.init()) //То же самое что и с js
		// .pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(path.build.js));
});

gulp.task('watch', function(){
	watch([path.watch.html], function(event, cb) {
			gulp.start('html:build');
	});
	watch([path.watch.style], function(event, cb) {
	    gulp.start('style:build');
	});
	watch([path.watch.js], function(event, cb) {
	    gulp.start('js:build');
	});
});