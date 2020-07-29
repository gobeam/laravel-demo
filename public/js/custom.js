let modalModule = (function() {
    'use strict';

    function confirmDeleteModal() {
        $('table[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
            e.preventDefault();
            var $form = $(this);
            $('#confirm').modal({backdrop: 'static', keyboard: false})
                .on('click', '#delete-btn', function () {
                    $form.submit();
                });
        });
    }

    return {
        confirmDeleteModal,
    };
})();

modalModule.confirmDeleteModal();

