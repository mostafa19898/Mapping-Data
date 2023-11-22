<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                // Add an event listener for the similarity button       
         $('#saveButton').on('click', function() {
         var dataToSave = [];

        $('select[name="main_data_options[]"]').each(function() {
            var parentRow = $(this).closest('tr');
            var mainDataId = $(this).val();
            var reasonsId = parentRow.find('select[name="reasons_options[]"]').val();
            var selectedColumns = parentRow.find('input[name="selected_columns[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            // Create an object with the data for each row
            var rowData = {
                mainDataId: mainDataId,
                reasonsId: reasonsId,
                selectedColumns: selectedColumns
            };

            // Push the object to the array
            dataToSave.push(rowData);
        });

        // Send the array of data to the server
        $.ajax({
            url: '/saveMappingData',
            type: 'POST',
            data: {
                dataToSave: dataToSave
            },
            success: function(response) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data has been updated",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        content: 'custom-swal-content' // Add your custom class here
                    }
                });
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
      }); 
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>