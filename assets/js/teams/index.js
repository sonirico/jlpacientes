
teams = (function () {

    var tableObj = {};
    var modal = $('#delete-team-modal');

    var loadTable = function (data, reload) {
        var reload = reload || false;

        return new Promise(function (resolve, reject) {

            if (reload) { //d} || !$.isEmptyObject(tableObj)) {
                tableObj.clear();
                tableObj.rows.add(data);
                tableObj.draw();
                return;
            }

            tableObj = $('#teams-table').DataTable({
                'processing': true,
                'deferRender': true,
                'pageLength': 50,
                'lengthMenu': [5, 10, 20, 50],
                'columns': [
                    {
                        'title': 'Escudo',
                        'data': 'logo',
                        'className': 'team-logo',
                        'visible': true,
                        'orderable': false,
                        'createdCell': function (cell, cellData, rowData, rowIndex, colIndex) {
                            if (cellData)
                                $(cell).html(
                                    $('<img>').attr({
                                        'src': IMG_BASE_URL + cellData,
                                        'alt': rowData.name,
                                        'width': '32'
                                    })
                                    .addClass('img-responsive thumbnail')
                                );
                        }
                    },
                    {
                        'title': 'Equipo',
                        'data': 'name',
                        'className': 'team-name',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) {
                                var link = document.createElement('a');

                                link.href = '/teams/' + row.id + '/edit/';
                                link.target = '_blank';
                                link.innerText = data;

                                return link.outerHTML;
                            }

                            return data;
                        }
                    },
                    {
                        'title': 'Nº jugadores',
                        'data': 'n_players',
                        'className': 'team-n-players text-center',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            var nPlayers = parseInt(data);

                            if ('display' === type) {
                                if (nPlayers > 0) {
                                    var link = $('<a>')
                                        .attr({
                                            'href': '/players/?team=' + row.id,
                                            'title': 'Ver jugadores'
                                        })
                                        .addClass('btn btn-md btn-default')
                                        .append(
                                            $('<i>').addClass('fa fa-users').html('&nbsp;'),
                                            $('<span>').text(nPlayers)
                                        );
                                    return link.get(0).outerHTML;
                                } else {
                                    return '-- Sin jugadores --';
                                }
                            }

                            return nPlayers;
                        }
                    },
                    {
                        'title': 'Acciones',
                        'data': null,
                        'className': 'team-actions',
                        'visible': true,
                        'orderable': false,
                        'createdCell': function (cell, cellData, rowData, row, col) {
                            $(cell).html(
                                utils.template('#button-action-container')
                            );
                        }
                    }
                ],
                'data': data,
                'initComplete': function () {
                    resolve();
                },
                'drawCallback': function () {
                    resolve();
                },
                language: {
                    'url': DT_LANGUAGE_URL,
                }
            });
        });
    };

    var loadData = function () {
        return $.ajax({
            'url': '/api/teams/players/',
            'method': 'GET',
            'dataType': 'json'
        }).promise();
    }

    this.init = function () {
        loadData()
        .done(function (data) {
            loadTable(data)
                .then(function (data) {

                    this.events();

                }).catch(function (err) {
                    console.log(err);
                });
        }).fail(function (jqXHR, textStatus) {
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
            var team = tableObj.row(btn.closest('tr')).data();
            var action = btn.data('action');

            if ('delete' == action) {
                modal.data('team', team);
                modal.find('.deletion-team-name').text(team.name);
                modal.modal('show');
            } else if ('edit' == action) {
                window.document.location = '/teams/' + team.id + '/edit/';
            }
        });

        // Team deletion
        modal.find('.delete-team-button').click(function () {
            $.ajax({
                'url': '/api/teams/' + modal.data('team').id + '/delete/',
                'method': 'post',
                'dataType': 'json',
                'data': {
                    'csrf_token': $('[name="csrf_token"]').attr('content').trim()
                }
            }).done(function (data) {
                alert(data);

                that.reload();
            }).fail(function (jqXHR, textStatus) {
                that.reload();
            }).always(function () {
                modal.modal('hide');
            });
        });
    };

    return this;

})();


teams.init();