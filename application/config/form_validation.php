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

$config = [
    'teams/store' => $teams_store_and_update,
    'teams/update' => $teams_store_and_update
];

?>