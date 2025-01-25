@push('after-script')
    <script type="text/javascript">
        var table = ".data-table",
            categoryType = {
                1: "Nominal Tetap",
                2: "Nominal Bebas"
            }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            table = $(table).DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.table') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type',
                        render: (data, type, row) => {
                            return categoryType[data]
                        }
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        render: function(data, type, row) {
                            return HELPER.toRp(data)
                        }

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });


        onEdit = (id) => {
            $("#category_id").val(id);
            $.ajax({
                url: "{{ route('category.show') }}",
                data: {
                    id
                },
                method: 'POST',
                success: function(response) {
                    HELPER.populateForm("#form-category", response.data)
                    $("#modalCategory").modal('show');
                },
                error: function() {
                    Swal.fire({
                        success: false,
                        title: "Error",
                        message: "System error!"
                    });
                }
            });
        }

        onSave = () => {
            $.ajax({
                data: $('#form-category').serialize(),
                url: "{{ route('category.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#form-category').trigger("reset");
                    $("#modalCategory").modal('hide');
                    $("#category_id").val('');

                    table.draw();
                    HELPER.resetForm('#form-category')
                },
                error: function(data) {
                    console.log('Error:', data);
                    Swal.fire({
                        success: false,
                        title: "Error",
                        message: "System error!"
                    });
                }
            });
        };


        onDelete = (id) => {
            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin ingin menghapus data ini?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('category.destroy') }}",
                        data: {
                            id
                        },
                        type: "POST",
                        success: function(data) {
                            Swal.fire('Deleted data successfully');
                            table.draw()
                        }
                    });
                }
            })
        }

        $("#type").on('change', () => {
            let value = $("#type").val()
            if (value == 1) {
                $("#amount-container").removeClass('d-none')
            } else {
                $("#amount-container").addClass('d-none')
            }
        })
    </script>
@endpush
