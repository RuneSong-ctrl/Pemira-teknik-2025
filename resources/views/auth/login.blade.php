@extends('layouts.teknik')

@section('content')

<div class="login-wrapper">
    <div class="login-container">
        <div class="login-visual">
            <div class="visual-content">
                <div class="icon-box">
                    <i class="fas fa-university"></i>
                </div>
                <h2>Musma<br>2025</h2>
                <p>E-Voting Pemira Teknik</p>
            </div>
            <div class="visual-pattern"></div>
        </div>

        <div class="login-form-section">
            <div class="form-content">
                <div class="form-header">
                    <h3>Selamat Datang</h3>
                    <p>Silakan login untuk melanjutkan</p>
                </div>

                <form action="/login" method="POST">
                    @csrf
                    
                    <div class="form-grid">
                        <div class="input-group">
                            <label for="nim">NIM</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" 
                                       class="form-control @error('nim') is-invalid @enderror" 
                                       name="nim" 
                                       id="nim"
                                       value="{{ old('nim') }}" 
                                       placeholder="NIM" 
                                       maxlength="10" 
                                       required>
                            </div>
                            @error('nim')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" 
                                       name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password"
                                       placeholder="Password" 
                                       required>
                            </div>
                            @error('password')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        Masuk Aplikasi
                    </button>
                </form>

                <div class="form-footer">
                    <p>Belum punya akun? <a href="/register">Daftar sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="/js/app.js"></script>
<script src="/js/auth.js"></script>

<script>
    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        };
    }(jQuery));

    $("#nim").inputFilter(function(value) {
        return /^-?\d*$/.test(value);
    });
</script>

<style>
    /* Wrapper Utama */
    .login-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        background: transparent;
    }

    /* Container Card - Compact Size (800px) */
    .login-container {
        display: flex;
        width: 800px; 
        max-width: 100%;
        min-height: 450px; /* Tinggi disesuaikan lagi agar pas */
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        position: relative;
    }

    /* Bagian Visual (Kiri) */
    .login-visual {
        flex: 0.8;
        background: linear-gradient(135deg, #810000 0%, #4a0000 100%);
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        position: relative;
        z-index: 1;
    }

    .visual-content { position: relative; z-index: 2; width: 100%; }

    .icon-box {
        font-size: 2.5rem;
        margin-bottom: 15px;
        color: rgba(255, 255, 255, 0.9);
    }

    .login-visual h2 {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .login-visual p {
        font-size: 0.9rem;
        opacity: 0.8;
        font-weight: 300;
    }

    .visual-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px; z-index: 1; opacity: 0.6;
    }

    /* Bagian Form (Kanan) */
    .login-form-section {
        flex: 1.2;
        padding: 40px 50px; /* Padding samping ditambah sedikit */
        background: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-content { width: 100%; }

    .form-header { margin-bottom: 25px; text-align: left; }
    .form-header h3 { font-size: 1.5rem; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .form-header p { color: #6b7280; font-size: 0.9rem; }

    /* --- GRID SYSTEM UNTUK PROPORSIONAL --- */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; /* 2 Kolom Seimbang */
        gap: 15px; /* Jarak antar kolom */
        margin-bottom: 5px;
    }

    /* Input Styling */
    .input-group { margin-bottom: 15px; }
    .input-group label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 0.85rem; color: #374151; }
    .input-wrapper { position: relative; }
    
    .input-icon {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; font-size: 1rem; z-index: 10;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px 10px 40px;
        font-size: 0.9rem;
        color: #1f2937;
        background-color: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        transition: all 0.3s ease;
        outline: none;
        height: 44px;
    }

    .form-control:focus {
        background-color: #ffffff; border-color: #810000;
        box-shadow: 0 0 0 3px rgba(129, 0, 0, 0.1);
    }
    .form-control.is-invalid { border-color: #ef4444; background-color: #fff5f5; }
    .error-msg { display: block; margin-top: 4px; font-size: 0.75rem; color: #ef4444; font-weight: 500; }

    /* Tombol */
    .submit-btn {
        width: 100%; padding: 12px;
        background-color: #810000; color: white;
        font-weight: 700; font-size: 0.95rem;
        border: none; border-radius: 10px;
        cursor: pointer; transition: all 0.3s ease;
        text-transform: uppercase; letter-spacing: 0.5px;
        margin-top: 10px;
        box-shadow: 0 4px 6px rgba(129, 0, 0, 0.2);
    }
    .submit-btn:hover { background-color: #660000; transform: translateY(-2px); }

    .form-footer { margin-top: 20px; text-align: center; font-size: 0.85rem; color: #6b7280; }
    .form-footer a { color: #810000; font-weight: 700; text-decoration: none; }
    .form-footer a:hover { color: #660000; text-decoration: underline; }

    /* Responsif untuk Tablet & HP */
    @media screen and (max-width: 850px) {
        .login-container { flex-direction: column; width: 450px; min-height: auto; }
        .login-visual { padding: 30px 20px; min-height: 160px; flex: unset; }
        .form-grid { grid-template-columns: 1fr; gap: 0; } /* Kembali ke 1 kolom di layar kecil */
        .login-form-section { padding: 30px; flex: unset; }
    }

    @media screen and (max-width: 480px) {
        .login-wrapper { padding: 15px; align-items: flex-start; }
        .login-container { width: 100%; border-radius: 16px; margin-top: 10px; }
        .form-header h3 { font-size: 1.4rem; }
    }
</style>
@endsection