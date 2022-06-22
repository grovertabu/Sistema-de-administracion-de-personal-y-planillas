<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'Elapas |',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>ELAPAS</b> RRHH',
    'logo_img' => 'vendor/adminlte/dist/img/elapas-logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Elapas',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-danger',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'rounded-6 card-outline card-info',
    'classes_auth_header' => 'd-none',
    'classes_auth_body' => 'rounded-6 my-4',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-info',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-info',
    'classes_sidebar_nav' => 'nav-child-indent nav-compact text-sm',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => '',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'inicio',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => 'Inicio',
            'route'  => 'dash',
            'icon' => 'fa fa-home',
        ],
        // ***********ROL ADMIN****************
        [
            'header' => 'GESTION USUARIOS',
            'can' => 'users.index',
        ],
        [
            'text' => 'Lista Usuarios',
            'route'  => 'users.index',
            'icon' => 'fa fa-users',
            'can' => 'users.index',
        ],
        // *****************************
        // ********ROL RRHH*************
        [
            'header' => 'GESTION PERSONAL',
            'can' => 'rrhh_grover',
        ],
        [
            'text' => 'Trabajadores',
            'route'  => 'trabajador.index',
            'icon' => 'fas fa-users-cog',
            'can' => 'rrhh_grover',
        ],
        [
            'text'    => 'Personal',
            'icon'    => 'fas fa-folder',
            'submenu' => [
                [
                    'text' => 'Asignación de Items',
                    'route'  => 'items.lista',
                    'icon' => 'fas fa-folder-open',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Asignación de Consultores',
                    'route'  => 'consultores.lista',
                    'icon' => 'fas fa-folder-open',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Asignación de Eventuales',
                    'route'  => 'eventuales.lista',
                    'icon' => 'fas fa-folder-open',
                    'can' => 'rrhh_grover',
                ],
            ],
            'id' => 'menuPersonal',
            'can' => 'rrhh_grover',
        ],
        [
            'text' => 'Nomina de Cargos',
            'route'  => 'nomina_cargo.index',
            'icon' => 'fas fa-clipboard',
            'can' => 'rrhh_grover',
        ],
        [
            'text'    => 'Configuraciones para Cargos',
            'icon'    => 'fas fa-cogs',
            'submenu' => [
                [
                    'text' => 'Estructura Organizacional',
                    'route'  => 'estruct_org.index',
                    'icon' => 'fas fa-folder',
                    'can' => 'rrhh_grover',
                    'active' => [
                        'estructuras-organizacionales',
                        'estructuras-organizacionales/create'
                    ],
                ],
                [
                    'text' => 'Escalas Salariales',
                    'route'  => 'escala_salarial.index',
                    'icon' => 'fas fa-clipboard',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Unidades Organizacionales',
                    'route'  => 'unidad_organizacional.index',
                    'icon' => 'fas fa-sitemap',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Cargos',
                    'route'  => 'cargo.index',
                    'icon' => 'fas fa-briefcase',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Tipo de Contrato',
                    'route'  => 'tipo_contrato.index',
                    'icon' => 'fas fa-briefcase',
                    'can' => 'rrhh_grover',
                ],

            ],

            'can' => 'rrhh_grover',
            // 'topnav_right'=>true
        ],
        // Configuraciones para la generacion de Planillas
        [
            'text'    => 'Configuraciones para Planillas',
            'icon'    => 'fas fa-cogs',
            'submenu' => [
                [
                    'text' => 'Configuración Aportes',
                    'route'  => 'conf_aporte.index',
                    'icon' => 'fas fa-cog',
                    'can' => 'rrhh_grover',
                    // 'shift' =>'ml-4' ,
                    'active' => [
                        'configuracion-aporte',
                        'configuracion-aporte/create'
                    ],
                ],
                [
                    'text' => 'Configuración Otros Descuentos',
                    'route'  => 'conf_otro_descuento.index',
                    'icon' => 'fas fa-cog',
                    'can' => 'rrhh_grover',
                    'active' => [
                        'configuracion-otro-descuento',
                        'configuracion-otro-descuento/create'
                    ],
                ],
                [
                    'text' => 'Configuración Impositiva',
                    'route'  => 'conf_impositiva.index',
                    'icon' => 'fas fa-cog',
                    'can' => 'rrhh_grover',
                    // 'shift' =>'ml-4' ,
                    'active' => [
                        'configuracion-impositiva',
                        'configuracion-impositiva/create'
                    ],
                ],
                [
                    'text' => 'Configuración Bono Antiguedad',
                    'route'  => 'conf_bono_antiguedad.index',
                    'icon' => 'fas fa-cog',
                    'can' => 'rrhh_grover',
                    // 'shift' =>'ml-4' ,
                    'active' => [
                        'configuracion-bono-antiguedad',
                        'configuracion-bono-antiguedad/create'
                    ],
                ],
                [
                    'text' => 'Configuración Horas Extras',
                    'route'  => 'conf_horas_extra.index',
                    'icon' => 'fas fa-cog',
                    'can' => 'rrhh_grover',
                    'active' => [
                        'configuracion-hora-extra',
                        'configuracion-hora-extra/create'
                    ],
                ],

            ],

            'can' => 'rrhh_grover',
            'topnav_right' => true
        ],
        // Configuraciones para la generacion de Planillas
        [
            'text'    => 'Planillas',
            'icon'    => 'fas fa-briefcase',
            'submenu' => [
                [
                    'text' => 'Planilla Asistencias',
                    'route'  => 'asistencia.consulta',
                    'icon' => 'fas fa-clipboard',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Planilla Bonos de Antiguedad',
                    'route'  => 'bono_antiguedad.consulta',
                    'icon' => 'fas fa-clipboard',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Planilla Horas Extras',
                    'route'  => 'horas_extra.consulta',
                    'icon' => 'fas fa-clipboard',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Planilla Suplencias',
                    'route'  => 'suplencia.consulta',
                    'icon' => 'fas fa-clipboard',
                    'can' => 'rrhh_grover',
                ],
                [
                    'text' => 'Planilla Total Ganado',
                    'route'  => 'total_ganado.consulta',
                    'icon' => 'fas fa-clipboard',
                    'can' => 'rrhh_grover',
                ],
            ],

            'can' => 'rrhh_grover',
        ],
        // ***********************************************
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                // ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/select/js/dataTables.select.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/select/css/select.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.css',
                ],
            ],
        ],
        'Pace' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/pace/blue/pace-theme-flash.css',
                    // 'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/pace/pace.min.js',
                    // 'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'jquery-validation' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/jquery-validation/jquery.validate.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/jquery-validation/additional-methods.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/jquery-validation/localization/messages_es.js',
                ],
            ],
        ],
        [
            'name' => 'AdminLTE-Components-DG',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/bs-custom-file-input/bs-custom-file-input.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/moment/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/moment/moment-with-locales.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/bs-select/css/bootstrap-select.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/dg-plugins/bs-select/js/bootstrap-select.min.js',
                ],
                // [
                //     'type' => 'css',
                //     'asset' => true,
                //     'location' => '/vendor/dg-plugins/bootstrap-tags-input/bootstrap-tagsinput.css',
                // ],
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => '/vendor/dg-plugins/bootstrap-tags-input/bootstrap-tagsinput.js',
                // ],
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => '/vendor/dg-plugins/daterangepicker/daterangepicker.js',
                // ],
                // [
                //     'type' => 'css',
                //     'asset' => true,
                //     'location' => '/vendor/dg-plugins/daterangepicker/daterangepicker.css',
                // ],
                // [
                //     'type' => 'css',
                //     'asset' => true,
                //     'location' => '/vendor/dg-plugins/bootstrap-slider/css/bootstrap-slider.min.css',
                // ],
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => '/vendor/dg-plugins/bootstrap-slider/js/bootstrap-slider.min.js',
                // ],
            ],
        ],
        'toastr' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.css',
                ],
            ],
        ],
        'inputmask' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/inputmask/min/jquery.inputmask.bundle.min.js',
                ],
            ],
        ],
        'funciones' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/funciones/funciones.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/funciones/estilos.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => false,
];
