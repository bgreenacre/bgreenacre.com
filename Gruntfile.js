"use strict";

module.exports = function ( grunt )
{
    grunt.initConfig( {
        pkg: grunt.file.readJSON( "package.json" ),
        copy: {
            dist: {
                src: "node_modules/jquery/dist/jquery.min.js",
                dest: "public/js/jquery.min.js"
            },
            dev: {
                src: "node_modules/jquery/dist/jquery.js",
                dest: "public/js/jquery.js"
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
