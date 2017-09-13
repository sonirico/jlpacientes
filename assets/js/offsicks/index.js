$(function () {
    offsicks = (function () {

        var tableObj = {};
        var filters = {
            toggleUps: $('[name="offsicks-filter-show-ups"]'),
            dateFrom: $('[name="offsicks-filter-date-from"]'),
            dateTo: $('[name="offsicks-filter-date-to"]')
        };

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
                    'language': DT_LANGUAGE_OPTIONS
                });
            });
        };

        var loadData = function () {
            return $.ajax({
                'url': OFFSICKS_URL,
                'method': 'GET',
                'dataType': 'json'
            });
        };


        var loadFilters = function (){
            // Toggle ups/downs
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var hasUp = data[1].trim().length > 0;

                    if (! hasUp) return true;

                    return filters.toggleUps.is(':checked');
                }
            );

            // Greater or equals than from
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {

                    var dateFrom = filters.dateFrom.val().trim();

                    if (dateFrom.length < 1) return true;

                    var from = moment(dateFrom, 'DD/MM/YYYY');
                    var happened = moment(data[0], 'YYYY-MM-DD');

                    return from <= happened;
                }
            );

            // Lower or equals than to
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var dateTo = filters.dateTo.val().trim();

                    if (dateTo.length < 1) return true;

                    var to = moment(dateTo, 'DD/MM/YYYY');
                    var happened = moment(data[0], 'YYYY-MM-DD');

                    return happened <= to;
                }
            );
        };

        return {
            'init': function () {
                return new Promise(function (resolve, reject) {

                    loadData().done(function (data) {

                        loadTable(data).then(function (data) {

                            loadFilters();

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
                filters.toggleUps.click(function (e) {
                    tableObj.draw();
                });

                filters.dateFrom.datepicker({
                    format: "dd/mm/yyyy",
                    todayBtn: "linked",
                    clearBtn: true,
                    language: "es",
                    autoclose: true,
                    todayHighlight: true
                });

                filters.dateTo.datepicker({
                    format: "dd/mm/yyyy",
                    todayBtn: "linked",
                    clearBtn: true,
                    language: "es",
                    autoclose: true,
                    todayHighlight: true
                });

                filters.dateFrom.change(function (e) {
                    tableObj.draw();
                });

                filters.dateTo.change(function (e) {
                    tableObj.draw();
                });
            },
            'tableDraw': function () {
                tableObj.draw();
            }
        };
    })();


    offsicks.init().then(function () {
        offsicks.events();

        setTimeout(function () {

            // Hide ups
            offsicks.tableDraw();


        }, 500);
    });

});
