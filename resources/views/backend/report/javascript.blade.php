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
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: (data) => {
                            return moment(data).format('DD/MM/YYYY HH:mm')
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: (data, type, row) => {
                            let routeUrl = "{{ route('transaction.print', ':id') }}",
                            printUrl = routeUrl.replace(':id', row.id);
                            return `<a target="_blank" href="${printUrl}" class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-print"></i> </a>`
                        }
                    },
                ]
            });
        });
    </script>
@endpush
