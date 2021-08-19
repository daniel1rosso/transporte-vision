"use strict";

$(function () {
  /* # Data tables
   ================================================== */
  //===== Setting Datatable defaults =====//
  $.extend($.fn.dataTable.defaults, {
    autoWidth: false,
    pagingType: 'full_numbers',
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
      search: '<span>Filter:</span> _INPUT_',
      lengthMenu: '<span>Show:</span> _MENU_',
      paginate: {
        'first': 'First',
        'last': 'Last',
        'next': '>',
        'previous': '<'
      }
    }
  }); //===== Default datatable =====//

  $('.datatable table').dataTable({
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar: ",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  }); //===== Datatable Creadas =====//

  tableListado_usuarios = $('#listado_usuarios').DataTable();
  $("#listado_usuarios").dataTable().fnDestroy();
  $('#listado_usuarios').DataTable({
    "sAjaxSource": URL + "usuarios/listar_usuarios_table",
    "bSort": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    "aoColumns": [{
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }]
  });
  tableListadoPedidos = $('#listado_pedidos').DataTable();
  $("#listado_pedidos").dataTable().fnDestroy();
  $('#listado_pedidos').DataTable({
    "sAjaxSource": URL + "pedidos/listar_pedidos_table",
    "bSort": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
    },
    "aoColumns": [{
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }, {
      'sClass': 'text-center'
    }]
  }); //===== Custom sort columns =====//

  $('.datatable-pager table').dataTable({
    pagingType: 'simple',
    language: {
      paginate: {
        'next': 'Next →',
        'previous': '← Previous'
      }
    }
  }); //===== Custom sort columns =====//

  $('.datatable-custom-sort table').dataTable({
    columnDefs: [{
      orderable: false,
      targets: [0, 2]
    }],
    order: [[1, 'asc']]
  }); //===== Tasks datatable =====//

  $('.datatable-invoices table').dataTable({
    columnDefs: [{
      orderable: false,
      targets: [1, 6]
    }],
    order: [[0, 'desc']]
  }); //===== Saving state =====//

  $('.datatable-tasks table').dataTable({}); //===== Saving state =====//

  $('.datatable-ajax-source table').dataTable({
    ajax: 'media/datatable_ajax_source.txt'
  }); //===== Datatable with selectable rows =====//

  $('.datatable-state-saving table').dataTable({
    stateSave: true
  }); //===== Datatable with tools =====//

  $('.datatable-selectable table').dataTable({
    dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
    tableTools: {
      sRowSelect: 'multi',
      aButtons: [{
        sExtends: 'collection',
        sButtonText: 'Tools <span class="caret"></span>',
        sButtonClass: 'btn btn-primary',
        aButtons: ['select_all', 'select_none']
      }]
    }
  }); //===== Datatable with tools =====//

  $('.datatable-tools table').dataTable({
    dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
    tableTools: {
      sRowSelect: "single",
      sSwfPath: "media/swf/copy_csv_xls_pdf.swf",
      aButtons: [{
        sExtends: 'copy',
        sButtonText: 'Copy',
        sButtonClass: 'btn btn-default'
      }, {
        sExtends: 'print',
        sButtonText: 'Print',
        sButtonClass: 'btn btn-default'
      }, {
        sExtends: 'collection',
        sButtonText: 'Save <span class="caret"></span>',
        sButtonClass: 'btn btn-primary',
        aButtons: ['csv', 'xls', 'pdf']
      }]
    }
  }); //===== Datatable with custom column filtering =====//
  // Setup - add a text input to each footer cell

  $('.datatable-add-row table tfoot th').each(function () {
    var title = $('.datatable-add-row table thead th').eq($(this).index()).text();
    $(this).html('<input type="text" class="form-control" placeholder="Filter ' + title + '" />');
  }); // DataTable

  var table = $('.datatable-add-row table').DataTable(); // Apply the filter

  $(".datatable-add-row table tfoot input").on('keyup change', function () {
    table.column($(this).parent().index() + ':visible').search(this.value).draw();
  });
  $('.dataTables_filter input[type=search]').attr('placeholder', 'Escribe para filtrar...');
  /* # Select2 dropdowns 
   ================================================== */
  //===== Datatable select =====//

  $(".dataTables_length select").select2({
    minimumResultsForSearch: "-1"
  });
});