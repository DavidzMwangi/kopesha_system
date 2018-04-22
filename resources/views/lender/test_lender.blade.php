@extends('layouts.main')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/select2.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('template/vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link href="{{asset('template/css/pages/tables.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Editable Datatables</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('home')}}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="{{url('lenders')}}">Lenders</a>
            </li>
            <li class="active">Lenders Details</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Second Data Table -->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box default">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Editable Table
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="btn-group">
                                <button id="sample_editable_1_new" class=" btn btn-custom">
                                    Add New
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <div class="btn-group pull-right">
                                <button class="btn dropdown-toggle btn-custom" data-toggle="dropdown">
                                    Tools
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#">Print</a>
                                    </li>
                                    <li>
                                        <a href="#">Save as PDF</a>
                                    </li>
                                    <li>
                                        <a href="#">Export to Excel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="sample_editable_1_wrapper" class="">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_editable_1" role="grid">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1">Identity Number</th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Full Name
                                            : activate to sort column ascending" style="width: 222px;">Maximum Amount</th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Points
                                            : activate to sort column ascending" style="width: 124px;">Payment Duration</th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Notes
                                            : activate to sort column ascending" style="width: 152px;">Interest Rate</th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Edit
                                            : activate to sort column ascending" style="width: 88px;">Edit</th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Delete
                                            : activate to sort column ascending" style="width: 125px;">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lenders as $lender)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$lender->id}}</td>
                                    <td>{{$lender->max_amount}}</td>
                                    <td>{{$lender->payment_duration}}</td>
                                    <td class="center">{{$lender->interest_rate}}</td>
                                    <td>
                                        <a class="edit" href="javascript:;">Edit</a>
                                    </td>
                                    <td>
                                        <a class="delete" href="javascript:;">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                {{--<tr role="row" class="even">--}}
                                    {{--<td class="sorting_1">Martena</td>--}}
                                    {{--<td>Martena Mccray</td>--}}
                                    {{--<td>62</td>--}}
                                    {{--<td class="center">new user</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="edit" href="javascript:;">Edit</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="delete" href="javascript:;">Delete</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr role="row" class="odd">--}}
                                    {{--<td class="sorting_1">Cedric</td>--}}
                                    {{--<td>Cedric Kelly</td>--}}
                                    {{--<td>132</td>--}}
                                    {{--<td class="center">elite user</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="edit" href="javascript:;">Edit</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="delete" href="javascript:;">Delete</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr role="row" class="even">--}}
                                    {{--<td class="sorting_1">Sonya</td>--}}
                                    {{--<td>Sonya Wong</td>--}}
                                    {{--<td>434</td>--}}
                                    {{--<td class="center">new user</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="edit" href="javascript:;">Edit</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="delete" href="javascript:;">Delete</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr role="row" class="odd">--}}
                                    {{--<td class="sorting_1">Gavin</td>--}}
                                    {{--<td>Gavin Joyce</td>--}}
                                    {{--<td>232</td>--}}
                                    {{--<td class="center">power user</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="edit" href="javascript:;">Edit</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="delete" href="javascript:;">Delete</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr role="row" class="even">--}}
                                    {{--<td class="sorting_1">Timothy</td>--}}
                                    {{--<td>Antonio Sanches</td>--}}
                                    {{--<td>462</td>--}}
                                    {{--<td class="center">new user</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="edit" href="javascript:;">Edit</a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<a class="delete" href="javascript:;">Delete</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->
    @endsection

@section('script')
    <script type="text/javascript" src="{{asset('template/vendors/datatables/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('template/vendors/datatables/dataTables.bootstrap.js')}}"></script>
    {{--<script type="text/javascript" src="{{asset('template/js/pages/table-editable.js')}}"></script>--}}
    <script type="application/javascript">
        jQuery(document).ready(function()
        {

            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<select  class="form-control input-small">' +
                    '<option value="' + aData[0] + '">Data</option>' + '</select>';
//                jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<a class="edit" href="">Save</a>';
                jqTds[5].innerHTML = '<a class="cancel" href="">Cancel</a>';
            }

            function saveRow(oTable, nRow) {


                var jqOption=$('select',nRow);

                var jqInputs = $('input', nRow);
//                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqOption[0].value, nRow, 0, false);

                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
//                var aData = oTable.fnGetData(nRow);
//
//                oTable.fnUpdate('<tr>'+ aData[0]+'</tr>', nRow, 0, false);
//                oTable.fnUpdate('<tr>'+ jqInputs[1].value+'</tr>', nRow, 1, false);
//                oTable.fnUpdate('<tr>'+ jqInputs[2].value+'</tr>', nRow, 2, false);
//                oTable.fnUpdate('<tr>'+ jqInputs[3].value+'</tr>', nRow, 3, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
                oTable.fnDraw();
            }

            var table = $('#sample_editable_1');

            var oTable = table.dataTable({
                "lengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 10,

                "language": {
                    "lengthMenu": " _MENU_ records"
                },
                "columnDefs": [{ // set default column settings
                    'orderable': true,
                    'targets': [0]
                }, {
                    "searchable": true,
                    "targets": [0]
                }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });

            var tableWrapper = $("#sample_editable_1_wrapper");

            tableWrapper.find(".dataTables_length select").select2({
                showSearchInput: false //hide search box with special css class
            }); // initialize select2 dropdown

            var nEditing = null;
            var nNew = false;

            $('#sample_editable_1_new').click(function (e) {
                e.preventDefault();

                if (nNew && nEditing) {
                    if (confirm("Previose row not saved. Do you want to save it ?")) {
                        saveRow(oTable, nEditing); // save
                        $(nEditing).find("td:first").html("Untitled");
                        nEditing = null;
                        nNew = false;

                    } else {
                        oTable.fnDeleteRow(nEditing); // cancel
                        nEditing = null;
                        nNew = false;

                        return;
                    }
                }

                var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
                nNew = true;
            });

            table.on('click', '.delete', function (e) {
                e.preventDefault();

                if (confirm("Are you sure to delete this row ?") == false) {
                    return;
                }

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                alert("Deleted! Do not forget to do some ajax to sync with backend :)");
            });

            table.on('click', '.cancel', function (e) {
                e.preventDefault();

                if (nNew) {
                    oTable.fnDeleteRow(nEditing);
                    nNew = false;
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            table.on('click', '.edit', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Save") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    nEditing = null;
//                    alert('Stupid');
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        });
    </script>
    @endsection