<?php defined('BASEPATH') OR exit('No direct script access allowed');


$stages = [
    1 => 'Fase 1: Orientación, aproximación médica fisioterapia',
    2 => 'Fase 2: Fisioterapia, gimnasio, readaptación',
    3 => 'Fase 3: Readptación parcial con el equipo, fisioterapia y gimnasio',
    4 => 'Fase 4: Readaptación equipo, fisioterapia'
];

$teams = [
    1 => 'Maj.A',
    2 => 'Juv.A',
    3 => 'Juv.B',
    4 => 'Juv.C',
    5 => 'Cad.A',
    6 => 'Cad.B',
    7 => 'Cad.C',
    8 => 'Cad.D',
    9 => 'Cad.E',
    10 => 'Cad.F',
    11 => 'Inf.A',
    12 => 'Inf.A',
    13 => 'Inf.B',
    14 => 'Inf.C',
    15 => 'Inf.D',
    16 => 'Inf.E',
    17 => 'Alevin.A',
    18 => 'Alevin.B',
    19 => 'Alevin.C',
    20 => 'Alevin.D',
    21 => 'Alevin.E',
    22 => 'Benjamin.A',
    23 => 'Benjamin.B',
    24 => 'Benjamin.C'
];

$injuries = [
    1 => 'Musculotendinosa',
    2 => 'Articular',
    3 => 'Óseas',
    4 => 'Enfermedad',
    5 => 'Otros'
];

$positions = [
    1 => 'Portero',
    2 => 'Defensa',
    3 => 'Lat.Izq',
    4 => 'Lat.Der',
    5 => 'Mediocentro',
    6 => 'Extremo Der',
    7 => 'Extremo Izq',
    8 => 'Media Punta',
    9 => 'Delantero'
];

$config['stages'] = $stages;
$config['positions'] = $positions;
$config['injuries'] = $injuries;
$config['teams'] = $teams;
$config['folds'] = range(1, 6);

$config['algo'] = PASSWORD_BCRYPT;