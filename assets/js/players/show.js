player_history = (function () {

    function PlayerHistory() {
        var me = this;

        var formContainer = $('#injuries-form-container');
        var injuryForm = $('#injury-form');
        var tableContainer = $('#injuries-table-container');
        var offsickMainContainer = injuryForm.find('.offsick-container');
        var offsickContainer = $('#offsick-stage-container');
        var tableObj = $('#player-history');
        var dataTableObj = {};

        var __resetUI = function () {
            formContainer.hide();
            tableContainer.show();
            injuryForm[0].reset();
            offsickMainContainer.show();
            offsickContainer.hide();
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
                                title: 'Tipo de lesión',
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
                            [0, 'desc']
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
                injuryForm.find('.offsick-container').hide();
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

        this.adjustTable = function () {
            dataTableObj.columns.adjust().draw();
        };

        var __validateData = function () {
            var data = {
                'happened_at': injuryForm.find('[name="happened_at"]').val().trim(),
                'days_off': injuryForm.find('[name="days_off"]').val().trim(),
                'description': tinymce.get('injury-description').getContent(),
                'type': injuryForm.find('[name="type"]').val().trim(),
                'player': injuryForm.find('[name="player"]').val().trim()
            };

            var has_offsick = (injuryForm.find('[name="offsick"]').is(':checked') ? 1 : 0);
            var current_stage = injuryForm.find('[name="current_stage"]').val();

            if (has_offsick && parseInt(current_stage) < 1) {
                alert('El campo "Fase de baja actual" es obligatorio');
                return false;
            } else {
                data.has_offsick = has_offsick;
                data.current_stage = current_stage;
            }

            return data;
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

                if (!data) return;

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

            // Toggle offsick creation
            formContainer.find('[name="offsick"]').change(function () {
                offsickContainer.toggle(500);
            });
        }
    };

    return new PlayerHistory();

})();

player_nutrition = (function () {

    function PlayerNutrition () {

        var me = this;

        var formContainer = $('#nutrition-form-container');
        var nutritionForm = $('#nutrition-form');
        var tableContainer = $('#nutrition-table-container');
        var tableObj = $('#player-nutrition-history');
        var dataTableObj = {};

        var __resetUI = function () {
            formContainer.hide();
            tableContainer.show();
            nutritionForm[0].reset();
        };

        var __loadData = function () {
            return $.ajax({
                'url': NUTRITION_URL,
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
                                title: 'Registrado en',
                                data: 'created_at',
                                className: '',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type) {
                                        return moment(data).format('DD/MM/Y');
                                    }

                                    return data;
                                }
                            },
                            {
                                title: 'Cumple dieta',
                                data: 'diet_keen',
                                className: 'nutrition-diet-keen',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type) {
                                        return Boolean(data) ? 'Sí' : 'No';
                                    }
                                    return data;
                                }
                            },
                            {
                                title: 'IMC',
                                data: 'imc',
                                className: 'nutrition-imc',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type) {
                                        return data + '%';
                                    }
                                    return data;
                                }
                            },
                            {
                                title: 'Altura (cm)',
                                data: 'height',
                                className: 'nutrition-height',
                                visible: true,
                                orderable: false,
                                // render: function (data, type, row, meta) {
                                //     if ('display' === type) {
                                //         return ;
                                //     }
                                //     return data;
                                // }
                            },
                            {
                                title: 'Masa (Kg)',
                                data: 'weight',
                                className: 'nutrition-weight',
                                visible: true,
                                orderable: false,
                                // render: function (data, type, row, meta) {
                                //     if ('display' === type) {
                                //         return ;
                                //     }
                                //     return data;
                                // }
                            },
                            {
                                title: 'P. Cintura - cadera',
                                data: 'hip_waist_perimeter',
                                className: 'nutrition-hwp',
                                visible: true,
                                orderable: true,
                                // render: function (data, type, row, meta) {
                                //     if ('display' === type) {
                                //         return ;
                                //     }
                                //     return data;
                                // }
                            },
                            {
                                title: 'Pliegues',
                                data: 'folds',
                                className: 'nutrition-folds',
                                visible: true,
                                orderable: true,
                                // render: function (data, type, row, meta) {
                                //     if ('display' === type) {
                                //         return ;
                                //     }
                                //     return data;
                                // }
                            },
                            {
                                title: 'Comentarios',
                                data: 'comments',
                                className: 'nutrition-comments',
                                visible: true,
                                orderable: false,
                                createdCell: function (cell, cellData) {
                                    $(cell).html(cellData);
                                }
                            },
                            {
                                title: 'Acciones',
                                data: null,
                                className: 'nutrition-actions',
                                visible: true,
                                orderable: false,
                                createdCell: function (cell, cellData) {
                                    $(cell).html(
                                        utils.template('#nutrition-buttons-container')
                                    );
                                }
                            }
                        ],
                        order: [
                            [0, 'desc']
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

        var NutritionForm = {
            nutrition: {},
            deleteModal: $('#nutrition-deletion-modal'),
            edit: function () {

                __fillData(this.nutrition);

                nutritionForm.attr('action', NUTRITION_UPDATE);

                formContainer.show();
                tableContainer.hide();
            },
            destroy: function () {
                var dataContainer = this.deleteModal.find('.injury-data');

                dataContainer.find('.type').text(injuryCategories[this.nutrition.type]);
                dataContainer.find('.happened_at').text(moment.unix(this.nutrition.happened_at).format('DD/MM/Y'));
                dataContainer.find('.days_off').text(this.nutrition.days_off);
                dataContainer.find('.description').html(this.nutrition.description);

                this.deleteModal.modal('show');
            }
        };

        this.init = function (reload) {
            reload = reload || false;

            return new Promise(function (resolve, reject) {
                __loadData()
                    .done(function (data) {

                        var nut = data || [];
                        if (nut.length > 0) {
                            __fillData(nut[0]);
                        }

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

        var __fillData = function (nut) {
            nutritionForm.find('[name="diet_keen"]').prop('checked', parseInt(nut.diet_keen) > 0);
            nutritionForm.find('[name="imc"]').val(nut.imc);
            tinymce.get('nutrition-comments').setContent(nut.comments),
            nutritionForm.find('[name="folds"]').val(nut.folds);
            nutritionForm.find('[name="height"]').val(nut.height);
            nutritionForm.find('[name="weight"]').val(nut.weight);
            nutritionForm.find('[name="hip_waist_perimeter"]').val(nut.hip_waist_perimeter);
        };

        var __validateData = function () {
            return {
                'diet_keen': nutritionForm.find('[name="diet_keen"]').is(':checked') ? 1 : 0,
                'imc': nutritionForm.find('[name="imc"]').val().trim(),
                'comments': tinymce.get('nutrition-comments').getContent(),
                'folds': nutritionForm.find('[name="folds"]').val(),
                'height': nutritionForm.find('[name="height"]').val().trim(),
                'weight': nutritionForm.find('[name="weight"]').val().trim(),
                'hip_waist_perimeter': nutritionForm.find('[name="hip_waist_perimeter"]').val().trim(),
                'player': nutritionForm.find('[name="player"]').val().trim()
            };
        };

        this.events = function () {

            $('#new-nutrition-button').click(function () {
                formContainer.show();
                tableContainer.hide();
                nutritionForm.attr('action', NUTRITION_CREATE);
            });

            nutritionForm.find('.cancel').click(function (e) {
                __resetUI();
            });

            nutritionForm.find('.send').click(function (e) {

                var btn = $(this);
                btn.prop('disabled', true);

                var data = __validateData();

                data.csrf_token = $('[name="csrf_token"]').attr('content').trim();

                $.ajax({
                    'url': nutritionForm.attr('action').replace('<nutrition_id>', NutritionForm.nutrition.id),
                    'method': nutritionForm.attr('method'),
                    'data': data
                }).done(function () {
                    me.reload();
                }).fail(function (jqXHR, textStatus) {
                    alert(textStatus);
                }).always(function () {
                    btn.prop('disabled', false);
                });
            });

            tableObj.on('click', '.btn-action', function () {
                var btn = $(this);
                var action = btn.data('action');
                var nut = dataTableObj.row(btn.closest('tr')).data();

                NutritionForm.nutrition = nut;

                switch (action) {
                    case "edit":
                        NutritionForm.edit();
                        break;
                    case "delete":
                        NutritionForm.destroy();
                        break;
                }
            });

            $('#delete-nutrition-button').click(function () {
                $.when(
                    $.ajax({
                        url: NUTRITION_DELETE.replace('<nutrition_id>', NutritionForm.nutrition.id),
                        method: 'POST',
                        data: {
                            csrf_token: $('[name="csrf_token"]').attr('content').trim()
                        }
                    })
                ).then(function (data, textStatus, jqXHR) {
                    console.log(textStatus);

                    if (200 === jqXHR.status ) {
                        me.reload();
                        NutritionForm.deleteModal.modal('hide');
                    }

                });
            });
        }

        this.adjustTable = function () {
            dataTableObj.columns.adjust().draw();
        };
    }

    return new PlayerNutrition();
})();


player_offsicks = (function () {

    function PlayerOffsicks () {
        var me = this;
        var dataTableObj = null;

        var loadData = function () {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    'method': 'GET',
                    'url': OFFSICKS_URL,
                    'dataType': 'json'
                }).done(function (data) {
                    resolve(data);
                }).fail(function (jqXHR, textStatus) {
                    reject(textStatus);
                });
            });
        };

        var loadTable = function (data, reload) {
            return new Promise(function (resolve, reject) {

                reload = reload || false;

                if (reload) {
                    dataTableObj.rows.clear();
                    dataTableObj.rows.add(data).draw();
                } else {
                    dataTableObj = $('#player-offsicks-history').DataTable({
                        processing: true,
                        pageLength: 50,
                        lengthMenu: [5, 10, 20, 50],
                        columns: [
                            {
                                title: 'Fecha creación',
                                data: 'created_at',
                                className: 'player-offsick-created-at',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    return data;
                                }
                            },
                            {
                                title: 'Fecha alta',
                                data: 'ended_at',
                                className: 'player-offsick-ended-at',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type) {
                                        if (data) return data;
                                        else return '-';
                                    }

                                    return data;
                                }
                            },
                            {
                                title: 'Estado actual',
                                data: 'current_stage',
                                className: 'player-offsick-current-stage',
                                visible: true,
                                orderable: true,
                                render: function (data, type, row, meta) {
                                    if ('display' === type) {
                                        return stages[data];
                                    }
                                    return data;
                                }
                            }
                        ],
                        order: [
                            [0, 'desc']
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
                        },
                        initComplete: function () {
                            resolve();
                        }
                    });
                }

            });
        };

        this.init = function () {
            return new Promise(function (rs, rj) {
                loadData().then(function (data) {
                    loadTable(data).then(function () {
                        rs();
                    });
                }).catch(function (error) {
                    console.error(error);
                    rj(error);
                });
            });
        };

        this.events = function () {

        };
    }

    return new PlayerOffsicks();

})();


$(function () {
    player_history.init().then(function () {
        player_history.events();

        player_nutrition.init().then(function () {
            player_nutrition.events();

            player_offsicks.init().then(function () {
                player_offsicks.events();
            });
        });
    });


    $('[href="#history"]').on('shown.bs.tab', function () {
        player_history.adjustTable();
    });

    $('[href="#nutrition"]').on('shown.bs.tab', function () {
        player_nutrition.adjustTable();
        // alert('sfdg');
    });

    $('[href="#history"]').on('shown.bs.tab', function () {
        // player_history.adjustTable();
    });

});
