$(document).ready(function () {
    (function () {
        var $tagInput = $('input[name$="[tags]"]');
        function tags($input) {
            $input.select2({
                placeholder: "Problem Tags",
                allowClear: true,
                minimumInputLength: 2,
                tags: true,
                multiple: true,
                width: "300px",
                // ajax: {
                //     //type: "POST",
                //     //url: "/Problem/GetTags",
                //     url: $input.data('ajax'),
                //     dataType: 'json',
                //     data: function(params){
                //         var query = {
                //             term: params.term,
                //             page_limit: 15,
                //             tags: data
                //         };
                //         return { json: JSON.stringify( query ) }
                //     },
                //     processResults: function (data, page) {
                //         return { results: data.tags };
                //     },
                // },
                // createTag: function (params) {
                //     var term = $.trim(params.term);
                //     if (term === '') {
                //         return null;
                //     }
                //     return {
                //         id: term,
                //         text: term,
                //         newTag: true // add additional parameters
                //     }
                // }
            });

            // $input.attr('type', 'hidden').select2({
            //     tags: true,
            //     tokenSeparators: [","],
            //     createSearchChoice: function(term, data) {
            //         if ($(data).filter(function () {
            //             return this.text.localeCompare(term) === 0;
            //         }).length === 0) {
            //             return {
            //                 id: term,
            //                 text: term
            //             };
            //         }
            //     },
            //     multiple: true,
            //     ajax: {
            //         url: $input.data('ajax'),
            //         dataType: "json",
            //         data: function (term, page) {
            //             return {
            //                 q: term
            //             };
            //         },
            //         results: function (data, page) {
            //             return {
            //                 results: data
            //             };
            //         }
            //     }
            // });
        }
        if ($tagInput.length > 0) {
            //tags($tagInput);
        }
    }());
});
