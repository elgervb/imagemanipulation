/* global __dirname */
var gulp = require('gulp'),
    notify      = require('gulp-notify'),
    phpunit     = require('gulp-phpunit'),
    argv        = require('yargs').argv
    _           = require('lodash'),
    browserSync = require('browser-sync');

var reload  = browserSync.reload;

/**
* Start a PHP server. Note that this will require at least PHP 5.4 as it uses the built in server
*/
gulp.task('serve', function() {
	return require('gulp-connect-php').server({
		base: './examples', 
		keepalive: true,
		port: 4000, 
		router: 'routes.php'
	});
});

/**
 * Start a PHP server and connect browser sync to it
 */
gulp.task('start', ['serve'], function() {
    browserSync({
        proxy: '127.0.0.1:4011',
        port: 4010,
        open: false,
        notify: true
    });
    
    gulp.watch(['/**/*.php'], [reload]);
});

/**
 * Run all tests. To run with code coverage, use the --coverage commandline argument
 */
gulp.task('test', function() {
    var options = {debug: false, notify: true, stderr: false};
    
    if (argv.coverage) {
    	options.coverageText = 'php://stdout';
    }
    gulp.src('phpunit.xml')
        .pipe(phpunit('', options))
        .on('error', notify.onError(notification('fail', 'phpunit')))
        .pipe(notify(notification('pass', 'phpunit')));
});

/**
 * Watch sources and tests for changes and run tests
 */
gulp.task('test:watch', function(){
	var path = require('path');
    gulp.watch(['./src/**/*.php', './tests/**/*.php'])
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




gulp.task('php', function() {
	return require('gulp-connect-php').server({
		base: './examples', 
		port: 4000, 
		keepalive: true,
		router: 'routes.php'
	});
});
