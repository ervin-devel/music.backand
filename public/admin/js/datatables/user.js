const columnDefs = [{
    targets: [1, 2, 3, 4],
    orderable: false
}];

const columns = [
    {data: 'id'},
    {data: 'name'},
    {data: 'email'},
    {data: 'email_verified_at'},
    {data: 'created_at'},
    {data: 'role'},
    {data: 'actions'},
];

document.addEventListener('DOMContentLoaded', () => {
    if (!DATATABLE_FETCH_URL) {
        return;
    }
    datatableRender(DATATABLE_FETCH_URL, columns, columnDefs);
});

