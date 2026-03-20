@extends('layouts.app')

@section('content')




<style>
.contact-container {
    max-width: 500px;
    margin: 30px auto;
    background: #1a1a1a;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #2a2a2a;
}

.contact-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #fff;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    color: #ccc;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #333;
    background: #111;
    color: #fff;
}

.submit-btn {
    width: 100%;
    padding: 14px;
    border: none;
    background: linear-gradient(135deg, #e99f19, #ffb400);
    color: #000;
    font-weight: 700;
    border-radius: 10px;
    cursor: pointer;
}
</style>

<div class="contact-container">

    <h2>Contact Us</h2>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div style="background:green;padding:10px;border-radius:8px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" name="number" required>
        </div>

        <div class="form-group">
            <label>Website Name</label>
            <input type="text" name="website">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="message" rows="4"></textarea>
        </div>

        <button type="submit" class="submit-btn">Submit</button>

    </form>

</div>

@endsection

