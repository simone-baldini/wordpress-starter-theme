const gulp = require("gulp");
const gulpif = require("gulp-if");
const uglify = require("gulp-uglify");
const sass = require("gulp-sass");
const browserSync = require("browser-sync");
const browserify = require("browserify");
const tap = require("gulp-tap");
const buffer = require("gulp-buffer");
const flatten = require("gulp-flatten");
const del = require("del");
const clone = require("gulp-clone");
const webp = require("gulp-webp");

const server = browserSync.create();
const config = {
	proxy: "https://simonebaldini.localhost",
	fonts: {
		src: "./assets/fonts/**/*.*",
		dest: "./dist/fonts/",
	},
	images: {
		src: "./assets/images/**/*.*",
		dest: "./dist/images/",
	},
	styles: {
		src: "./assets/styles/**/*.scss",
		dest: "./dist/styles/",
	},
	scripts: {
		src: "./assets/scripts/**/*.js",
		dest: "./dist/scripts/",
	},
};

gulp.task("sass", function () {
	return gulp
		.src(config.styles.src)
		.pipe(sass({ outputStyle: "compressed" }))
		.pipe(gulp.dest(config.styles.dest))
		.pipe(server.stream());
});

gulp.task("js", function () {
	return gulp
		.src(config.scripts.src, { read: false })
		.pipe(
			tap(function (file) {
				file.contents = browserify(file.path, {
					debug: false,
				})
					.transform("babelify", { presets: ["@babel/preset-env"] })
					.bundle();
			})
		)
		.pipe(buffer())
		.pipe(gulpif(true, uglify()))
		.pipe(gulp.dest(config.scripts.dest))
		.pipe(server.stream());
});

gulp.task("fonts", function () {
	return gulp
		.src(config.fonts.src)
		.pipe(flatten())
		.pipe(gulp.dest(config.fonts.dest))
		.pipe(server.stream());
});

gulp.task("images", function () {
	const sink = clone.sink();
	return gulp
		.src(config.images.src)
		.pipe(sink)
		.pipe(webp())
		.pipe(sink.tap())
		.pipe(gulp.dest(config.images.dest))
		.pipe(server.stream());
});

gulp.task(
	"clean",
	del.bind(null, [
		config.images.dest,
		config.fonts.dest,
		config.scripts.dest,
		config.styles.dest,
	])
);

gulp.task(
	"serve",
	gulp.parallel(["sass", "js", "fonts", "images"], function () {
		server.init({
			proxy: config.proxy,
			open: false,
		});

		gulp.watch(config.styles.src, gulp.parallel("sass"));
		gulp.watch(config.scripts.src, gulp.parallel("js"));
		gulp.watch(config.fonts.src, gulp.parallel("fonts"));
		gulp.watch(config.images.src, gulp.parallel("images"));
	})
);

gulp.task("default", gulp.parallel(["clean", "serve"]));