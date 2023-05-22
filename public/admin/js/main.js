const X_CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(function () {
    $('.select2-genres').select2({
        placeholder: 'Поиск жанра',
        minimumInputLength: 2,
        tags: true,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': X_CSRF_TOKEN
            },
            type: 'POST',
            url: GENRES_URL,
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    option: term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: JSON.stringify(item)
                        }
                    })
                };
            }
        },
    })

    $('.select2-artists').select2({
        placeholder: 'Поиск',
        minimumInputLength: 2,
        tags: true,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': X_CSRF_TOKEN
            },
            type: 'POST',
            url: ARTISTS_URL,
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    option: term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: JSON.stringify(item)
                        }
                    })
                };
            }
        },
    })

    $('.select2-tracks').select2({
        placeholder: 'Поиск треков',
        minimumInputLength: 2,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': X_CSRF_TOKEN
            },
            type: 'POST',
            url: TRACKS_URL,
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    option: term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: `${item.artist} - ${item.name}`,
                            id: item.id
                        }
                    })
                };
            }
        },
    })

    $('.select2-role-access').select2({
        placeholder: 'Поиск разрешений',
        minimumInputLength: 2,
        tags: true,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: ROLE_ACCESS_URL,
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    option: term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: `${item.name}`,
                            id: item.id
                        }
                    })
                };
            }
        },
    })

});

