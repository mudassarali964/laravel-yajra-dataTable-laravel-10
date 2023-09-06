@extends('layouts.master')

@section('title', 'All Posts')
@section('title-2', 'All Posts')
@section('title-3', 'All Posts')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 mb-4">
            {{-- Simple Tables --}}
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
                </div>
                <div class="card-body">
                    <div>
                        <select name="status" id="searchByStatusFilter">
                            <option value="">Select status</option>
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                    </div>
                    <div>
                        <input type="text" name="date_range" id="searchByDateField" value="" />
                    </div>
                    <button type="button" class="btn btn-success" id="searchFilter">Filter</button>
                    <button type="button" class="btn btn-danger mb-1" id="clearFilter">Clear</button>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush yajra-datatable">
                        <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
        $(function () {

            $('#searchByDateField').attr("placeholder","Select date range");

            // $('#searchByDateField').daterangepicker({
            //     startDate: moment().subtract(1, 'M'),
            //     endDate: moment()
            // });

            $('#searchByDateField').daterangepicker({
                autoUpdateInput: false
            }, (from_date, to_date) => {
                $('#searchByDateField').val(from_date.format('DD/MM/YYYY') + ' - ' + to_date.format('DD/MM/YYYY'));
            });

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lBfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: { columns: [1,2,3,4,5] }
                    },
                    {
                        extend: 'excel',
                        exportOptions: { columns: [1,2,3,4,5] }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: { columns: [1,2,3,4,5] }
                    }
                ],
                // buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                ajax: {
                    url: '{{ route('posts.list') }}',
                    data: function (d) {
                        d.status = $('#searchByStatusFilter :selected').val();
                        d.from_date = $('#searchByDateField').val() ? $('#searchByDateField').data('daterangepicker').startDate.format('YYYY-MM-DD') : '';
                        d.to_date = $('#searchByDateField').val() ? $('#searchByDateField').data('daterangepicker').endDate.format('YYYY-MM-DD') : '';
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        // orderable: true,
                        // searchable: true
                    },
                ],
                order: [[ 0, 'desc' ]],
                columnDefs: [{
                    'targets': [2, 6], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                }],
                // aaSorting: []
            });

            $('#searchFilter').on('click', function() {
                if ($('#searchByStatusFilter'). val() || $('#searchByDateField').val()) {
                    table.draw();
                }
            });

            $('#clearFilter').on('click', function() {
                if ($('#searchByStatusFilter :selected').val() || $('#searchByDateField').val()) {
                    $("#searchByStatusFilter option").prop("selected", false);
                    $('#searchByDateField').val('');
                    table.draw();
                }
            });

        });
    </script>
@endpush
