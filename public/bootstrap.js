requirejs.config({
    baseUrl: '/',
    deps: ['bootstrap'],
    map: {
        '*': {
            css: '/lib/require-css/0.1.8/css.js'
        }
    },
    paths: {
        text: 'lib/requirejs/plugins/require-text/2.0.12/text',
        jquery: 'lib/jquery/2.2.4/jquery.min',
        bootstrap: 'lib/bootstrap/3.3.5/js/bootstrap'
    },
    shim: {
        'bootstrap': {
            deps: ['jquery', 'css!/lib/bootstrap/3.3.5/css/bootstrap.css'],
            exports: 'bootstrap'
        }
    }
});