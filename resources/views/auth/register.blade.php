@extends('layouts.teknik')

@section('content')
    {{-- Logika Tanggal (Dipertahankan dari kode lama) --}}
    @php
        $currentDate = now()->format('Y-m-d H:i:s');
        $startDate = date('Y-m-d', strtotime('2025-12-18'));
        $voteDate = date('Y-m-d', strtotime('2025-12-20'));
    @endphp

<div class="auth-wrapper">
    <div class="auth-split-card">
        
        <div class="auth-visual-side">
            <div class="visual-content">
                <div class="logo-area">
                    <i class="fas fa-user-plus" style="font-size: 3.5rem; margin-bottom: 20px; display:block;"></i>
                </div>
                <h2>Registrasi<br>Pemilih</h2>
                <p>Sistem E-Voting Pemira<br>Fakultas Teknik 2025</p>
                <div class="visual-footer">
                    <small>&copy; 2025 Fakultas Teknik Universitas Udayana</small>
                </div>
            </div>
            <div class="overlay-pattern"></div>
        </div>

        <div class="auth-form-side">
            
            {{-- KONDISI 1: Belum Mulai --}}
            @if ($currentDate < $startDate)
                <div class="state-message">
                    <div class="icon-state">⏳</div>
                    <h3>Pendaftaran Belum Dibuka</h3>
                    <p>Silahkan kembali pada tanggal <br><strong>18 - 20 Desember 2025</strong><br>untuk melakukan registrasi.</p>
                    <a href="/" class="btn-outline">Kembali ke Beranda</a>
                </div>

            {{-- KONDISI 2: Masa Registrasi (Form Asli) --}}
            @elseif ($currentDate >= $startDate && $currentDate < $voteDate)
                <div class="form-header">
                    <h3>Buat Akun Baru</h3>
                    <p>Lengkapi data diri Anda untuk validasi</p>
                </div>

                <form action="/register" method="POST" enctype="multipart/form-data" class="auth-form">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" 
                                   name="register_nim" 
                                   id="nim" 
                                   class="form-input @error('register_nim') is-invalid @enderror"
                                   placeholder="Masukan NIM"
                                   maxlength="10" 
                                   value="{{ old('register_nim') }}"
                                   required>
                            @error('register_nim')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" 
                                   name="nama" 
                                   id="nama" 
                                   class="form-input disabled-input @error('nama_hidden') is-invalid @enderror" 
                                   placeholder="Otomatis dari NIM"
                                   disabled 
                                   value="{{ old('nama_hidden') }}"
                                   style="cursor: not-allowed">
                            
                            <input type="hidden" name="nama_hidden" id="nama_hidden" value="{{ old('nama_hidden') }}">
                            
                            @error('nama_hidden')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="pwdId">Password</label>
                            <input type="password" 
                                   name="register_password" 
                                   id="pwdId" 
                                   class="form-input @error('register_password') is-invalid @enderror"
                                   placeholder="Buat Password" 
                                   pattern="^[0-9a-zA-Z]{2,30}$" 
                                   required>
                            @error('register_password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cPwdId">Konfirmasi Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="cPwdId"
                                   class="form-input @error('password_confirmation') is-invalid @enderror"
                                   placeholder="Ulangi Password" 
                                   pattern="^[0-9a-zA-Z]{2,30}$" 
                                   required>
                            @error('password_confirmation')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Scan KTM/KRM/UKT Ku <small style="color:#666; font-weight:normal;">(*Maks 2MB)</small></label>
                        <div class="file-input-wrapper">
                            <input type="file" 
                                   name="file_url" 
                                   id="customFile" 
                                   class="form-input-file @error('file_url') is-invalid @enderror"
                                   accept="image/*" 
                                   required>
                        </div>
                        @error('file_url')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Daftar Sekarang</button>
                    </div>
                </form>

                <div class="auth-footer">
                    <p>Sudah punya akun? <a href="/login">Login sekarang</a></p>
                </div>

            {{-- KONDISI 3: Sudah Tutup --}}
            @else
                <div class="state-message">
                    <div class="icon-state">🚫</div>
                    <h3>Pendaftaran Ditutup</h3>
                    <p>Masa pendaftaran telah berakhir.<br>Silahkan login untuk melakukan polling.</p>
                    <a href="/login" class="btn-primary" style="display:inline-block; width:auto; padding: 12px 35px;">Masuk Aplikasi</a>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Script Asli Dipertahankan --}}
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/vendor/jquery.cookie/jquery.cookie.min.js"></script>
<script src="/js/app.js"></script>
<script src="/js/auth.js"></script>

<script>
    $(document).ready(function() {
        // Logika AJAX untuk ambil nama dari NIM
        $('#nim').on('input', function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('autocomplete.fetch') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#nama').val(data);
                        $('#nama_hidden').val(data);
                    }
                });
            }
        });
    });

    (function($) {
        // Filter input angka
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
    /* === LAYOUT UTAMA === */
    .auth-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 85vh;
        width: 100%;
        padding: 20px;
        background: transparent; 
    }

    /* === CARD CONTAINER (SPLIT) === */
    .auth-split-card {
        display: flex;
        width: 100%;
        max-width: 950px; /* Lebar optimal untuk Laptop */
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        min-height: 580px;
    }

    /* === BAGIAN KIRI: VISUAL & UKIRAN === */
    .auth-visual-side {
        flex: 0.8;
        background: linear-gradient(135deg, #810000 0%, #4a0000 100%);
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
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        line-height: 1.2;
    }

    .visual-content p {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 300;
        line-height: 1.6;
    }

    .visual-footer {
        margin-top: 50px;
        opacity: 0.5;
        font-size: 0.8rem;
    }

    /* Ini Pattern/Ukiran Halus di Background Merah */
    .overlay-pattern {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        /* Motif titik halus */
        background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0);
        background-size: 20px 20px;
        z-index: 1;
    }

    /* === BAGIAN KANAN: FORM === */
    .auth-form-side {
        flex: 1.2;
        background: #ffffff;
        padding: 40px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header {
        margin-bottom: 25px;
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

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Grid Layout: 2 Kolom untuk Input agar lebar di Laptop */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
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

    /* Styling Input Modern */
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        background-color: #f9fafb;
        color: #1f2937;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-input:focus {
        background-color: #fff;
        border-color: #810000;
    }

    .form-input.disabled-input {
        background-color: #e9ecef;
        cursor: not-allowed;
        color: #6c757d;
        border-color: #dee2e6;
    }

    /* Styling Input File */
    .form-input-file {
        width: 100%;
        padding: 10px;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s;
    }

    .form-input-file:hover {
        border-color: #810000;
        background: #fff;
    }

    /* Error Text */
    .error-text {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 4px;
    }

    .is-invalid {
        border-color: #ef4444 !important;
        background-color: #fff5f5 !important;
    }

    /* Tombol Utama */
    .btn-primary {
        width: 100%;
        padding: 14px;
        background-color: #810000;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 5px;
    }

    .btn-primary:hover {
        background-color: #a00000;
    }
    
    .btn-outline {
        padding: 12px 25px;
        border: 2px solid #810000;
        color: #810000;
        text-decoration: none;
        font-weight: 600;
        border-radius: 8px;
        display: inline-block;
        transition: all 0.2s;
        margin-top: 15px;
    }

    .btn-outline:hover {
        background: #810000;
        color: white;
    }

    .auth-footer {
        margin-top: 25px;
        text-align: center;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .auth-footer a {
        color: #810000;
        font-weight: 600;
        text-decoration: none;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }

    /* Pesan Status (Tutup/Belum Buka) */
    .state-message {
        text-align: center;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
    
    .icon-state {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .state-message h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .state-message p {
        color: #666;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    /* === RESPONSIVE (HP) === */
    @media screen and (max-width: 768px) {
        .auth-split-card {
            flex-direction: column;
            max-width: 450px;
            min-height: auto;
        }

        .auth-visual-side {
            padding: 30px 20px;
            min-height: 140px;
        }
        
        .visual-content h2 { font-size: 1.4rem; }
        .visual-content p, .visual-footer { display: none; }

        .auth-form-side {
            padding: 30px 20px;
        }

        .form-row {
            grid-template-columns: 1fr; /* Stack inputs jadi 1 kolom di HP */
            gap: 15px;
        }
    }
</style>
@endsection