@extends('admin.header')

@section('title', 'Rental List')

@section('content')

@include('admin.sidebar')

<style>
    .rental-page {
        margin-left: 260px;
        padding: 30px;
        background: #f8fafc;
        min-height: 100vh;
    }

    .rental-card {
        background: #fff;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h2 {
        font-size: 24px;
        font-weight: 700;
    }

    .btn-add {
        background: #3b82f6;
        color: #fff;
        padding: 10px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        padding: 12px;
        background: #f1f5f9;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    tr:hover {
        background: #f9fafb;
    }

    img {
        border-radius: 6px;
    }

    .btn-edit {
        color: #3b82f6;
        text-decoration: none;
        margin-right: 10px;
    }

    .btn-delete {
        color: red;
        border: none;
        background: none;
        cursor: pointer;
    }

    @media(max-width:768px){
        .rental-page{
            margin-left: 0;
            padding: 20px;
        }

        table, thead, tbody, th, td, tr {
            display: block;
        }

        tr {
            margin-bottom: 15px;
            background: #fff;
            border-radius: 12px;
            padding: 10px;
        }

        td {
            display: flex;
            justify-content: space-between;
        }

        td::before {
            content: attr(data-label);
            font-weight: bold;
        }

        th {
            display: none;
        }
    }
</style>

<div class="rental-page">
    <div class="rental-card">

        <div class="header">
            <h2>ðŸ“¦ Rental Sites</h2>
            <a href="{{ route('rentals.create') }}" class="btn-add">+ Add Rental</a>
        </div>

        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>URL</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($rentals as $rental)
                <tr>
                    <td data-label="Name">{{ $rental->name }}</td>

                    <td data-label="Logo">
                        @if($rental->logo)
                          <img src="{{ asset('storage/'.$rental->logo) }}" width="50">
                        @endif
                    </td>

                    <td data-label="URL">{{ $rental->url }}</td>

                    <td data-label="Price">â‚¹{{ $rental->price }}/month</td>

                    <td data-label="Type">{{ $rental->type }}</td>

                    <td data-label="Action">
                        <a href="{{ route('rentals.edit', $rental->id) }}" class="btn-edit">Edit</a>

                        <form action="{{ route('rentals.delete', $rental->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Delete this?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection