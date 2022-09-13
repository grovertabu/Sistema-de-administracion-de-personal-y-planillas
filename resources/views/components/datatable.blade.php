@if($buttons)
    @section('css')
    @parent
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/datatables.min.css" /> --}}
    <style>.printer table{counter-reset: rowNumber}.printer tr{counter-increment: rowNumber}.printer tr td:first-child::before{content: counter(rowNumber);min-width: 1em;margin-right: 0.5em} </style>
    @endsection

@endif

@if($beautify)
{{-- <style>#{{$id}} tbody tr td { vertical-align: middle; }</style> --}}
@endif
<div class="table table-bordered table-hover dataTable table-responsive">
    <table id="{{$id}}" class="table table-striped table-bordered table-condensed nowrap data_table" style="width:100%" >
        <thead>
            <tr>
                @foreach($heads as $th)
                <th>{{$th}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
