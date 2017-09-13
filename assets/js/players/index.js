
teams = (function () {

    var teams = [];
    var players = [];

    var tableObj = {};
    var deletionModal = $('#delete-player-modal');
    var offsickModal = $('#offsick-player-modal');

    var loadTable = function (data, reload) {
        var reload = reload || false;

        return new Promise(function (resolve, reject) {

            if (reload) { //d} || !$.isEmptyObject(tableObj)) {
                tableObj.clear();
                tableObj.rows.add(data);
                tableObj.draw();
                return;
            }

            tableObj = $('#players-table').DataTable({
                'scrollX': false,
                'processing': true,
                'deferRender': true,
                'pageLength': 50,
                'lengthMenu': [5, 10, 20, 50],
                'columns': [
                    {
                        'data': 'team',
                        'visible': false,
                        'orderable': true
                    },
                    {
                        'title': 'NIF',
                        'data': 'nif',
                        'className': 'player-nif',
                        'visible': true,
                        'orderable': true
                    },
                    {
                        'title': 'Nombre y apellidos',
                        'data': null,
                        'className': 'player-name',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) {
                                var cont = $('<div>').append(
                                    $('<div>').append(
                                        $('<a>').attr({
                                            'href': '/players/' + row.id + '/show/'
                                        }).text(row.name + ' ' + row.surname)
                                    )
                                );

                                if (Boolean(parseInt(row.offsick))) {
                                    var select = $('<select>').addClass('form-control current-offsick-stage');

                                    Object.keys(stages).forEach(function (id) {
                                        select.append(
                                            $('<option>').val(id).text(stages[id]).attr('selected', id == row.current_stage)
                                        );
                                    });

                                    cont.append($('<div>').append(select));
                                }

                                return cont.html();
                            }

                            return row.name + " " + row.surname;
                        }
                    },
                    {
                        'title': 'Fecha  / Edad',
                        'className': 'player-age',
                        'data': 'birthday',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) {
                                var then = moment.unix(data);
                                var anos = moment().diff(moment.unix(data), 'years');

                                return moment(then).format('DD/MM/Y') + ' | ' + anos + ' años';
                            }

                            return data;
                        }
                    },
                    {
                        'title': 'Equipo',
                        'data': 'team_name',
                        'className': 'player-team',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) {
                                var link = document.createElement('a');

                                link.href = "/teams/" + row.team + "/edit/";
                                link.target = "_blank";
                                link.innerText = data;

                                return link.outerHTML;
                            }

                            return data;
                        }
                    },
                    {
                        'title': 'Posición',
                        'className': 'player-position',
                        'data': 'position',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if (data) {
                                return positions[data] || '-';
                            }

                            return '-- Ninguna --';
                        }
                    },
                    {
                        'title': 'Contacto',
                        'className': 'player-contact',
                        'data': 'contact',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) {
                                var link = document.createElement('a');
                                link.href = "telf:" + data;
                            }

                            return data;
                        }
                    },
                    {
                        'title': 'Dirección',
                        'className': 'player-address',
                        'data': 'address',
                        'visible': true,
                        'orderable': false
                    },
                    {
                        'title': 'Acciones',
                        'data': null,
                        'className': 'player-actions',
                        'visible': true,
                        'orderable': false,
                        'createdCell': function (cell, cellData, rowData, row, col) {
                            var buttons = utils.template('#player-buttons-container');

                            if (Boolean(parseInt(rowData.offsick))) {
                                buttons.find('.btn-offsick').remove();
                            } else {
                                buttons.find('.btn-upsick').remove();
                            }

                            $(cell).html(buttons);
                        }
                    }
                ],
                'data': data,
                'rowCallback': function (row, data, index) {
                    if (Boolean(parseInt(data.offsick))) {
                        $(row).addClass('player-offsick');
                    }
                },
                'initComplete': function () {
                    resolve();
                },
                'drawCallback': function () {
                    resolve();
                },
                language: DT_LANGUAGE_OPTIONS,
            });
        });
    };

    var refreshOffisckState = function (e) {
        var player = tableObj.row($(this).closest('tr')).data();

        $.ajax({
            'url': '/api/players/' + player.id + '/offsick/stage/',
            'method': 'post',
            'data': {
                'csrf_token': $('[name="csrf_token"]').attr('content').trim(),
                'stage': $(this).val()
            }
        }).done(function () {
            alert('ok');
        }).fail(function () {
            alert('fail');
        });
    };

    var loadData = function () {
        return $.ajax({
            'url': '/api/players/',
            'method': 'GET',
            'dataType': 'json'
        });
    };

    var loadFilters = function () {
        var promises = [];

        // Teams
        var loadTeams = function () {
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var team = parseInt(data[0]);
                    var currentTeam = parseInt($('#table-filter-team').val());

                    if (currentTeam < 1) return true;
                    else return currentTeam == team;
                }
            );

            return new Promise(function (resolve, reject) {
                $.ajax({
                    'url': urls.teams,
                    'method': 'get',
                    'dataType': 'json'
                }).done(function (data) {
                    data = data || [];

                    var select = $('<select>')
                        .addClass('form-control table-filter')
                        .attr('id', 'table-filter-team')
                        .append($('<option>').val(0).text('-- Filtrar por equipo --'))
                        .append(data.map(function (team) {
                            return $('<option>').val(team.id).text(team.name)
                        }));

                    $('.dataTables_filter').prepend(select);

                    if (filters.hasOwnProperty('team')) {
                        setTimeout(function () {
                            select.val(filters.team).change();
                        }, 500);
                    }

                    resolve();

                }).fail(function (jqXHR, textStatus) {
                    reject(textStatus);
                })
            });
        };


        promises.push(loadTeams());


        return Promise.all(promises);
    };

    this.init = function () {
        loadData()
        .done(function (data) {
            loadTable(data)
                .then(function (data) {
                    console.log(data);
                    console.log('loaded!');

                    loadFilters().then(function () {
                        this.events();
                    }).catch(function (error) {
                        console.log(error);
                    });



                }).catch(function (err) {
                    console.log(err);
                });
        }).fail(function (textStatus) {
            console.error(textStatus);
        });
    };

    this.reload = function () {
        loadData()
        .done(function (data) {
            loadTable(data, true)
                .then(function (data) {
                    console.log(data);
                    console.log('RE loaded!');
                }).catch(function (err) {
                    console.log(err);
                });
        }).fail(function (jqXHR, textStatus) {
            console.error(textStatus);
        });
    };

    this.events = function () {
        var that = this;
        // DT actions
        tableObj.on('click', '.btn-action', function () {
            var btn = $(this);
            var player = tableObj.row(btn.closest('tr')).data();
            var action = btn.data('action');

            switch (action) {
                case "delete":
                    deletionModal.data('player', player);
                    deletionModal.find('.deletion-player-name').text(player.name);
                    deletionModal.modal('show');
                    break;

                case "edit":
                    window.document.location = "/players/" + player.id + "/edit/";
                    break;

                case "offsick":
                    offsickModal.data('player', player);
                    offsickModal.find('.offsick-player-name').text(player.name);
                    offsickModal.modal('show');
                    break;

                case "upsick":

                    $.ajax({
                        'url': '/api/players/' + player.id + '/upsick/',
                        'method': 'post',
                        'dataType': 'json',
                        'data': {
                            'csrf_token': $('[name="csrf_token"]').attr('content').trim()
                        }
                    }).done(function (data) {
                        that.reload();
                    }).fail(function (jqXHR, textStatus) {
                        that.reload();
                    }).always(function () {
                    });

                    break;
            }
        });

        // Player deletion
        deletionModal.find('.delete-player-button').click(function () {
            $.ajax({
                'url': '/api/players/' + deletionModal.data('player').id + '/delete/',
                'method': 'post',
                'dataType': 'json',
                'data': {
                    'csrf_token': $('[name="csrf_token"]').attr('content').trim()
                }
            }).done(function (data) {
                that.reload();
            }).fail(function (jqXHR, textStatus) {
                that.reload();
            }).always(function () {
                deletionModal.modal('hide');
            });
        });

        // Player offsick
        offsickModal.find('.offsick-player-button').click(function () {
            $.ajax({
                'url': '/api/players/' + offsickModal.data('player').id + '/offsick/',
                'method': 'post',
                'dataType': 'json',
                'data': {
                    'csrf_token': $('[name="csrf_token"]').attr('content').trim(),
                    'current_stage': offsickModal.find('[name="offsick-current-state"]').val()
                }
            }).done(function (data) {

                that.reload();
            }).fail(function (jqXHR, textStatus) {
                that.reload();
            }).always(function () {
                offsickModal.modal('hide');
            });
        });

        // Offsick events
        offsickModal.find('[name="offsick-current-state"]').change(function () {
            offsickModal.find('.offsick-player-button').prop('disabled', $(this).val() < 1);
        });

        tableObj.on('change', '.current-offsick-stage', refreshOffisckState);

        $(document).on('change', '.table-filter', function () {
            tableObj.draw();
        })
    };

    return this;

})();


teams.init();