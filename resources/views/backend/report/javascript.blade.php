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
                ajax: "{{ route('report.table') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'donatur.name',
                        name: 'donatur.name'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        render: (data) => {
                            return HELPER.toRp(data)
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: (data) => {
                            return moment(data).format('DD/MM/YYYY HH:mm')
                        }
                    }
                ]
            });
        });
    </script>
@endpush
