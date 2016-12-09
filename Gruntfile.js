"use strict";

module.exports = function ( grunt )
{
    grunt.initConfig( {
        pkg: grunt.file.readJSON( "package.json" ),
        copy: {
            dist: {
                files: [ {
                    src: "node_modules/jquery/dist/jquery.min.js",
                    dest: "public/js/jquery.min.js"
                },
                {
                    src: "node_modules/bootstrap/dist/js/bootstrap.min.js",
                    dest: "public/js/bootstrap.min.js"
                } ]
            },
            dev: {
                files: [ {
                    src: "node_modules/jquery/dist/jquery.js",
                    dest: "public/js/jquery.js"
                },
                {
                    src: "node_modules/bootstrap/dist/js/bootstrap.js",
                    dest: "public/js/bootstrap.js"
                }]
            }
        },
        less: {
            dist: {
                options: {
                    paths: [
                        "public/css"
                    ],
                    compress: true
                },
                files: [ {
                    src: [ "resources/less/main.less" ],
                    dest: "public/css/main.min.css",
                } ]
            },
            dev: {
                options: {
                    paths: [
                        "public/css"
                    ],
                    compress: false
                },
                files: [ {
                    src: [ "resources/less/main.less" ],
                    dest: "public/css/main.css",
                } ]
            }
        },
        watch: {
            less: {
                files: [ "resources/less/*.less" ],
                tasks: [ "less" ]
            },
        }
    } );

    grunt.loadNpmTasks( "grunt-contrib-less" );
    grunt.loadNpmTasks( "grunt-contrib-copy" );
    grunt.loadNpmTasks( "grunt-contrib-watch" );

    grunt.registerTask( "default", [ "less", "copy", "watch" ] );
};
