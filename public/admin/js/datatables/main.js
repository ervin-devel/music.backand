const datatableRender = (url, columns, columnDefs) => {
    $('#record_table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ru.json',
        },
        processing: true,
        serverSide: true,
        iDisplayLength: DATATABLE_iDisplayLength,
        serverMethod: 'GET',
        ajax: {
            url
        },
        columns,
        columnDefs
    })
}
