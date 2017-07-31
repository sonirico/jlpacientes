player_history = (function () {

    function PlayerHistory() {
        var me = this;

        var formContainer = $('#injuries-form-container');
        var injuryForm = $('#injury-form');
        var tableContainer = $('#injuries-table-container');
        var tableObj = $('#player-history');
        var dataTableObj = {};

        var __resetUI = function () {
            formContainer.hide();
            tableContainer.show();
            injuryForm[0].reset();
        };

        var __loadData = function () {
            return $.ajax({
                'url': HISTORY_URL,
                'method': 'GET',
                'dataType': 'json'
            });
        };

        var __populateTable = function (data, reload) {

            return new Promise(function (resolve, reject) {
                reload = reload || false;

                if (reload) {
                    dataTableObj.clear();
                    dataTableObj.rows.add(data);
                    dataTableObj.draw();
                } else {
                    dataTableObj = tableObj.DataTable({
                        processing: true,
                        pageLength: 50,
                        lengthMenu: [5, 10, 20, 50],
                        columns: [
                            {
                                title: 'Tipo lesión',
                                data: 'type',
                                className: 'injury-type',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    return injuryCategories[data];
                                }
                            },
                            {
                                title: 'Descripción',
                                data: 'description',
                                className: 'injury-description',
                                visible: true,
                                orderable: false,
                                createdCell: function (cell, cellData) {

                                    $(cell).html(cellData);
                                }
                            },
                            {
                                title: 'Fecha',
                                data: 'happened_at',
                                className: 'injury-happened-at',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    switch (type) {
                                        case "display":
                                        case "filter":
                                            return moment.unix(data).format('DD/MM/Y');
                                        case "sort":
                                            return data;
                                    }

                                    return data;
                                }
                            },
                            {
                                title: 'Días baja',
                                data: 'days_off',
                                className: 'injury-days-off',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type && ! data) {
                                        return '--';
                                    }
                                    return data;
                                }
                            },
                            {
                                title: '',
                                data: null,
                                className: 'injury-actions',
                                visible: true,
                                orderable: false,
                                createdCell: function (cell, cellData) {
                                    $(cell).html(
                                        utils.template('#injury-buttons-container')
                                    );
                                }
                            }
                        ],
                        order: [
                            [2, 'desc']
                        ],
                        data: data,
                        initComplete: function () {
                            resolve();
                        },
                        drawCallBack: function () {
                            resolve();
                        },
                        language: {
                            'url': DT_LANGUAGE_URL,
                        }
                    });
                }
            });

        };

        var InjuryForm = {
            injury: {},
            deleteModal: $('#injury-deletion-modal'),
            edit: function () {
                injuryForm.find('[name="type"]').val(this.injury.type);
                injuryForm.find('[name="happened_at"]').val(
                    moment.unix(this.injury.happened_at).format('DD/MM/Y')
                );
                injuryForm.find('[name="days_off"]').val(this.injury.days_off);
                tinymce.get('injury-description').setContent(this.injury.description);

                injuryForm.attr('action', INJURY_UPDATE);
                formContainer.show();
                tableContainer.hide();
            },
            destroy: function () {
                var dataContainer = this.deleteModal.find('.injury-data');

                dataContainer.find('.type').text(injuryCategories[this.injury.type]);
                dataContainer.find('.happened_at').text(moment.unix(this.injury.happened_at).format('DD/MM/Y'));
                dataContainer.find('.days_off').text(this.injury.days_off);
                dataContainer.find('.description').html(this.injury.description);

                this.deleteModal.modal('show');
            }
        };

        this.init = function (reload) {
            reload = reload || false;

            return new Promise(function (resolve, reject) {
                __loadData()
                    .done(function (data) {

                        __populateTable(data, reload)
                            .then(function (data) {
                                resolve();
                            }).catch(function (err) {
                                console.log(err);
                                reject(err);
                            });

                    }).fail(function (jqXHR, textStatus) {

                });
            });

        };

        this.reload = function () {

            me.reset();

            me.init(true);
        };

        this.reset = function () {

            __resetUI();
        };

        var __validateData = function () {
            return {
                'happened_at': injuryForm.find('[name="happened_at"]').val().trim(),
                'days_off': injuryForm.find('[name="days_off"]').val().trim(),
                'description': tinymce.get('injury-description').getContent(),
                'type': injuryForm.find('[name="type"]').val().trim(),
                'player': injuryForm.find('[name="player"]').val().trim()
            };
        };

        this.events = function () {
            $('#injury-happened-at').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                language: "es",
                autoclose: true,
                todayHighlight: true
            });

            $('#new-injury-button').click(function () {
                formContainer.show();
                tableContainer.hide();
                injuryForm.attr('action', INJURY_CREATE);
            });

            formContainer.find('.cancel').click(function () {
                __resetUI();
            });

            injuryForm.submit(function (e) {
                e.preventDefault();

                var data = __validateData();

                data.csrf_token = $('[name="csrf_token"]').attr('content').trim();

                $.ajax({
                    'url': $(this).attr('action').replace('<injury_id>', InjuryForm.injury.id),
                    'method': $(this).attr('method'),
                    'data': data
                }).done(function () {
                    me.reload();
                }).fail(function (jqXHR, textStatus) {
                    alert(textStatus);
                }).always(function () {

                });
            });

            tableObj.on('click', '.btn-action', function () {
                var btn = $(this);
                var action = btn.data('action');
                var injury = dataTableObj.row(btn.closest('tr')).data();

                InjuryForm.injury = injury;

                switch (action) {
                    case "edit":
                        InjuryForm.edit();
                        break;
                    case "delete":
                        InjuryForm.destroy();
                        break;
                }
            });

            $('#delete-injury-button').click(function () {
                $.when(
                    $.ajax({
                        url: INJURY_DELETE.replace('<injury_id>', InjuryForm.injury.id),
                        method: 'POST',
                        data: {
                            csrf_token: $('[name="csrf_token"]').attr('content').trim()
                        }
                    })
                ).then(function (data, textStatus, jqXHR) {
                    console.log(textStatus);

                    if (200 === jqXHR.status ) {
                        me.reload();
                        InjuryForm.deleteModal.modal('hide');
                    }

                });
            });
        }
    };


    return new PlayerHistory();

})();


$(function () {
    player_history.init().then();
    player_history.events();
});
