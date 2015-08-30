var gulp = require('gulp'),
    notify  = require('gulp-notify'),
    phpunit = require('gulp-phpunit')
    _       = require('lodash');
 
gulp.task('phpunit', function() {
    var options = {debug: false, notify: true, stderr: true};
    gulp.src('phpunit.xml')
        .pipe(phpunit('', options))
        .on('error', notify.onError(notification('fail', 'phpunit')))
        .pipe(notify(notification('pass', 'phpunit')));
});
 
gulp.task('default', ['phpunit'], function(){
    gulp.watch('./**/*.php', function(file){
        gulp.start('phpunit');
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
