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
        'rules' => 'trim|required|min_length[9]|max_length[12]|alpha_numeric|is_unique[players.nif]',
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
        'rules' => 'trim|required|min_length[9]|max_length[12]|alpha_numeric',
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
        'field' => 'description',
        'label' => 'Descripción',
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
    'injuries/update' => $injuries_store_and_update
];

?>