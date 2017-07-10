
patients = (function () {
    
    var positions = {
        1: 'Portero',
        2: 'Zaga',
        3: 'Punta',
        4: 'Liberto'
    };

    var stages = [1, 2, 3, 4];

    var tableObj = {};
    var patientForm = $('#patient-crud-form');
    var cancelButtonObj = $('#cancel');
    var submitButtonObj = $('#submit');


    var loadTable = function (data) {
        return new Promise (function (resolve, reject) {
            tableObj = $('#patients-table').DataTable({
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
                        'orderable': true
                    },
                    {
                        'title': 'Actions',
                        'data': null,
                        'className': 'patient-actions',
                        'visible': true,
                        'orderable': false,
                        'createdCell': function (cell, rowData, row, col) {
                            $(cell).append(
                                $('#button-container').clone().removeAttr('id').removeClass('template')
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
            'url': '/patients/all/',
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
                            console.error(err);
                        });
                }).fail(function (jqXHR, textStatus) {
                    console.error(textStatus);
                });
        },
        'events': function () {
            submitButtonObj.click(function (e) {
                e.preventDefault();

                var params = patientForm.serialize();

                $.ajax({
                    'url': '/patients/save',
                    'method': patientForm.attr('method'),
                    'dataType': 'json',
                    'data': params
                }).done(function (data) {
                    console.log('done', data);
                    this.init();
                }).fail(function (jqXHR, textStatus) {
                    console.error('fail', textStatus);
                });
            });
        }
    };
})();


patients.init();
patients.events();