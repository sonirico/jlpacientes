
patients = (function () {

    var tableObj = {};

    var loadTable = function (data) {
        return new Promise(function (resolve, reject) {
            tableObj = $('#offsicks-table').DataTable({
                'processing': true,
                'deferRender': true,
                'pageLength': 50,
                'lengthMenu': [5, 10, 20, 50, 100],
                'columns': [
                    {
                        'title': 'Nombre y apellidos',
                        'data': null,
                        'className': 'patient-name',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            return row.name + ' ' + row.surname;
                        }
                    },
                    {
                        'title': 'Posición',
                        'data': 'position',
                        'className': 'patient-position',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            return positions[data];
                        }
                    },
                    {
                        'title': 'Fase',
                        'data': 'stage',
                        'className': 'patient-stage',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type) return stages[data];
                            return data;
                        }
                    },
                    {
                        'title': 'Lesión',
                        'data': 'injury',
                        'className': 'patient-injury',
                        'visible': true,
                        'orderable': true,
                        'render': function (data, type, row, meta) {
                            if ('display' === type || 'filter' === type) return injuries[data];
                            return data;
                        }
                    },
                    {
                        'title': 'Acciones',
                        'data': null,
                        'className': 'patient-actions',
                        'visible': true,
                        'orderable': false,
                        'createdCell': function (cell, rowData, row, col) {
                            $(cell).html(
                                utils.template('#button-container')
                            );
                        }
                    }
                ],
                'data': data,
                'initComplete': function () {
                    resolve();
                }
            });
        });
    };

    var loadData = function () {
        var form = $('#patient-crud-form');

        return $.ajax({
            'url': '/offsicks/all/',
            'method': 'GET',
            'dataType': 'json'
        }).promise();
    }

    return {
        'init': function () {
            loadData()
                .done(function (data) {
                    loadTable(data)
                        .then(function (data) {
                            console.log(data);
                            console.log('loaded!');
                        }).catch(function (err) {
                            console.log(err);
                        });
                }).fail(function (jqXHR, textStatus) {
                    console.error(textStatus);
                });
        },
        'events': function () {
            // submitButtonObj.click(function (e) {
            //     e.preventDefault();

            //     var params = patientForm.serialize();

            //     $.ajax({
            //         'url': '/offsicks/save',
            //         'method': patientForm.attr('method'),
            //         'dataType': 'json',
            //         'data': params
            //     }).done(function (data) {
            //         console.log('done', data);
            //         this.init();
            //     }).fail(function (jqXHR, textStatus) {
            //         console.error('fail', textStatus);
            //     });
            // });

            // $('#injury-date').datepicker({
            //     format: "dd/mm/yyyy",
            //     todayBtn: "linked",
            //     clearBtn: true,
            //     language: "es",
            //     autoclose: true,
            //     todayHighlight: true
            // });
        }
    };
})();


patients.init();
patients.events();