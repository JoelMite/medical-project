import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import path from 'path';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: [
                //'resources/sass/app.scss',
                'resources/js/app.js',

                'resources/assets/css/app.min.css',
                'resources/assets/bundles/bootstrap-social/bootstrap-social.css',
                'resources/assets/css/custom.css',
                'resources/assets/css/style.css',
                'resources/assets/css/components.css',
                

                'resources/assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css',
                'resources/assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css',
                'resources/assets/bundles/summernote/summernote-bs4.css',

                'resources/assets/bundles/datatables/datatables.min.css',
                'resources/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',

                'resources/assets/bundles/select2/dist/css/select2.min.css',

                // 'resources/assets/bundles/jquery-selectric/selectric.css',

                'resources/assets/bundles/pretty-checkbox/pretty-checkbox.min.css',

                'resources/assets/bundles/izitoast/css/iziToast.min.css',

                'resources/assets/bundles/bootstrap-daterangepicker/daterangepicker.css',

                'resources/assets/js/app.min.js',
                'resources/assets/js/scripts.js',
                'resources/assets/js/custom.js',

                'resources/assets/bundles/chartjs/chart.min.js',
                'resources/assets/bundles/owlcarousel2/dist/owl.carousel.min.js',
                'resources/assets/bundles/summernote/summernote-bs4.js',
                'resources/assets/js/page/widget-data.js',

                'resources/assets/bundles/jquery-ui/jquery-ui.min.js',
                'resources/assets/bundles/datatables/datatables.min.js',
                'resources/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'resources/assets/js/page/datatables.js',

                'resources/assets/bundles/select2/dist/js/select2.full.min.js',

                // 'resources/assets/bundles/jquery-selectric/jquery.selectric.min.js',

            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            //'~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    },
});
