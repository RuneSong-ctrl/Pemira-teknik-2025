@extends('layouts.teknik')

@section('content')
    @php
        $currentDate = now()->format('Y-m-d H:i:s');
        $startDate = date('Y-m-d', strtotime('2025-12-18'));
        $voteDate = date('Y-m-d', strtotime('2025-12-31'));
    @endphp

<div class="login-wrapper">
    <div class="login-container">
        
        <div class="login-visual">
            <div class="visual-content">
                <div class="icon-box">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2>Registrasi<br>Pemilih</h2>
                <p>Sistem E-Voting Pemira<br>Fakultas Teknik 2025</p>
            </div>
            <div class="visual-pattern"></div>
        </div>

        <div class="login-form-section">
            <div class="form-content-wide">
                
                @if ($currentDate < $startDate)
                    <div class="state-message">
                        <div class="state-icon">⏳</div>
                        <h3>Pendaftaran Belum Dibuka</h3>
                        <p>Silakan kembali pada tanggal<br><strong>18 - 20 Desember 2025</strong></p>
                        <a href="/" class="btn-outline">Kembali ke Beranda</a>
                    </div>

                @elseif ($currentDate >= $startDate && $currentDate < $voteDate)
                    <div class="form-header">
                        <h3>Buat Akun Baru</h3>
                        <p>Lengkapi data diri Anda untuk validasi</p>
                    </div>

                    <form action="/register" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-grid">
                            <div class="input-group">
                                <label for="nim">NIM</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-id-card input-icon"></i>
                                    <input type="text" 
                                           name="register_nim" 
                                           id="nim" 
                                           class="form-control @error('register_nim') is-invalid @enderror"
                                           placeholder="NIM"
                                           maxlength="10" 
                                           value="{{ old('register_nim') }}"
                                           required>
                                </div>
                                @error('register_nim')
                                    <span class="error-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label for="nama">Nama</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" 
                                           name="nama" 
                                           id="nama" 
                                           class="form-control disabled-input @error('nama_hidden') is-invalid @enderror" 
                                           placeholder="Otomatis"
                                           disabled 
                                           value="{{ old('nama_hidden') }}">
                                    <input type="hidden" name="nama_hidden" id="nama_hidden" value="{{ old('nama_hidden') }}">
                                </div>
                                @error('nama_hidden')
                                    <span class="error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="input-group">
                                <label for="pwdId">Password</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" 
                                           name="register_password" 
                                           id="pwdId" 
                                           class="form-control @error('register_password') is-invalid @enderror"
                                           placeholder="Password" 
                                           pattern="^[0-9a-zA-Z]{2,30}$" 
                                           required>
                                </div>
                                @error('register_password')
                                    <span class="error-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label for="cPwdId">Konfirmasi</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-check-circle input-icon"></i>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           id="cPwdId"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           placeholder="Ulangi Pass" 
                                           pattern="^[0-9a-zA-Z]{2,30}$" 
                                           required>
                                </div>
                                @error('password_confirmation')
                                    <span class="error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group">
                            <label>Scan KTM/KRM/UKT <small style="color:#6b7280; font-weight:normal;">(*Maks 2MB)</small></label>
                            <div class="input-wrapper">
                                <i class="fas fa-cloud-upload-alt input-icon"></i>
                                <input type="file" 
                                       name="file_url" 
                                       id="customFile" 
                                       class="form-control file-input @error('file_url') is-invalid @enderror"
                                       accept="image/*" 
                                       required
                                       onchange="previewImage(this)">
                            </div>
                            @error('file_url')
                                <span class="error-msg">{{ $message }}</span>
                            @enderror

                            <div id="preview-container" style="display: none;">
                                <div class="preview-box">
                                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                        <span class="preview-label">Preview File:</span>
                                        <button type="button" class="btn-remove-img" onclick="removeImage()">
                                            <i class="fas fa-times"></i> Hapus
                                        </button>
                                    </div>
                                    <img id="img-preview" src="#" alt="Preview Gambar" />
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Daftar Sekarang</button>
                    </form>

                    <div class="form-footer">
                        <p>Sudah punya akun? <a href="/login">Login</a></p>
                    </div>

                @else
                    <div class="state-message">
                        <div class="state-icon">🚫</div>
                        <h3>Pendaftaran Ditutup</h3>
                        <p>Masa pendaftaran telah berakhir.</p>
                        <a href="/login" class="submit-btn" style="width:auto; padding: 10px 30px; margin-top:15px; text-decoration:none; display:inline-block;">Masuk Aplikasi</a>
                    </div>
                @endif
                
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
    // Logic Autocomplete Nama dari NIM
    $(document).ready(function() {
        $('#nim').on('input', function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('autocomplete.fetch') }}",
                    method: "POST",
                    data: { query: query, _token: _token },
                    success: function(data) {
                        $('#nama').val(data);
                        $('#nama_hidden').val(data);
                    }
                });
            }
        });
    });

    // Input Filter (Hanya Angka untuk NIM)
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

    // --- LOGIC PREVIEW GAMBAR ---
    function previewImage(input) {
        var previewContainer = document.getElementById('preview-container');
        var previewImage = document.getElementById('img-preview');
        var file = input.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            removeImage();
        }
    }

    function removeImage() {
        var input = document.getElementById('customFile');
        var previewContainer = document.getElementById('preview-container');
        var previewImage = document.getElementById('img-preview');
        
        input.value = ""; 
        previewImage.src = "#"; 
        previewContainer.style.display = 'none'; 
    }
</script>

<style>
    /* UTAMA: Wrapper & Container */
    .login-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px; 
    }

    .login-container {
        display: flex;
        width: 900px; 
        max-width: 100%;
        min-height: 550px; 
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        position: relative;
    }

   
    .login-visual {
        flex: 0.8; /* Rasio tetap */
        background: linear-gradient(135deg, #810000 0%, #4a0000 100%);
        padding: 40px 30px; /* Padding dikurangi */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        position: relative;
    }

    .visual-content { position: relative; z-index: 2; width: 100%; }
    
    .icon-box {
        font-size: 3rem;
        margin-bottom: 20px;
        color: rgba(255, 255, 255, 0.9);
    }

    .login-visual h2 {
        font-size: 1.8rem; 
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .login-visual p {
        font-size: 0.9rem;
        opacity: 0.8;
        font-weight: 300;
        line-height: 1.5;
    }

    .visual-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px; z-index: 1; opacity: 0.6;
    }

    /* BAGIAN KANAN: FORM */
    .login-form-section {
        flex: 1.2;
        padding: 35px 40px; 
        background: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header { margin-bottom: 25px; }
    .form-header h3 { font-size: 1.5rem; font-weight: 800; color: #111827; margin-bottom: 5px; }
    .form-header p { color: #6b7280; font-size: 0.9rem; }

    /* GRID SYSTEM */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px; /* Gap diperkecil */
        margin-bottom: 0;
    }

    .input-group { margin-bottom: 15px; }
    
    .input-group label {
        display: block; margin-bottom: 6px; font-weight: 600;
        font-size: 0.85rem; color: #374151;
    }

    .input-wrapper { position: relative; }
    
    .input-icon {
        position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
        color: #9ca3af; font-size: 1rem; z-index: 10;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px 10px 15px; 
        font-size: 0.9rem;
        color: #1f2937;
        background-color: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        transition: all 0.3s ease;
        outline: none;
        height: 44px;
        text-align: left;
    }
    
    .form-control.file-input { padding-top: 8px; height: 44px; cursor: pointer; }
    .form-control:focus { background-color: #ffffff; border-color: #810000; box-shadow: 0 0 0 3px rgba(129, 0, 0, 0.1); }
    .disabled-input { background-color: #f3f4f6; color: #6b7280; cursor: not-allowed; border-color: #e5e7eb; }
    .form-control.is-invalid { border-color: #ef4444; background-color: #fff5f5; }
    .error-msg { display: block; margin-top: 4px; font-size: 0.75rem; color: #ef4444; font-weight: 500; }

    /* TOMBOL */
    .submit-btn {
        width: 100%; padding: 12px;
        background-color: #810000; color: white;
        font-weight: 700; font-size: 0.95rem;
        border: none; border-radius: 8px;
        cursor: pointer; transition: all 0.3s ease;
        text-transform: uppercase; letter-spacing: 0.5px;
        margin-top: 10px;
        box-shadow: 0 4px 6px rgba(129, 0, 0, 0.2);
    }
    .submit-btn:hover { background-color: #660000; transform: translateY(-2px); }

    .btn-outline {
        display: inline-block; padding: 10px 20px;
        border: 2px solid #810000; color: #810000;
        font-weight: 600; font-size: 0.9rem;
        border-radius: 8px; text-decoration: none;
        transition: all 0.3s; margin-top: 15px;
    }
    .btn-outline:hover { background-color: #810000; color: white; }

    .form-footer { margin-top: 20px; text-align: center; font-size: 0.85rem; color: #6b7280; }
    .form-footer a { color: #810000; font-weight: 700; text-decoration: none; }
    .form-footer a:hover { text-decoration: underline; }

    /* STATE MESSAGE (Belum Buka/Tutup) */
    .state-message { text-align: center; padding: 10px; }
    .state-icon { font-size: 3rem; margin-bottom: 15px; }
    .state-message h3 { font-size: 1.3rem; margin-bottom: 8px; }

    /* STYLE KHUSUS PREVIEW GAMBAR */
    #preview-container { margin-top: 12px; animation: fadeIn 0.4s; }
    .preview-box {
        border: 2px dashed #d1d5db; padding: 12px;
        border-radius: 10px; background: #f9fafb;
    }
    .preview-label { font-size: 0.8rem; color: #6b7280; font-weight: 600; }
    #img-preview {
        display: block; width: 100%; height: auto;
        max-height: 200px; 
        object-fit: contain; border-radius: 6px; margin-top: 5px;
    }
    .btn-remove-img {
        background: transparent; color: #ef4444; border: none;
        font-size: 0.8rem; font-weight: 600; cursor: pointer;
    }
    .btn-remove-img:hover { text-decoration: underline; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

    /* RESPONSIVE */
    @media screen and (max-width: 900px) {
        .login-container { flex-direction: column; width: 500px; min-height: auto; }
        .login-visual { padding: 30px 20px; min-height: 150px; flex: unset; }
        .login-visual h2 { font-size: 1.5rem; }
        .icon-box { font-size: 2.2rem; margin-bottom: 10px; }
        .login-form-section { padding: 30px; flex: unset; }
        .form-grid { grid-template-columns: 1fr; gap: 0; }
    }
    @media screen and (max-width: 520px) {
        .login-wrapper { padding: 10px; align-items: flex-start; }
        .login-container { width: 100%; margin-top: 10px; }
    }
</style>
@endsection