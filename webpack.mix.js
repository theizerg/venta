const mix = require('laravel-mix');




/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.styles([
    'node_modules/admin-lte/dist/css/adminlte.css',
    'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.css',
    'node_modules/admin-lte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
    'node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    'node_modules/admin-lte/plugins/select2/css/select2.min.css',
    'node_modules/admin-lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
    'node_modules/admin-lte/plugins/bs-stepper/css/bs-stepper.min.css',
    'node_modules/admin-lte/plugins/dropzone/min/dropzone.min.css',
    'node_modules/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
    'node_modules/otika/assets/bundles/jquery-selectric/selectric.css',
	'node_modules/otika/assets/bundles/ionicons/css/ionicons.min.css',
	'node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
	'node_modules/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
	'node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
    ], 'public/css/app.css');


mix.scripts([
    'node_modules/admin-lte/plugins/jquery/jquery.min.js',
    'node_modules/admin-lte/dist/js/demo.js',
    'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'node_modules/admin-lte/plugins/select2/js/select2.full.min.js',
    'node_modules/admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
    'node_modules/admin-lte/plugins/moment/moment.min.js',
    'node_modules/admin-lte/plugins/inputmask/jquery.inputmask.min.js',
    'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
    'node_modules/admin-lte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
    'node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    'node_modules/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'node_modules/admin-lte/plugins/bs-stepper/js/bs-stepper.min.js',
    'node_modules/admin-lte/plugins/dropzone/min/dropzone.min.js',
    'node_modules/admin-lte/dist/js/adminlte.js',
    'public/plugins/c3/d3.js',
    'public/plugins/c3/c3.js',
    'node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js',
    'node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
    'node_modules/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js',
    'node_modules/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
    'node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
    'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
    'node_modules/admin-lte/plugins/jszip/jszip.min.js',
    'node_modules/admin-lte/plugins/pdfmake/pdfmake.min.js',
    'node_modules/admin-lte/plugins/pdfmake/vfs_fonts.js',
    'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js',
    'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.print.min.js',
    'node_modules/admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js',
    'node_modules/otika/assets/bundles/apexcharts/apexcharts.min.js',
	'node_modules/otika/assets/bundles/jquery-validation/dist/jquery.validate.min.js',
	'node_modules/otika/assets/bundles/amcharts4/core.js',
	'node_modules/otika/assets/bundles/amcharts4/charts.js',
	'node_modules/otika/assets/bundles/amcharts4/animated.js',
	'node_modules/otika/assets/bundles/amcharts4/worldLow.js',
	'node_modules/otika/assets/bundles/amcharts4/maps.js',
	'node_modules/otika/assets/bundles/echart/echarts.js',
	'node_modules/otika/assets/bundles/chartjs/chart.min.js',
	'node_modules/otika/assets/js/page/ion-icons.js',


	

], 'public/js/app.js');

 mix.js('resources/js/app.js', 'public/js/some.js');
 mix.sass('resources/sass/app.scss', 'public/css/some.css');