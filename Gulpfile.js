var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function() {
    gulp.src('./assets/src/sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/dist/css/'))
        //.pipe(gulp.dest('../../../web/assets/css'))
});

//Watch task
gulp.task('default',function() {
    gulp.watch('./assets/src/sass/**/*.scss',['styles']);
});

gulp.task('build', ['styles']);