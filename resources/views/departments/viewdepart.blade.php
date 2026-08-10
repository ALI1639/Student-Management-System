@extends('layout')


@section('title')
Department Detail
@endsection


@section('content')
<table class="table table-striped table-border">
    <tr>
        <th width="80px">Name :</th>
        <td>{{ $depart->name }}</td>
    </tr>
    <tr>
        <th>Code :</th>
        <td>{{ $depart->code }}</td>
    </tr>
    <tr>
        <th>Status :</th>
        <td>
            @if($depart->status == 1)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
    </tr>
</table>
<a href="{{ route('departments.index') }}" class="btn btn-danger">Back</a>
@endsection