<?php

namespace Config\Menu;

class Menu_admin
{
    const Gestion_USUARIOS =
        [
            'header' => 'GESTION USUARIOS',
            'can' => 'users.index',
        ];
    const usuarios = [
        'text' => 'Lista Usuarios',
        'route'  => 'users.index',
        'icon' => 'fa fa-users',
        'can' => 'users.index',
    ];
}
