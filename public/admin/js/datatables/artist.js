const columnDefs = [{
    targets: [1, 2, 3, 4],
    orderable: false
}];

const columns = [
    {data: 'id'},
    {data: 'name'},
    {data: 'slug'},
    {data: 'photo'},
    {data: 'actions'},
];

document.addEventListener('DOMContentLoaded', () => {
    if (!DATATABLE_FETCH_URL) {
        return;
    }
    datatableRender(DATATABLE_FETCH_URL, columns, columnDefs);
});

