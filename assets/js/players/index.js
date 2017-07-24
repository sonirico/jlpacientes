
teams = (function () {

    var teams = [];
    var players = [];

    var tableObj = {};
    var modal = $('#delete-player-modal');

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
                'processing': true,
                'deferRender': true,
                'pageLength': 50,
                'lengthMenu': [5, 10, 20, 50],
                'columns': [
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
                                var link = document.createElement('a');

                                link.href = '/players/' + row.id + '/show/';
                                link.target = '_blank';
                                link.innerText = row.name + " " + row.surname;

                                return link.outerHTML;
                            }
                            
                            return row.name + " " + row.surname;
                        }
                    },
                    {
                        'title': 'Edad',
                        'className': 'player-age',
                        'data': 'birthday',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            var then = moment.unix(data);
                            return moment().diff(moment.unix(data), 'years');
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

                                link.href = "/teams/" + row.id_team + "/edit/";
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
                                return positions[data];
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
                        'className': 'team-actions',
                        'visible': true,
                        'orderable': false,
                        'createdCell': function (cell, cellData, rowData, row, col) {
                            $(cell).html(
                                utils.template('#player-buttons-container')
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
                }
            });
        });
    };

    var loadData = function () {
        return $.ajax({
            'url': '/api/players/',
            'method': 'GET',
            'dataType': 'json'
        });
    }

    this.init = function () {
        loadData()
        .done(function (data) {
            loadTable(data)
                .then(function (data) {
                    console.log(data);
                    console.log('loaded!');

                    this.events();

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
                    modal.data('player', player);
                    modal.find('.deletion-player-name').text(player.name);
                    modal.modal('show');
                    break;

                case "edit":
                    window.document.location = "/players/" + player.id + "/edit/";
            }
        });

        // Team deletion
        modal.find('.delete-player-button').click(function () {
            $.ajax({
                'url': '/api/players/' + modal.data('player').id + '/delete/',
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