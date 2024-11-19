@extends('layouts')
@section('content')
    <table class="table table-stripped">
        <tr>
            <td>id</td>
            <td>Company Name</td>
            <td>Company Address</td>
            <td>Company Description</td>
        </tr>
        @foreach ($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->company_name }}</td>
            <td>{{ $company->company_address }}</td>
            <td>{{ $company->company_description }}</td>
        </tr>
        @endforeach
    </table>
@endsection
