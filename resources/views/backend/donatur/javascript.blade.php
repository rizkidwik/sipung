@push('after-script')
    <script type="text/javascript">
        var table = ".data-table"

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            table = $(table).DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('donatur.table') }}",
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
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone',
                        name: 'phone'

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
            $("#donatur_id").val(id);
            $.ajax({
                url: "{{ route('donatur.show') }}",
                data: {
                    id
                },
                method: 'POST',
                success: function(response) {
                    HELPER.populateForm("#form-donatur", response.data)
                    $("#modalDonatur").modal('show');
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
                data: $('#form-donatur').serialize(),
                url: "{{ route('donatur.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#form-donatur').trigger("reset");
                    $("#modalDonatur").modal('hide');
                    $("#donatur_id").val('');

                    table.draw();
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
                        url: "{{ route('donatur.destroy') }}",
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
