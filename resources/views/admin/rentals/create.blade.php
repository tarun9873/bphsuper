@extends('admin.header')

@section('title', 'Add Rental')

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
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: auto;
    }

    .rental-card h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    .btn-submit {
        background: #3b82f6;
        color: #fff;
        padding: 12px 25px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #2563eb;
    }

    /* ✅ MOBILE FIX */
    @media(max-width:768px){
        .rental-page{
            margin-left: 0;
            padding: 20px;
        }
    }
</style>

<div class="rental-page">
    <div class="rental-card">

        <h2>➕ Add Rental Site</h2>

        {{-- SUCCESS --}}
        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        {{-- ERRORS --}}
        @if ($errors->any())
            <div style="color:red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('rentals.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
            </div>

            <div class="form-group">
                <label>URL</label>
                <input type="text" name="url" class="form-control">
            </div>

            <div class="form-group">
                <label>Per Month Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>



            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option>Agent</option>
                    <option>Master</option>
                    <option>Super Master</option>
                    <option>Admin</option>
                    <option>Super Admin</option>
                    <option>Tech Admin</option>
                    <option>Creator</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Save Rental</button>

        </form>
    </div>
</div>

@endsection