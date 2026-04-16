@extends('admin.header')

@section('title', 'Edit Rental')

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
    }

    .btn-submit:hover {
        background: #2563eb;
    }

    .current-logo {
        margin-bottom: 10px;
    }

    .current-logo img {
        width: 80px;
        border-radius: 8px;
    }

    @media(max-width:768px){
        .rental-page{
            margin-left: 0;
            padding: 20px;
        }
    }
</style>

<div class="rental-page">
    <div class="rental-card">

        <h2>✏️ Edit Rental</h2>

        {{-- ERRORS --}}
        @if ($errors->any())
            <div style="color:red;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('rentals.update', $rental->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ $rental->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Current Logo</label>
                <div class="current-logo">
                    @if($rental->logo)
                       <img src="{{ asset('storage/'.$rental->logo) }}" width="50">
                    @else
                        <p>No logo</p>
                    @endif
                </div>
                <input type="file" name="logo" class="form-control">
            </div>

            <div class="form-group">
                <label>URL</label>
                <input type="text" name="url" value="{{ $rental->url }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Price (Per Month)</label>
                <input type="number" name="price" value="{{ $rental->price }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control">

                    <option {{ $rental->type=='Agent' ? 'selected' : '' }}>Agent</option>
                    <option {{ $rental->type=='Master' ? 'selected' : '' }}>Master</option>
                    <option {{ $rental->type=='Super Master' ? 'selected' : '' }}>Super Master</option>
                    <option {{ $rental->type=='Admin' ? 'selected' : '' }}>Admin</option>
                    <option {{ $rental->type=='Super Admin' ? 'selected' : '' }}>Super Admin</option>
                    <option {{ $rental->type=='Tech Admin' ? 'selected' : '' }}>Tech Admin</option>
                    <option {{ $rental->type=='Creator' ? 'selected' : '' }}>Creator</option>

                </select>
            </div>

            <button type="submit" class="btn-submit">Update Rental</button>

        </form>

    </div>
</div>

@endsection