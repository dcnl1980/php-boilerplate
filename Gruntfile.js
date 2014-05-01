module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    coffee: {
      release: {
        expand: true,
        flatten: true,
        cwd: 'public/coffee',
        src: ['*.coffee'],
        dest: 'public/js',
        ext: '.js'
      }
    },
    sass: {
      testing: {
        files: [{
          expand: true,
          cwd: 'public/scss',
          src: ['*.scss'],
          dest: 'public/css',
          ext: '.css'
        }]
      },
      release: {
        files: [{
          expand: true,
          cwd: 'public/scss',
          src: ['*.scss'],
          dest: 'public/css',
          ext: '.css',
          style: 'compressed'
        }]
      }
    },
    cssmin: {
      minify: {
        expand: true,
        cwd: 'public/css/',
        src: ['*.css', '!*.min.css'],
        dest: 'public/css/',
        ext: '.min.css'
      }
    },
    watch: {
      testing: {
        files: ['public/coffee/*', 'public/scss/*'],
        tasks: ['coffee', 'sass:testing']
      },
      release: {
        files: ['public/coffee/*', 'public/scss/*'],
        tasks: ['coffee', 'sass:release', 'cssmin:minify']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');

  grunt.registerTask('minimized', ['watch:release']);
  grunt.registerTask('default', ['watch:testing']);

};