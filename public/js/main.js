let throttleTime = 0;
let searchPhrase = {};

$(document).on("change", ":file", function() {
    let input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input
            .val()
            .replace(/\\/g, "/")
            .replace(/.*\//, "");
    input.trigger("fileselect", [numFiles, label]);
});

$(":file").on("fileselect", function(event, numFiles, label) {
    let input, log;
    input = $(this).next();
    log = numFiles > 1 ? numFiles + " files selected" : label;

    if (input.length) {
        input.text(log);
    }
});

$.fn.spin = function(text) {
    text = text === undefined ? 'Loading...' : text;
    this.html(`<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></span> ${text}`);
};

window.modalConfirm = function(title, text, callback = null, confirmText = null, cancelText = null) {
    const modal = $('#confirm-modal');
    modal.find('.confirm').off('click');
    modal.modal({
        backdrop: true,
        keyboard: true,
        focus: true,
        show: true
    });

    modal.find('.modal-title').html(title);
    modal.find('.content').html(text);
    if (confirmText)
        modal.find('.confirm').html(confirmText);
    if (cancelText)
        modal.find('.cancel').html(cancelText);

    if (callback) {
        modal.find('.confirm').on('click', function() {
            callback();
            modal.modal('hide');
        })
    }
}

window.notify = function(title, message, icon = 'info') {
    $.toast({
        heading: title,
        text: message,
        position: 'top-right',
        stack: true,
        icon: icon
    })
}

$('.selectAll').on('click', function(){
    if ($(this).is( ":checked" )) {
        window.table.rows().select();
        $('.select-row').each(function(index, item) {
            $(item).prop('checked', true);
        });
    } else {
        window.table.rows().deselect();
        $('.select-row').each(function(index, item) {
            $(item).prop('checked', false);
        });
    }
});

$('body').on('change', '.select-row', function() {
    let index = $(this).parent().parent().index();
    if($(this).is(':checked')) {
        window.table.rows(index).select();
    } else {
        window.table.rows(index).deselect();
    }
});


$('.go-back').on( 'click', function() {
    window.history.back();
} );

$('.searchable').each( function () {
    let title = $(this).text();
    $(this).append( '<br><input type="text" class="form-control form-control-sm inputable" placeholder="Search '+title+'" />' );
} );

$('.inputable').on('click', function(e) {
    e.stopPropagation();
});

$('.refresh-table').click(function() {
    table.draw();
});

window.supportEditing = function(table, abstract, id, columns) {
    let editor = new $.fn.dataTable.Editor( {
        table: "#table",
        ajax: {
            url: config.base + 'data/editor',
            type: 'POST',
            data: function(data) {
                data.abstract = abstract;
            }
        },
        idSrc: id,
        fields: columns
    } );

    table.button().add(0, {
        extend: 'remove',
        editor: editor,
        className: 'btn-s, mb-3',
        text: '<i class="fa fa-trash"></i>'
    });

    table.button().add(0, {
        extend: "edit",
        editor: editor,
        'className' : 'btn-s mb-3',
        text: '<i class="fa fa-edit"></i>'
    });
}

window.creatTable = function(abstract, chartInfo, columnInfo, printableColumns = null, additional_query) {

    let buttons_options = null;
    if (printableColumns) {
        buttons_options = {
            columns: printableColumns
        };
    }
    window.table = $('#table').DataTable( {
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: false,
        "scrollX": true,
        "stateDuration": 0,
        searchDelay: 1000,
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        lengthMenu: [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
        dom: '<"row"<"col-md-12"B>><"row"<"col-md-6"l><"col-md-6"f>>rtip',
        buttons: [
            {
                extend: 'colvis',
                text: '<i class="fa fa-eye"></i>',
                className: 'mb-3',
                autoClose: true,
                collectionLayout: 'fixed two-column'
            },
            {
                extend: 'collection',
                text: '<i class="fa fa-file-export"></i>',
                className: 'mb-3',
                autoClose: true,
                buttons: [
                    {
                        extend: 'csv',
                        text: '<i class="fa fa-file-csv"></i> CSV',
                        className: 'btn btn-secondary btn-block',
                        exportOptions: {
                            columns: ':visible'
                        },
                        key: {
                            shiftKey: true,
                            key: 'v'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        className: 'btn btn-secondary btn-block',
                        exportOptions: {
                            columns: ':visible'
                        },
                        key: {
                            shiftKey: true,
                            key: 'e'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-secondary btn-block',
                        exportOptions: {
                            columns: ':visible'
                        },
                        key: {
                            shiftKey: true,
                            key: 'd'
                        }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> Copy',
                        className: 'btn btn-secondary btn-block',
                        exportOptions: {
                            columns: ':visible'
                        },
                        key: {
                            shiftKey: true,
                            key: 'c'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        className: 'btn btn-secondary btn-block',
                        exportOptions: {
                            columns: ':visible'
                        },
                        autoPrint: true,
                        key: {
                            shiftKey: true,
                            key: 'p'
                        },
                        title: '',
                        customize: function(win) {
                            let canvas = document.getElementById('chart');
                            if (!canvas)
                                return;
                            let img = new Image();
                            img.src = canvas.toDataURL();
                            img.style = "width: 100% !important; object-fit: none;";
                            $(win.document.body).prepend($(img));
                        }
                    }
                ]
            }
        ],
        ajax: {
            "url": config.base + "data-tables/data",
            "type": "post",
            "data" : function(data) {
                data.abstract = abstract;
                if (chartInfo) {
                    data.chart = chartInfo;
                }
                data.phrase = searchPhrase;
                data.additional = additional_query
            },
        },
        columns: columnInfo,
        initComplete: function() {
            $('div.dataTables_length select').addClass('w-100');
            monitorAjax(this);
            monitorColumnSearch(this);
        },
        "drawCallback": function( settings ) {
            let that = this;
            const evnt = new CustomEvent('datatable.drawcallback', {
                detail: { settings: settings, context: that },
                bubbles: true,
                cancelable: true,
                composed: false,
            });
            window.dispatchEvent(evnt);
        }
    } );

    return window.table;
};

function monitorAjax(context) {

}

function monitorColumnSearch(context) {
    context.api().columns().eq(0).each( function (index) {
        $( '.inputable', window.table.column(index).header() ).on( 'change clear keyup', function () {
            let idx = index;
            let settings = table.settings()[0].aoColumns[idx];

            if (!settings.data) {
                return;
            }
            if (this.value) {
                searchPhrase[settings.data] = this.value;
            } else {
                delete searchPhrase[settings.data];
            }
            window.throttle( function() {
                table.draw();
            }, 1000 )();
        } );
    } );
}

window.throttle = function (func, timeFrame) {
    return function () {
        let now = new Date();
        if (now - throttleTime >= timeFrame) {
            func();
            throttleTime = now;
        }
    };
}

window.randomColor = function string_to_color(str) {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        hash = str.charCodeAt(i) + ((hash << 5) - hash);
    }
    let colour = '#';
    for (let i = 0; i < 3; i++) {
        let value = (hash >> (i * 8)) & 0xFF;
        colour += ('00' + value.toString(16)).substr(-2);
    }
    return colour;
}