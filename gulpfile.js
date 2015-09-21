/* global __dirname */
var gulp = require('gulp'),
    notify  = require('gulp-notify'),
    phpunit = require('gulp-phpunit'),
    _       = require('lodash'),
    browserSync = require('browser-sync');

var reload  = browserSync.reload;
 
gulp.task('test', function() {
    var options = {debug: false, notify: true, stderr: true};
    gulp.src('phpunit.xml')
        .pipe(phpunit('', options))
        .on('error', notify.onError(notification('fail', 'phpunit')))
        .pipe(notify(notification('pass', 'phpunit')));
});

gulp.task('php', function() {
	console.log(__dirname + '/tests/php.ini');
	return require('gulp-connect-php').server({
		base: './examples', 
		port: 4000, 
		keepalive: true,
		router: 'routes.php'
	});
});
gulp.task('browser-sync', ['php'], function() {
    browserSync({
        proxy: '127.0.0.1:8080',
        port: 4001,
        open: false,
        notify: true
    });
    gulp.watch(['build/*.php'], [reload]);
});
gulp.task('default', ['browser-sync'], function () {
    
});
 
gulp.task('default', function(){
	var path = require('path');
    gulp.watch('./**/*.php')
        .on("change", function(file) {
        	var filename = path.basename(file.path, '.php');
        	console.log(filename + ' has changed. Running tests...');
        	
        	var options = {debug: false, notify: true, stderr: true, filter: '/.*'+filename+'.*/i'};
            gulp.src('phpunit.xml')
                .pipe(phpunit('', options))
                .on('error', notify.onError(notification('fail', 'phpunit')))
                .pipe(notify(notification('pass', 'phpunit')));
        });
});

function notification(status, pluginName, override) {
    var options = {
        title:   ( status == 'pass' ) ? 'Tests Passed' : 'Tests Failed',
        message: ( status == 'pass' ) ? '\n\nAll tests have passed!\n\n' : '\n\nOne or more tests failed...\n\n',
        icon:    __dirname + '/node_modules/gulp-' + pluginName +'/assets/test-' + status + '.png'
    };
    options = _.merge(options, override);
  return options;
}
