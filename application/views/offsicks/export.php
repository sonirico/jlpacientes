<html>
<head>
    <title>Bajas</title>

    <style>
        @page { margin: 100px 25px;}

        header { position: fixed; top: -60px; left: 0px; right: 0px; height: 50px; }
        footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
        div.player { page-break-inside: avoid; }
        /* p:last-child { page-break-after: always; } */

        * {
            font-size: Arial;
        }


        .title {
            font-size: 22px;
            font-weight: bold;
            color: grey;
        }

        .team-label {
            width: 100%;
            background-color: grey;
            color: white;
            padding: 2px;
            font-weight: bold;
            font-size: 20px;
            border-radius: 3px;
        }

        .team-container.active {
            page-break-before: always;
        }

        .team-container.active.team-0 {
            page-break-before: avoid;
        }


        .width-100 {
            width: 100%;
            clear: both;
        }

        .width-50 {
            float: left;
            width: 50%;
        }

        .width-25 {
            float: left;
            width: 25%;
        }

        .label {
            color: grey;
            font-size: 11px;
            font-weight: bold;
        }

        .diagnosis {
            background-color: #eee;
            border-radius: 3px;
            padding: 5px;
        }

        .separator {
            border-color: #888;
            border-bottom: 1px solid #777;
            margin-top: 10px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
    <body>

        <header class="width-100" >
            <p class="title width-50 text-left" >Listado de lesiones</p>
            <p class="width-50 text-right" >a <?php echo date('d/m/Y H:i:s'); ?></p>
        </header>


        <?php

            function days_delta ($then) {
                $now = new DateTime(date("Y-m-d H:i:s"));
                $past = new DateTime($then);

                $interval = $now->diff($past);

                return $interval->d;
            }

            $ci =& get_instance();

            $ci->load->model('team');
            $ci->load->model('player');
            $ci->load->model('offsick');
            $ci->load->model('injury');

            $ci->db->order_by('name', 'asc');
            $query = $ci->db->get('teams');

            $stages = config_item('stages');
            $teams = $query->result_array();
            $players_injured = 0;
            $teams_counter = 0;
            $team_pagination_active = intval($ci->input->get('team_pagination'));

            foreach ($teams as $t)
            {
                $team_id = $t['id'];


                if ($ci->team->has_offsick_players($team_id))
                {
                    ?>


                    <div class="team-container <?php echo $team_pagination_active ? 'active' : ''; ?>
                        <?php echo 'team-' . $teams_counter; ?>" >

                    <div class="width-100 team-label" >
                        Equipo: <?php echo $t['name']; ?>
                    </div>

                    <?php

                    foreach ($ci->team->offsick_players($team_id) as $p)
                    {
                        $players_injured++;
                        $p_id = $p['id'];
                        $o = $ci->player->get_offsick($p_id);
                        $o_id = $o['id'];
                        $i = $ci->offsick->get_injury($o_id);

                        ?>

                        <div class="player" >
                            <div class="width-100" >
                                <div class="width-25" >
                                    <p class="label">Jugador</p>
                                    <?php echo $p['name'] . ' ' . $p['surname']; ?>
                                </div>
                                <div class="width-25" >
                                    <p class="label">Fecha de la lesión</p>
                                    <?php if ($i): ?>
                                        <?php echo date("Y-m-d", intval($i['happened_at'])); ?>
                                    <?php else: ?>
                                        <i>Sin lesión asociada</i>
                                    <?php endif;?>
                                </div>
                                <div class="width-25" >
                                    <p class="label">Fecha de la baja: </p>
                                    <?php echo $o['created_at']; ?>
                                </div>
                                <div class="width-25" >
                                    <p class="label">Días de baja: </p>
                                    <?php echo days_delta($o['created_at']); ?>
                                </div>
                                <div style="width: 100%; clear: both;" >&nbsp;</div>
                            </div>

                            <div class="width-100" >
                                <div class="width-50" >
                                    <p class="label">Fase actual:</p>
                                    <?php echo $stages[$o['current_stage']]; ?>
                                </div>
                                <div class="width-50" >
                                    <p class="label">Duración aproximada alta médica (días):</p>
                                    <?php if ($i): ?>
                                        <?php
                                            $days = intval($i['days_off']);
                                            echo ($days > 0 ? $days : 'N/A');
                                        ?>
                                    <?php else: ?>
                                        <i>Sin lesión asociada</i>
                                    <?php endif;?>
                                </div>
                            </div>

                            <div class="width-100" >
                                <p class="label">Diagnóstico:</p>

                                <div class="diagnosis" >
                                    <?php if ($i): ?>
                                        <?=$i['description'];?>
                                    <?php else: ?>
                                        <i>Sin lesión asociada</i>
                                    <?php endif;?>
                                </div>
                            </div>

                            <div class="separator"  ></div>
                        </div>

                        <?php

                        $teams_counter++;
                    }

                    ?>

                    </div>

                    <?php
                } // End if has_offsicks->players
            }

            if ($players_injured < 1)
            {
                ?>

                No hay jugadores de baja.

                <?php
            }

        ?>

    </body>
</html>