player_history = (function () {

    function PlayerHistory() {
        var me = this;

        var tableObj = $('#player-history');
        var dataTableObj = {};

        var __loadData = function () {
            return $.ajax({
                'url': HISTORY_URL,
                'method': 'GET',
                'dataType': 'json'
            }).promise();
        };

        var __populateTable = function (data, reload) {

            return new Promise(function (resolve, reject) {
                reload = reload || false;

                if (reload) {
                    dataTableObj.clear();
                    dataTableObj.rows.add(data);
                    resolve();
                } else {
                    dataTableObj = tableObj.DataTable({
                        processing: true,
                        pageLength: 50,
                        lengthMenu: [5, 10, 20, 50],
                        columns: [
                            {
                                title: 'NIF',
                                data: 'nif',
                                className: 'player-nif',
                                visible: true,
                                orderable: true
                            },
                            {
                                title: 'Nombre y apellidos',
                                data: null,
                                className: 'player-name',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type) {
                                        var link = document.createElement('a');

                                        link.href = '/players/' + row.id + '/show/';
                                        link.target = '_blank';
                                        link.innerText = row.name + " " + row.surname;

                                        return link.outerHTML;
                                    }

                                    return row.name + " " + row.surname;
                                }
                            }
                        ],
                        data: data,
                        initComplete: function () {
                            resolve();
                        }
                    });
                }
            });

        };

        this.init = function (reload) {
            reload = reload || false;

            __loadData()
                .done(function (data) {

                    __populateTable(data, reload)
                        .then(function (data) {

                        }).catch(function (err) {
                        console.error(err);
                    });

                }).fail(function (jqXHR, textStatus) {

            });
        };

        this.reload = function () {
        };
        this.reset = function () {
        };
    }

    return new PlayerHistory();

})();


$(function () {
    player_history.init();
});
