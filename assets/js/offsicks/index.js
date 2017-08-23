
offsicks = (function () {

    var tableObj = {};

    var loadTable = function (data) {
        return new Promise(function (resolve, reject) {
            tableObj = $('#offsicks-table').DataTable({
                'processing': true,
                'deferRender': true,
                'pageLength': 50,
                'lengthMenu': [5, 10, 20, 50, 100],
                'order': [
                    [0, 'desc']
                ],
                'columns': [
                    {
                        'title': 'Fecha baja',
                        'data': 'created_at',
                        'className': 'offsick-created-at',
                        'visible': true,
                        'orderable': true
                    },
                    {
                        'title': 'Fecha alta',
                        'data': 'ended_at',
                        'className': 'offsick-ended-at',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) {
                                if (data) return data;
                                return '-';
                            }

                            return data;
                        }
                    },
                    {
                        'title': 'Jugador',
                        'data': 'player_full_name',
                        'className': 'patient-name',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type)
                            {
                                var link = document.createElement('a');

                                link.href = "/players/" + row.player_id + '/show/';
                                link.target = "_blank";
                                link.title = "Ver perfil";
                                link.textContent = data;

                                return link.outerHTML;
                            }

                            return data;
                        }
                    },
                    {
                        'title': 'Fase',
                        'data': 'current_stage',
                        'className': 'patient-stage',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) return (stages[data] || 'N/A');
                            return data;
                        }
                    },
                    // {
                    //     'title': 'Lesión asociada/',
                    //     'data': 'injury',
                    //     'className': 'patient-injury',
                    //     'visible': true,
                    //     'orderable': true,
                    //     'render': function (data, type, row, meta) {
                    //         if ('display' === type || 'filter' === type) return injuries[data];
                    //         return data;
                    //     }
                    // },
                    // {
                    //     'title': 'Acciones',
                    //     'data': null,
                    //     'className': 'patient-actions',
                    //     'visible': true,
                    //     'orderable': false,
                    //     'createdCell': function (cell, rowData, row, col) {
                    //         // $(cell).html(
                    //         //     utils.template('#button-container')
                    //         // );
                    //     }
                    // }
                ],
                'data': data,
                'initComplete': function () {
                    resolve();
                },
                'language': {
                    'url': DT_LANGUAGE_URL,
                }
            });
        });
    };

    var loadData = function () {
        return $.ajax({
            'url': OFFSICKS_URL,
            'method': 'GET',
            'dataType': 'json'
        });
    }

    return {
        'init': function () {
            return new Promise(function (resolve, reject) {

                loadData().done(function (data) {

                    loadTable(data).then(function (data) {
                        console.log(data);
                        console.log('loaded!');

                        resolve();

                    }).catch(function (err) {
                        console.log(err);
                    });

                }).fail(function (jqXHR, textStatus) {
                    console.error(textStatus);
                });
            });
        },
        'events': function () {

        }
    };
})();


offsicks.init().then(function () {
    offsicks.events();
});
