@extends('layouts.app')

@section('title', 'Login')

@section('content')


<div style="
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f8f8 0%, #ffffff 100%);
    padding: 20px;">




    <div style="
        background: white;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 400px;
        overflow: hidden;">

        <!-- Header -->
        <div style="
            background: linear-gradient(135deg, #2b2e36 0%, #2d2f3a 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        ">
            <h1 style="font-size: 28px; margin-bottom: 8px;">INVENTORY</h1>
            <p style="font-size: 14px; opacity: 0.9;">Fried Chicken Bu Asih</p>
        </div>

        <!-- Form -->
        <div style="padding: 30px;">
            <h2 style="font-size: 22px; margin-bottom: 24px; text-align: center;">Login Admin</h2>

            @if ($errors->any())
                <div style="
                    background-color: #f8d7da;
                    color: #721c24;
                    border: 1px solid #f5c6cb;
                    padding: 12px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                ">
                    <strong>Error:</strong> {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div style="
                    background-color: #d4edda;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                    padding: 12px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                ">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label style="
                        display: block;
                        margin-bottom: 6px;
                        font-weight: 500;
                        color: #333;
                    ">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        style="
                            width: 100%;
                            padding: 10px;
                            border: 1px solid #ddd;
                            border-radius: 4px;
                            font-size: 14px;
                        "
                        placeholder="admin@example.com"
                        required>
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="
                        display: block;
                        margin-bottom: 6px;
                        font-weight: 500;
                        color: #333;
                    ">Password</label>
                    <input type="password" name="password"
                        style="
                            width: 100%;
                            padding: 10px;
                            border: 1px solid #ddd;
                            border-radius: 4px;
                            font-size: 14px;
                        "
                        placeholder="Masukkan password"
                        required>
                </div>

                <button type="submit"
                    style="
                        width: 100%;
                        background: linear-gradient(135deg, #434440 0%, #3b3b36 100%);
                        color: white;
                        padding: 12px;
                        border: none;
                        border-radius: 4px;
                        font-weight: 600;
                        cursor: pointer;
                        font-size: 16px;
                        transition: transform 0.2s;
                    "
                    onmouseover="this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.transform='translateY(0)'">
                    Login
                </button>
            </form>

            <p style="
                text-align: center;
                margin-top: 16px;
                color: #666;
                font-size: 14px;
            ">
                Belum punya akun? 
                <a href="{{ route('register') }}" style="
                    color: #667eea;
                    text-decoration: none;
                    font-weight: 600;
                ">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection