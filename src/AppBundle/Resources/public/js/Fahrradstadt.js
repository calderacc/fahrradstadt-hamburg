var Fahrradstadt = Fahrradstadt || {};

Fahrradstadt.loadModule = function(name, context, options, callback) {
    require([name], function(Module) {
        var module = new Module(context, options);

        if (callback) {
            callback(module);
        }
    });
};

require.config({
    baseUrl: '/bundles/app/js/modules/',
    paths:
    {
        'jquery': '/bundles/app/js/jquery/jquery-3.1.1.min',
        'leaflet': '/bundles/app/js/leaflet/leaflet',
        'leaflet-extramarkers': '/bundles/app/js/extramarkers/extramarkers.min',
        'popper': '/bundles/app/js/popper/popper.min',
        'bootstrap4': '/bundles/app/js/bootstrap/bootstrap.min',
        'jasny-bootstrap': '/bundles/app/js/jasny-bootstrap/jasny-bootstrap.min',
        'jquery-areaselect': '/bundles/app/js/jquery/jquery.areaselect.min',
        'dateformat': '/bundles/app/js/dateformat/dateformat'
    },
    shim: {
        'popper': {
            deps: ['jquery'],
            exports: 'Popper'
        },
        'jasny-bootstrap': {
            deps: ['jquery']
        },
        'leaflet-extramarkers': {
            deps: ['leaflet'],
            exports: 'L.ExtraMarkers'
        }
    }
});

