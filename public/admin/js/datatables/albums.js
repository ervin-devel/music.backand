const columnDefs = [{
    targets: [1, 2, 3, 4, 7],
    orderable: false
}];

const columns = [
    {data: 'id'},
    {data: 'title'},
    {data: 'slug'},
    {data: 'cover'},
    {data: 'likes'},
    {data: 'published'},
    {data: 'created_at'},
    {data: 'actions'},
];

document.addEventListener('DOMContentLoaded', () => {
    if (!DATATABLE_FETCH_URL) {
        return;
    }
    datatableRender(DATATABLE_FETCH_URL, columns, columnDefs);
});

