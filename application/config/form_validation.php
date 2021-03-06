<?php

$teams_store_and_update = [
    [
        'field' => 'name',
        'label' => 'nombre del equipo',
        'rules' => 'trim|required|min_length[5]|max_length[255]',
        'errors' => [
            'required' => 'El campo "nombre de equipo" es obligatorio',
            'min_length' => 'El campo "nombre de equipo" es demasiado corto',
            'max_length' => 'El campo "nombre de equipo" es demasiado largo'
        ]
    ]
];

$players_store = [
    [
        'field' => 'name',
        'label' => 'Nombre',
        'rules' => 'trim|required|min_length[2]|max_length[255]',
        'errors' => [
            'required' => 'El campo "Nombre" es obligatorio',
            'min_length' => 'El campo "Nombre" es demasiado corto',
            'max_length' => 'El campo "Nombre" es demasiado largo'
        ]
    ],
    [
        'field' => 'surname',
        'label' => 'Apellidos',
        'rules' => 'trim|required|min_length[2]|max_length[255]',
        'errors' => [
            'required' => 'El campo "Apellidos" es obligatorio',
            'min_length' => 'El campo "Apellidos" es demasiado corto',
            'max_length' => 'El campo "Apellidos" es demasiado largo'
        ]
    ],
    [
        'field' => 'nif',
        'label' => 'NIF',
        'rules' => 'trim|min_length[9]|max_length[12]|alpha_numeric|is_unique[players.nif]',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'is_unique' => 'Ya existe un jugador con el %s especificado',
            'min_length' => 'El campo "%s" es demasiado corto',
            'max_length' => 'El campo "%s" es demasiado largo',
            'alpha_numeric' => 'El campo "%s" sólo puede contener números y letras'
        ]
    ],
    [
        'field' => 'birthday',
        'label' => 'Fecha de nacimiento',
        'rules' => 'trim|required|exact_length[10]|callback_birthday_check',
        'errors' => [
            'required' => 'El campo "Fecha de nacimiento" es obligatorio',
            'min_length' => 'El campo "Fecha de nacimiento" tiene un formato incorrecto'
        ]
    ],
    [
        'field' => 'team',
        'label' => 'Equipo',
        'rules' => 'trim|required|is_natural_no_zero|callback_team_check',
        'errors' => [
            'required' => 'El campo "Equipo" es obligatorio',
            'is_natural_no_zero' => 'El campo "Equipo" es obligatorio'
        ]
    ]
];


$players_update = [
    [
        'field' => 'name',
        'label' => 'Nombre',
        'rules' => 'trim|required|min_length[2]|max_length[255]',
        'errors' => [
            'required' => 'El campo "Nombre" es obligatorio',
            'min_length' => 'El campo "Nombre" es demasiado corto',
            'max_length' => 'El campo "Nombre" es demasiado largo'
        ]
    ],
    [
        'field' => 'surname',
        'label' => 'Apellidos',
        'rules' => 'trim|required|min_length[2]|max_length[255]',
        'errors' => [
            'required' => 'El campo "Apellidos" es obligatorio',
            'min_length' => 'El campo "Apellidos" es demasiado corto',
            'max_length' => 'El campo "Apellidos" es demasiado largo'
        ]
    ],
    [
        'field' => 'nif',
        'label' => 'NIF',
        'rules' => 'trim|min_length[9]|max_length[12]|alpha_numeric',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'is_unique' => 'Ya existe un jugador con el %s especificado',
            'min_length' => 'El campo "%s" es demasiado corto',
            'max_length' => 'El campo "%s" es demasiado largo',
            'alpha_numeric' => 'El campo "%s" sólo puede contener números y letras'
        ]
    ],
    [
        'field' => 'birthday',
        'label' => 'Fecha de nacimiento',
        'rules' => 'trim|required|exact_length[10]|callback_birthday_check',
        'errors' => [
            'required' => 'El campo "Fecha de nacimiento" es obligatorio',
            'min_length' => 'El campo "Fecha de nacimiento" tiene un formato incorrecto'
        ]
    ],
    [
        'field' => 'team',
        'label' => 'Equipo',
        'rules' => 'trim|required|is_natural_no_zero|callback_team_check',
        'errors' => [
            'required' => 'El campo "Equipo" es obligatorio',
            'is_natural_no_zero' => 'El campo "Equipo" es obligatorio'
        ]
    ]
];


$injuries_store_and_update = [
    [
        'field' => 'type',
        'label' => 'Tipo de lesión',
        'rules' => 'trim|required|is_natural_no_zero',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'cause',
        'label' => 'Causa de lesión',
        'rules' => 'trim|required|is_natural_no_zero',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'circumstance',
        'label' => 'Circunstancia de lesión',
        'rules' => 'trim|required|is_natural_no_zero',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'happened_at',
        'label' => 'Fecha de lesión',
        'rules' => 'trim|required|callback_happened_at_check',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
        ]
    ],
    [
        'field' => 'days_off',
        'label' => 'Días estimados de recuperación',
        'rules' => 'numeric',
        'errors' => [
            'numeric' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'procedures',
        'label' => 'Intervenciones',
        'rules' => 'numeric|greater_than_equal_to[0]|less_than_equal_to[99]',
        'errors' => [
            'numeric' => 'El campo "%s" es obligatorio',
            'greater_than_equal_to' => 'El campo "%s" debe ser positivo',
            'less_than_equal_to' => 'El campo "%s" debe ser menor que 100',
        ]
    ],
    [
        'field' => 'description',
        'label' => 'Descripción',
        'rules' => 'trim|max_length[99999]',
        'errors' => [
            'max_length' => 'El campo "%s" es demasiado largo'
        ]
    ]
];

$login = [
    [
        'field' => 'username',
        'label' => 'Email/Nickname',
        'rules' => 'trim|required|max_length[255]',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'max_length' => 'El campo "%s" es demasiado largo'
        ]
    ],
    [
        'field' => 'password',
        'label' => 'Contraseña',
        'rules' => 'trim|required|callback_check_login',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio'
        ]
    ]
];

$password_reset = [
    [
        'field' => 'current_password',
        'label' => 'Contraseña actual',
        'rules' => 'trim|required|callback_check_current_password',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'new_password',
        'label' => 'Nueva contraseña',
        'rules' => 'trim|required',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'password_confirmation',
        'label' => 'Confirmación contraseña',
        'rules' => 'trim|required|matches[new_password]',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'matches' => 'Las contraseñas no coindicen!'
        ]
    ]
];


$nutrition_store_and_update = [
    [
        'field' => 'diet_keen',
        'label' => 'Cumple dieta',
        'rules' => 'trim|required|in_list[0,1]',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'in_list' => 'El campo "%s" es incorrecto'
        ]
    ],
    [
        'field' => 'imc',
        'label' => 'IMC',
        'rules' => 'trim|required|min_length[2]|max_length[255]',
        'errors' => [
            'required' => 'El campo "Apellidos" es obligatorio',
            'min_length' => 'El campo "Apellidos" es demasiado corto',
            'max_length' => 'El campo "Apellidos" es demasiado largo'
        ]
    ],
    [
        'field' => 'hip_waist_perimeter',
        'label' => 'P. Cintura-cadera',
        'rules' => 'trim|required|is_natural_no_zero',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'is_natural_no_zero' => 'El campo "%s" es incorrecto'
        ]
    ],
    [
        'field' => 'height',
        'label' => 'Altura',
        'rules' => 'trim|required|is_natural_no_zero',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'is_natural_no_zero' => 'El campo "%s" tiene un formato incorrecto'
        ]
    ],
    [
        'field' => 'weight',
        'label' => 'Masa',
        'rules' => 'trim|required|is_natural_no_zero',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'is_natural_no_zero' => 'El campo "%s" es obligatorio'
        ]
    ],
    [
        'field' => 'folds',
        'label' => 'Pliegues',
        'rules' => 'trim|required|is_natural',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
            'is_natural' => 'El campo "%s" es incorrecto'
        ]
    ]
];

$phsessions_create_or_update = [
    [
        'field' => 'happened_at',
        'label' => 'Fecha de sesión',
        'rules' => 'trim|required|callback_happened_at_check',
        'errors' => [
            'required' => 'El campo "%s" es obligatorio',
        ]
    ],
    [
        'field' => 'comments',
        'label' => 'Comentarios',
        'rules' => 'trim|max_length[99999]',
        'errors' => [
            'max_length' => 'El campo "%s" es demasiado largo'
        ]
    ]
];


$config = [
    'teams/store' => $teams_store_and_update,
    'teams/update' => $teams_store_and_update,

    'players/store' => $players_store,
    'players/update' => $players_update,

    'injuries/store' => $injuries_store_and_update,
    'injuries/update' => $injuries_store_and_update,

    'nutrition/update_store' => $nutrition_store_and_update,
    'phsessions/create_or_update' => $phsessions_create_or_update,

    'login' => $login,
    'password_reset' => $password_reset
];

?>