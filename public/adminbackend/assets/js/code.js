$(function () {
    $(document).on('click', '.deleteButton', function (e) {
        e.preventDefault();
        var itemId = $(this).data('id');
        var form = $('#deleteForm-' + itemId);

        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
            }
        });
    });
});

$(function () {
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })


    });

});


/// Confirm Order 

 /// Eend Confirm Order 


 $(function () {
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        var itemId = $(this).data('id');
        var form = $('#statusForm-' + itemId);

        Swal.fire({
            title: 'Are you sure?',
            text: "Once Confirm, You will not be able to pending again?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                    'Updated!',
                    'Order Status Has Been Updated.',
                    'success'
                );
            }
        });
    });
});