
dataTableOptions = {
    deferRender: true,
    paging: true,
    searching: true,
    pageLength: 10,
    responsive: true,
    bDestroy: true,
    order: [[0, 'asc']],
    dom: '<Bl<f>rtip>',
    buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }
        ],
    "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        buttons: [                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
                ],
    }
};

moment.locale('es', {
  months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
  monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
  weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
  weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
  weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
});

formatCurrency = function (amount) {
        if (!amount) {
            return "";
        }

        amount += '';
        x = amount.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return "Q " + x1 + x2;
    }

emptyLogo = "data:image/png;base64,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";

ko.bindingHandlers.datePicker = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel) {
        // Register change callbacks to update the model
        // if the control changes.
        ko.utils.registerEventHandler(element, "change", function () {
            var value = valueAccessor();
            //Formato del campo 2017-05-18T11:59:00
            if (element.value && element.value !== null && element.value !== "") {
                dateValue = new Date(element.value);
                dateValue.setDate(dateValue.getDate() + 1);
                value(moment(dateValue).format());
            } else {
                value("");
            }

        });
    },

    // Update the control whenever the view model changes
    update: function (element, valueAccessor, allBindingsAccessor, viewModel) {
        var value = valueAccessor();
        var valueDate = value();
        if (valueDate && valueDate !== null && valueDate !== "") {
            element.value = moment(valueDate).format('YYYY-MM-DD');
        } else {
            element.value = null;
        }
    }
};

ko.bindingHandlers.selectPicker = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        if ($(element).is('select')) {
            if (ko.isObservable(valueAccessor())) {
                if ($(element).prop('multiple') && $.isArray(ko.utils.unwrapObservable(valueAccessor()))) {
                    // in the case of a multiple select where the valueAccessor() is an observableArray, call the default Knockout selectedOptions binding
                    ko.bindingHandlers.selectedOptions.init(element, valueAccessor, allBindingsAccessor);
                } else {
                    // regular select and observable so call the default value binding
                    ko.bindingHandlers.value.init(element, valueAccessor, allBindingsAccessor);

                }
            }
            $(element).addClass('selectpicker').selectpicker();
        }
    },
    update: function (element, valueAccessor, allBindingsAccessor) {
        if ($(element).is('select')) {
            var selectPickerOptions = allBindingsAccessor().selectPickerOptions;
            if (typeof selectPickerOptions !== 'undefined' && selectPickerOptions !== null) {
                var options = selectPickerOptions.optionsArray,
                    optionsText = selectPickerOptions.optionsText,
                    optionsValue = selectPickerOptions.optionsValue,
                    optionsCaption = selectPickerOptions.optionsCaption,
                    isDisabled = selectPickerOptions.disabledCondition || false,
                    resetOnDisabled = selectPickerOptions.resetOnDisabled || false;
                if (ko.utils.unwrapObservable(options).length > 0) {
                    // call the default Knockout options binding
                    ko.bindingHandlers.options.update(element, options, allBindingsAccessor);
                }
                if (isDisabled && resetOnDisabled) {
                    // the dropdown is disabled and we need to reset it to its first option
                    $(element).selectpicker('val', $(element).children('option:first').val());
                }
                $(element).prop('disabled', isDisabled);
            }
            if (ko.isObservable(valueAccessor())) {
                if ($(element).prop('multiple') && $.isArray(ko.utils.unwrapObservable(valueAccessor()))) {
                    // in the case of a multiple select where the valueAccessor() is an observableArray, call the default Knockout selectedOptions binding
                    ko.bindingHandlers.selectedOptions.update(element, valueAccessor);
                } else {
                    // call the default Knockout value binding
                    ko.bindingHandlers.value.update(element, valueAccessor);

                }
            }

            $(element).selectpicker('refresh');
        }
    }
};

ko.bindingHandlers.dataTablesForEach = {
    page: 0,
    init: function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        var binding = ko.utils.unwrapObservable(valueAccessor());

        ko.unwrap(binding.data);

        if (binding.options.paging) {
            binding.data.subscribe(function (changes) {
                var table = $(element).closest('table').DataTable();
                ko.bindingHandlers.dataTablesForEach.page = table.page();
                table.destroy();
            }, null, 'arrayChange');
        }

        var nodes = Array.prototype.slice.call(element.childNodes, 0);
        ko.utils.arrayForEach(nodes, function (node) {
            if (node && node.nodeType !== 1) {
                node.parentNode.removeChild(node);
            }
        });

        return ko.bindingHandlers.foreach.init(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext);
    },
    update: function (element, valueAccessor, allBindings, viewModel, bindingContext) {
        var binding = ko.utils.unwrapObservable(valueAccessor()),
            key = 'DataTablesForEach_Initialized';

        ko.unwrap(binding.data);

        var table;
        if (!binding.options.paging) {
            table = $(element).closest('table').DataTable();
            table.destroy();
        }

        ko.bindingHandlers.foreach.update(element, valueAccessor, allBindings, viewModel, bindingContext);

        table = $(element).closest('table').DataTable(binding.options);

        if (binding.options.paging) {
            if (table.page.info().pages - ko.bindingHandlers.dataTablesForEach.page === 0) {
                table.page(--ko.bindingHandlers.dataTablesForEach.page).draw(false);
            } else {
                table.page(ko.bindingHandlers.dataTablesForEach.page).draw(false);
            }
        }

        if (!ko.utils.domData.get(element, key) && (binding.data || binding.length)) {
            ko.utils.domData.set(element, key, true);
        }

        return {
            controlsDescendantBindings: true
        };
    }
};


var model = {
    view: ko.observable("welcome"),
    rsvp: {
        email: ko.observable(""),
        password: ""
    },
    paises: ko.observableArray([]),
    membership: ko.observableArray([]),
    state: ko.observable("hide"),
    registerresult: ko.observable("hide"),
    modifyresult: ko.observable("hide"),
    eraseresult: ko.observable("hide"),
    erascountryresult: ko.observable("hide"),
    recoversuccess: ko.observable("hide"),
    chagepasswordresult: ko.observable("hide"),
    changecountryresult: ko.observable("hide"),
    iderasableuser: ko.observable("0"),
    iderasablecountry: ko.observable("0"),
    newcountryresult: ko.observable("0"),
    customeridforapproval: ko.observable("0"),
    useridforapproval: ko.observable("0"),
    approveresult: ko.observable("nothing"),

    editable: {
        EMail: ko.observable(""),
        Password: ko.observable(""),
        PasswordConfirmation: ko.observable(""),
        fullname: ko.observable(""),
        CompanyName: ko.observable(""),
        Rol: ko.observable(""),
        Status: ko.observable(""),
        userId: ko.observable("")
    },
    recover:
    {
        email: ko.observable("")
    },

    changepassword:
    {
        password: "",
        passwordconfirm: "",
        confirmationkey: ""
    },
    newcountry: {
        countryname: ko.observable(""),
        longcountryname: ko.observable(""),
        ISO3: ko.observable(""),
        ISO2: ko.observable(""),
        NumCode: ko.observable(""),
        UNMemberState: ko.observable(""),
        CallingCode: ko.observable(""),
        CCTLD: ko.observable(""),
        id: ko.observable("")
    },

    isValidEmail: function (value) {
        var reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/;
        return reg.test(value);
    },

    elementCustomError: function (element, message) {
        var placement = $(element).data('error');
        var htmlPlacement = $(placement) || $("." + placement);
        if (htmlPlacement && htmlPlacement.length > 0) {
            htmlPlacement.empty();
            htmlPlacement.append("<span class='error'>" + message + "</span>");
        }
    },

    elementClearCustomError: function (element) {
        var placement = $(element).data('error');
        var htmlPlacement = $(placement) || $("." + placement);
        if (htmlPlacement && htmlPlacement.length > 0) {
            htmlPlacement.empty();
        }
    },

    validateForm: function (form) {
        var validator = $(form).validate({
            errorElement: 'span',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    var htmlPlacement = $(placement);
                    if (htmlPlacement && htmlPlacement.length > 0) {
                        htmlPlacement.append(error);
                    } else {
                        var htmlPlacement = $("." + placement);
                        if (htmlPlacement && htmlPlacement.length > 0) {
                            htmlPlacement.append(error);
                        } else {
                            error.insertAfter(element);
                        }
                    }
                } else {
                    error.insertAfter(element);
                }
            }
        });
        return validator.form();
    },

    clearErrorMessage: function (form) {
        var validator = $(form).validate();
        validator.resetForm();

        $('input').each(function () {
            $.data(this, 'default', this.value);
        }).css("color", "#555");
    },
};