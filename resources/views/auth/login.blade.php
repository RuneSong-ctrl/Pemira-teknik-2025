@extends('layouts.teknik')

@section('content')
<div class="login-wrapper">
    <div class="login-split-card">
        
        <div class="login-visual-side">
            <div class="visual-content">
                <div class="logo-area">
                    <i class="fas fa-university" style="font-size: 3rem; margin-bottom: 20px; display:block;"></i>
                </div>
                <h2>Sistem Informasi<br>Musma 2025</h2>
                <p>Web E-Voting Pemira Teknik 2025</p>
                
            </div>
            <div class="overlay-pattern"></div>
        </div>

        <div class="login-form-side">
            <div class="form-header">
                <h3>Selamat Datang</h3>
                <p>Silakan login dengan akun Anda</p>
            </div>

            <form action="/login" method="POST" class="login-form">
                @csrf
                
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" 
                           class="form-input @error('nim') is-invalid @enderror" 
                           name="nim" 
                           id="nim"
                           value="{{ old('nim') }}" 
                           placeholder="Contoh: 21055510xx" 
                           maxlength="10" 
                           required>
                    @error('nim')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-input @error('password') is-invalid @enderror" 
                           id="password"
                           placeholder="Masukan Password" 
                           required>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">Masuk Aplikasi</button>
                </div>
            </form>

            <div class="login-footer">
                <p>Belum punya akun? <a href="/register">Daftar sekarang</a></p>
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
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 85vh;
        width: 100%;
        padding: 20px;
        /* Biarkan transparan agar background layout utama terlihat */
        background: transparent; 
    }

    /* Kartu Utama (Split Layout) */
    .login-split-card {
        display: flex;
        width: 100%;
        max-width: 900px; /* Lebar card diperbesar untuk laptop */
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden; /* Agar sudut rounded tidak bocor */
        box-shadow: 0 20px 50px rgba(0,0,0,0.15); /* Shadow besar agar elegan */
        min-height: 550px;
    }

    /* --- BAGIAN KIRI (VISUAL) --- */
    .login-visual-side {
        flex: 1; /* Mengambil 50% lebar */
        background: linear-gradient(135deg, #810000 0%, #4a0000 100%); /* Merah Teknik */
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        padding: 40px;
        text-align: center;
    }

    .visual-content {
        position: relative;
        z-index: 2;
    }

    .visual-content h2 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    .visual-content p {
        font-size: 1.1rem;
        opacity: 0.8;
        font-weight: 300;
    }

    .visual-footer {
        margin-top: 50px;
        opacity: 0.5;
        font-size: 0.8rem;
    }

    /* Pattern Halus di Background Merah */
    .overlay-pattern {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0);
        background-size: 20px 20px;
        z-index: 1;
    }

    /* --- BAGIAN KANAN (FORM) --- */
    .login-form-side {
        flex: 1.2; /* Sedikit lebih lebar dari bagian visual agar form lega */
        background: #ffffff;
        padding: 50px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header {
        margin-bottom: 30px;
    }

    .form-header h3 {
        color: #1a1a1a;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .form-header p {
        color: #666;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border-radius: 8px;
        border: 2px solid #e5e7eb; /* Border lebih tebal dikit */
        background-color: #f9fafb;
        color: #1f2937;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-input:focus {
        background-color: #fff;
        border-color: #810000;
    }

    .form-input.is-invalid {
        border-color: #ef4444;
        background-color: #fff5f5;
    }

    .error-text {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 4px;
    }

    .btn-primary {
        width: 100%;
        padding: 16px;
        background-color: #810000;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.1s;
        margin-top: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary:hover {
        background-color: #a00000;
    }

    .login-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .login-footer a {
        color: #810000;
        font-weight: 600;
        text-decoration: none;
    }
    
    .login-footer a:hover {
        text-decoration: underline;
    }

    /* --- RESPONSIVE (HP) --- */
    @media screen and (max-width: 768px) {
        .login-split-card {
            flex-direction: column; /* Tumpuk ke bawah */
            max-width: 450px; /* Batasi lebar di HP */
            min-height: auto;
        }

        .login-visual-side {
            padding: 30px 20px;
            min-height: 150px; /* Pendekkan bagian visual di HP */
        }
        
        .visual-content h2 {
            font-size: 1.5rem;
        }
        
        .visual-footer {
            display: none; /* Sembunyikan footer copyright di HP */
        }

        .login-form-side {
            padding: 30px 25px;
        }
    }
</style>
@endsection