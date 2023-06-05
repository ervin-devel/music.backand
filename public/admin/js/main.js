const initSelect2 = (selector, placeholder, url, tags, processResults) => {
    $(selector).select2({
        placeholder,
        minimumInputLength: 2,
        tags,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url,
            dataType: 'json',
            quietMillis: 100,
            data: function (term, page) {
                return {
                    option: term
                };
            },
            processResults
        },
    })
}

$(function () {

    initSelect2('.select2-genres', 'Поиск жанра', GENRES_URL, true, (data) => {
        return {
            results: $.map(data, function (item) {
                return {
                    text: item.name,
                    id: JSON.stringify(item)
                }
            })
        };
    });

    initSelect2('.select2-artists','Поиск артистов', ARTISTS_URL, true, (data) => {
        return {
            results: $.map(data, function (item) {
                return {
                    text: item.name,
                    id: JSON.stringify(item)
                }
            })
        };
    });

    initSelect2('.select2-tracks','Поиск трэков', TRACKS_URL, false, (data) => {
        return {
            results: $.map(data, function (item) {
                return {
                    text: `${item.artist} - ${item.name}`,
                    id: item.id
                }
            })
        };
    });

    initSelect2('.select2-role-access','Поиск разрешений', ROLE_ACCESS_URL, true, (data) => {
        return {
            results: $.map(data, function (item) {
                return {
                    text: `${item.name}`,
                    id: item.id
                }
            })
        };
    });

    initSelect2('.select2-categories','Поиск категорий', CATEGORIES_URL, true, (data) => {
        return {
            results: $.map(data, function (item) {
                return {
                    text: `${item.title}`,
                    id: JSON.stringify(item)
                }
            })
        };
    });

});
