$(function(){
  $(document).on('click', '#deleteButton', function(e){
      e.preventDefault();
      var form = $('#deleteForm');

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
