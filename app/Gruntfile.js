// The wrapper function
'use strict';
module.exports = function(grunt) {

    // Project and task configuration
    grunt.initConfig({
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'assets/js/app.js',
                'assets/js/jquery-crud.js',
                'assets/js/jquery-selectchange.js',
                '!assets/js/app.min.js'
            ]
        },
        less: {
            development: {
                files: {
                    "assets/css/main.css": "less/main.less"
                }
            },
            production: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "assets/css/main.min.css": "less/main.less"
                }
            }
        },
        uglify: {
            production: {
                files: {
                    'assets/js/app.min.js': [
                        // 'assets/js/bootstrap/affix.js',
                        'assets/js/bootstrap/alert.js',
                        // 'assets/js/bootstrap/button.js',
                        // 'assets/js/bootstrap/carousel.js',
                        'assets/js/bootstrap/collapse.js',
                        'assets/js/bootstrap/dropdown.js',
                        'assets/js/bootstrap/modal.js',
                        // 'assets/js/bootstrap/popover.js',
                        // 'assets/js/bootstrap/scrollspy.js',
                        // 'assets/js/bootstrap/tab.js',
                        // 'assets/js/bootstrap/tooltip.js',
                        'assets/js/bootstrap/transition.js',
                        'assets/js/jquery-crud.js',
                        'assets/js/jquery-selectchange.js',
                        'assets/js/app.js'
                    ],
                    'assets/js/jquery-form-3.50.0.min.js': [
                        'assets/js/jquery-form-3.50.0.js'
                    ],
                },
                options: {
                }
            }
        },
        watch: {
            less: {
                files: [
                    'less/*.less',
                    'less/app/*.less',
                ],
                tasks: ['less']
            },
            js: {
                files: [
                    '<%= jshint.all %>'
                ],
                tasks: ['jshint', 'uglify']
            },
            livereload: {
                // Browser live reloading
                // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
                options: {
                    livereload: false
                },
                files: [
                    'assets/css/main.min.css',
                    'assets/js/app.min.js'
                ]
            }
        },
        clean: {
            production: [
                'assets/css/main.css',
                'assets/css/main.min.css',
                'assets/js/app.min.js'
            ]
        }
    });

    // Load plugins
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Define tasks
    grunt.registerTask('default', [
        'clean',
        'less',
        'uglify'
    ]);
    grunt.registerTask('development', [
        'watch'
    ]);

};