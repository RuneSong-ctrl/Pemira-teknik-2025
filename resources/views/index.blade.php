@extends('layouts/master', ['title' => 'Musma Teknik 2025 '])
@section('content')
    @php
        $currentDate = now()->format('Y-m-d H:i:s');
        $startDate = '2025-01-10 06:00:00';
        $endDate = '2025-01-10 23:59:59';
    @endphp

    <style>
        :root {
            --musma-maroon: #660000;
            --musma-dark-maroon: #2b0000;
            --musma-red: #990000;
            --musma-gold: #D4AF37;
            --musma-gold-light: #F1D570;
            --musma-black: #111111;
            --musma-white: #FFFFFF;
            --musma-gray: #f9f9f9;
        }

        body {
            background-color: var(--musma-white) !important;
            color: var(--musma-black);
            overflow-x: hidden;
        }

        .text-musma-maroon { color: var(--musma-maroon) !important; }
        .bg-musma-maroon { background-color: var(--musma-maroon) !important; color: white; }

        /* --- HERO SECTION --- */
        .hero-fullscreen {
            position: relative;
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: 
                linear-gradient(to bottom, rgba(43, 0, 0, 0.8), rgba(20, 0, 0, 0.6)), 
                url('img/Untitled-3.png');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
            text-align: center;
            color: white;
            padding: 140px 20px 40px 20px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            width: 100%;
        }

        .hero-badge {
            display: inline-block;
            padding: 12px 30px;
            border: 1px solid var(--musma-gold);
            color: var(--musma-gold-light);
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.9rem;
            font-weight: 700;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .hero-title {
            font-size: 6.5rem;
            font-weight: 900;
            line-height: 0.85;
            margin-bottom: 10px;
            color: #ffffff;
            text-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }

        .hero-subtitle {
            font-size: 6.5rem;
            font-weight: 900;
            line-height: 0.85;
            color: transparent;
            -webkit-text-stroke: 2px var(--musma-gold);
            margin-bottom: 15px;
            text-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .hero-year {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--musma-gold);
            letter-spacing: 12px;
            margin-bottom: 40px;
            text-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        .hero-desc {
            font-size: 1.6rem; 
            color: #ffffff;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: 50px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 3px 8px rgba(0,0,0,0.9); 
        }

        .btn-hero-cta {
            background: linear-gradient(45deg, var(--musma-gold), var(--musma-gold-light));
            color: var(--musma-dark-maroon);
            padding: 20px 55px;
            font-weight: 800;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(212, 175, 55, 0.5);
            color: var(--musma-maroon);
            text-decoration: none;
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255,255,255,0.5);
            color: white;
            padding: 20px 45px;
            font-weight: 700;
            border-radius: 50px;
            margin-left: 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero-secondary:hover {
            background: white;
            color: var(--musma-maroon);
            text-decoration: none;
        }

        .section-about { padding: 100px 0; background-color: var(--musma-white); position: relative; }
        .about-heading { font-size: 2.5rem; font-weight: 800; color: var(--musma-maroon); margin-bottom: 20px; position: relative; display: inline-block; }
        .about-heading::after { content: ''; display: block; width: 50%; height: 4px; background: var(--musma-gold); margin: 15px auto 0; border-radius: 2px; }
        .about-text { font-size: 1.1rem; color: #555; line-height: 1.8; max-width: 800px; margin: 0 auto 60px; }
        .about-card { background: white; border: 1px solid #eee; padding: 40px 30px; border-radius: 20px; transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden; z-index: 1; }
        .about-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 0; background: var(--musma-maroon); transition: all 0.4s ease; z-index: -1; }
        .about-card:hover::before { height: 100%; }
        .about-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: var(--musma-maroon); }
        .about-card:hover h4, .about-card:hover p, .about-card:hover .icon-box i { color: white !important; }
        .about-card .icon-box { width: 80px; height: 80px; background: var(--musma-gray); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 2rem; color: var(--musma-red); transition: all 0.4s; }
        .about-card:hover .icon-box { background: rgba(255,255,255,0.2); }

        .poll-status-alert { background: white; border-left: 5px solid var(--musma-gold); padding: 25px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .candidate-card-label { display: block; cursor: pointer; position: relative; height: 100%; }
        .candidate-card-label input[type="radio"] { position: absolute; opacity: 0; cursor: pointer; }
        .candidate-card-inner { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border: 2px solid transparent; transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column; }
        .candidate-card-label input[type="radio"]:checked + .candidate-card-inner { border-color: var(--musma-red); box-shadow: 0 10px 30px rgba(153, 0, 0, 0.2); transform: translateY(-5px); }
        .candidate-img-wrapper { height: 320px; overflow: hidden; position: relative; background-color: #f0f0f0; }
        .candidate-img-wrapper img { width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.5s ease; }
        .candidate-card-label:hover .candidate-img-wrapper img { transform: scale(1.03); }
        .candidate-info { padding: 20px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; background: white; }
        .candidate-name { font-size: 1.3rem; font-weight: 800; color: var(--musma-black); margin-bottom: 15px; }
        .selected-indicator { position: absolute; top: 15px; right: 15px; background: var(--musma-gold); color: var(--musma-maroon); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; opacity: 0; transform: scale(0); transition: all 0.3s; z-index: 5; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        .candidate-card-label input[type="radio"]:checked + .candidate-card-inner .selected-indicator { opacity: 1; transform: scale(1); }
        
        .footer-modern { background-color: var(--musma-dark-maroon); padding: 80px 0 40px; color: white; }
        .footer-map-container { border-radius: 20px; overflow: hidden; height: 100%; min-height: 350px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); border: 2px solid rgba(255,255,255,0.1); }
        .footer-info-card { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 40px; height: 100%; backdrop-filter: blur(10px); }
        .footer-title { color: var(--musma-gold); font-weight: 800; font-size: 2rem; margin-bottom: 30px; letter-spacing: -1px; }
        .contact-list-item { display: flex; align-items: flex-start; margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .contact-list-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .contact-icon { font-size: 1.5rem; color: var(--musma-gold); margin-right: 20px; width: 30px; text-align: center; }
        .contact-details h5 { color: white; font-weight: 700; margin-bottom: 5px; font-size: 1.1rem; }
        .contact-details a, .contact-details p { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.95rem; display: block; transition: color 0.3s; }
        .contact-details a:hover { color: var(--musma-gold-light); }

        .btn-musma-primary { background-color: var(--musma-maroon); color: white; font-weight: 700; padding: 12px 40px; border-radius: 50px; border: none; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(102, 0, 0, 0.3); }
        .btn-musma-primary:hover { background-color: var(--musma-red); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102, 0, 0, 0.4); color: white; }
        .btn-musma-outline { background: transparent; border: 2px solid var(--musma-maroon); color: var(--musma-maroon); font-weight: 600; padding: 8px 20px; border-radius: 50px; transition: all 0.3s; }
        .btn-musma-outline:hover { background: var(--musma-maroon); color: white; }

        /* --- TIMELINE MODAL --- */
        .musma-timeline { position: relative; padding-left: 40px; margin: 20px 0; }
        .musma-timeline::before { content: ''; position: absolute; top: 0; left: 15px; height: 100%; width: 3px; background: #eee; border-radius: 2px; }
        .timeline-item { position: relative; margin-bottom: 40px; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-marker { position: absolute; top: 0; left: -40px; width: 34px; height: 34px; background: var(--musma-maroon); border: 3px solid var(--musma-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem; z-index: 2; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .timeline-content { background: white; border: 1px solid #eee; border-radius: 12px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.3s; }
        .timeline-content:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); border-color: var(--musma-gold); }
        .timeline-title { color: var(--musma-maroon); font-weight: 800; font-size: 1.1rem; margin-bottom: 10px; display: flex; align-items: center; }
        .timeline-text { font-size: 0.95rem; color: #555; line-height: 1.6; margin: 0; }
        .timeline-link { color: var(--musma-red); font-weight: 700; text-decoration: none; }
        .timeline-link:hover { text-decoration: underline; color: var(--musma-maroon); }

        @media (max-width: 991px) {
            .hero-fullscreen { padding-top: 120px; background-attachment: scroll; }
            .hero-title, .hero-subtitle { font-size: 3.5rem; }
            .hero-year { font-size: 2.5rem; }
            .btn-hero-secondary { margin-left: 0; margin-top: 15px; display: block; width: 100%; }
            .btn-hero-cta { display: block; width: 100%; }
            .footer-map-container { min-height: 300px; margin-bottom: 30px; }
        }
    </style>

    <div role="main" class="main" id="home">
        
        <section class="hero-fullscreen">
            <div class="hero-content">
                <div class="appear-animation" data-aos="fade-down" data-aos-delay="100">
                    <span class="hero-badge">Pemilihan Raya 2025</span>
                </div>
                
                <div class="appear-animation" data-aos="fade-up" data-aos-delay="200">
                    <div class="hero-title">MUSMA</div>
                    <div class="hero-subtitle">TEKNIK</div>
                    <div class="hero-year">UNUD</div>
                </div>

                <p class="hero-desc appear-animation" data-aos="fade-up" data-aos-delay="400">
                    Selamat datang pada Musma Teknik 2025
                </p>

                <div class="appear-animation" data-aos="fade-up" data-aos-delay="600">
                    <a href="#Polling" class="btn-hero-cta">
                        Vote Sekarang
                    </a>
                    <a href="#tentang" class="btn-hero-secondary">
                        Info Detail
                    </a>
                </div>
            </div>
        </section>

        <section id="tentang" class="section-about">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="about-heading appear-animation" data-aos="fade-up">Tentang Musma</h2>
                    <p class="about-text appear-animation" data-aos="fade-up" data-aos-delay="200">
                        Musyawarah Mahasiswa (MUSMA) adalah forum tertinggi di lingkungan mahasiswa Fakultas Teknik Universitas Udayana. 
                        Agenda utama meliputi evaluasi kinerja, penetapan AD/ART, serta pemilihan pemimpin baru untuk keberlanjutan roda organisasi.
                    </p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5 mb-4 mb-md-0 appear-animation" data-aos="fade-up" data-aos-delay="300">
                        <div class="about-card text-center">
                            <div class="icon-box">
                                <i class="icons icon-layers"></i>
                            </div>
                            <h4 class="font-weight-bold text-musma-maroon mb-3">Ketua SMFT</h4>
                            <p class="text-muted mb-0">
                                Pemilihan langsung Ketua Senat Mahasiswa Fakultas Teknik (SMFT) sebagai lembaga eksekutif yang akan memimpin pergerakan dan kegiatan mahasiswa selama satu periode kedepan.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 appear-animation" data-aos="fade-up" data-aos-delay="500">
                        <div class="about-card text-center">
                            <div class="icon-box">
                                <i class="icons icon-menu"></i>
                            </div>
                            <h4 class="font-weight-bold text-musma-maroon mb-3">Ketua BPMFT</h4>
                            <p class="text-muted mb-0">
                                Pemilihan langsung Ketua Badan Perwakilan Mahasiswa Fakultas Teknik (BPMFT) sebagai lembaga legislatif yang memegang fungsi pengawasan, aspirasi, dan legislasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="Polling" class="section border-0 m-0 bg-gray py-5" style="background-color: var(--musma-gray);">
            <div class="container pb-5">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-8 appear-animation" data-aos="fade-up">
                        <div class="position-relative d-inline-block mb-4">
                            <h2 class="font-weight-extra-bold text-7 m-0 text-musma-maroon">E-Voting Center</h2>
                            <div style="width: 60px; height: 4px; background: var(--musma-gold); margin: 10px auto 0;"></div>
                        </div>
                        <p class="text-muted lead mb-4">Gunakan hak pilih Anda dengan bijak. Satu suara menentukan arah masa depan Teknik.</p>
                    </div>
                    <div class="col-lg-10 appear-animation" data-aos="fade-up" data-aos-delay="200">
                         <div class="poll-status-alert">
                             <div class="warning-start font-weight-bold text-dark">
                                @guest 
                                    <i class="fas fa-lock mr-2 text-musma-red"></i> Silahkan login terlebih dahulu untuk melakukan pemilihan.
                                @endguest
                                @auth
                                    {{-- FIX: Cek jika data mahasiswa ada --}}
                                    @if (!$mahasiswa)
                                        <i class="fas fa-exclamation-circle mr-2 text-warning"></i> Data mahasiswa tidak ditemukan. Silahkan hubungi panitia.
                                    @elseif ($mahasiswa->status == 'voted')
                                        <i class="fas fa-check-circle text-success mr-2"></i> Terima kasih, Anda sudah menggunakan hak pilih Anda.
                                    @elseif($mahasiswa->status != 'terverifikasi' && $mahasiswa->status != 'voted')
                                        <i class="fas fa-clock mr-2 text-warning"></i> Akun Anda sedang dalam proses verifikasi oleh panitia.
                                    @elseif ($currentDate > $endDate)
                                        <i class="fas fa-calendar-times text-danger mr-2"></i> Mohon maaf, periode pemilihan telah berakhir.
                                    @else
                                        <i class="fas fa-vote-yea text-musma-red mr-2"></i> Akun Terverifikasi! 
                                        @if ($currentDate < $startDate || $currentDate > $endDate)
                                            Silahkan Login kembali pada tanggal 10 Januari 2025 pukul 06.00 - 18.00 WITA.
                                        @else
                                            Silahkan pilih kandidat SMFT dan BPMFT di bawah ini, lalu tekan tombol <strong>Kirim Pilihan</strong>.
                                        @endif
                                    @endif 
                                @endauth
                            </div>
                             <div class="warning bg-transparent"></div>
                        </div>
                    </div>
                </div>

                <form action="/vote" id="#create-form" method="POST">
                    @csrf
                    
                    <div class="smft-section mb-5 appear-animation" data-aos="fade-up" data-aos-delay="300">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-musma-maroon text-white font-weight-bold px-3 py-1 rounded mr-3">SMFT</div>
                            <h3 class="text-dark font-weight-bold m-0">Calon Ketua SMFT</h3>
                        </div>
                        
                        @if (count($smft) == 0)
                            <div class="alert alert-light text-center border-0 shadow-sm p-4 text-muted">Belum Ada Calon Terdaftar</div>
                        @endif

                        <div class="row justify-content-center">
                            @foreach ($smft as $item)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <label class="candidate-card-label w-100">
                                        <input type="radio" @guest disabled @endguest
                                            @auth 
                                                @if ($currentDate < $startDate || $currentDate > $endDate || optional($mahasiswa)->status == 'terdaftar' || optional($mahasiswa)->status == 'voted') disabled @endif 
                                                @if($suara)
                                                    @foreach ($suara as $item2){{ $item->id == $item2->calon_id ? 'checked' : '' }}@endforeach
                                                @endif 
                                            @endauth required name="smft" value="{{ $item->id }}" />
                                    
                                        <div class="candidate-card-inner">
                                            <div class="selected-indicator"><i class="fas fa-check"></i></div>
                                            <div class="candidate-img-wrapper">
                                                <img src="{{ $item->takeimage }}" alt="{{ $item->nama_panggilan }}">
                                            </div>
                                            <div class="candidate-info">
                                                <h3 class="candidate-name">{{ $item->nama_panggilan }}</h3>
                                                <button class="btn btn-musma-outline btn-sm btn-block btn-visiMisi" type="button" data-id="{{ $item->id }}">
                                                    Lihat Visi & Misi
                                                </button>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bpmft-section mb-5 appear-animation" data-aos="fade-up" data-aos-delay="500">
                         <div class="d-flex align-items-center mb-4">
                            <div class="bg-musma-maroon text-white font-weight-bold px-3 py-1 rounded mr-3">BPMFT</div>
                            <h3 class="text-dark font-weight-bold m-0">Calon Ketua BPMFT</h3>
                        </div>
                        @if (count($bpmft) == 0)
                             <div class="alert alert-light text-center border-0 shadow-sm p-4 text-muted">Belum Ada Calon Terdaftar</div>
                        @endif
                        <div class="row justify-content-center">
                            @foreach ($bpmft as $item)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <label class="candidate-card-label w-100">
                                        <input type="radio" @guest disabled @endguest
                                            @auth 
                                                {{-- FIX: Gunakan optional() --}}
                                                @if ($currentDate < $startDate || $currentDate > $endDate || optional($mahasiswa)->status == 'terdaftar' || optional($mahasiswa)->status == 'voted') disabled @endif 
                                                @if($suara)
                                                    @foreach ($suara as $item2){{ $item->id == $item2->calon_id ? 'checked' : '' }}@endforeach
                                                @endif
                                            @endauth required name="bpmft" value="{{ $item->id }}" />
                                    
                                        <div class="candidate-card-inner">
                                             <div class="selected-indicator"><i class="fas fa-check"></i></div>
                                            <div class="candidate-img-wrapper">
                                                 <img src="{{ $item->takeimage }}" alt="{{ $item->nama_panggilan }}">
                                            </div>
                                            <div class="candidate-info">
                                                <h3 class="candidate-name">{{ $item->nama_panggilan }}</h3>
                                                <button class="btn btn-musma-outline btn-sm btn-block btn-visiMisi" type="button" data-id="{{ $item->id }}">
                                                    Lihat Visi & Misi
                                                </button>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @auth
                        @if ($currentDate > $startDate && $currentDate < $endDate)
                            <div class="result mt-5 text-center appear-animation" data-aos="zoom-in" data-aos-delay="600">
                                {{-- FIX: Cek $mahasiswa ada dulu sebelum cek status --}}
                                @if ($mahasiswa && $mahasiswa->status != 'voted' && $mahasiswa->status == 'terverifikasi')
                                    <button class="btn btn-musma-primary btn-lg" style="font-size: 1.1rem;" type="button" id="btn-submit" data-toggle="modal"
                                        data-target="#exampleModalalert">
                                        <i class="fas fa-paper-plane mr-2"></i> KIRIM PILIHAN SAYA
                                    </button>
                                @endif
                            </div>
                        @endif
                    @endauth

                </form>
            </div>
        </section>

        <section id="contact" class="footer-modern">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0 appear-animation" data-aos="fade-right">
                        <div class="footer-map-container">
                             <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63114.03314524725!2d115.21000524619285!3d-8.631753311983303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd241ea9986cc09%3A0xefdc9ad9df39e8f4!2sSEKBER%20FT%20UNUD*21!5e0!3m2!1sid!2sid!4v1604911691204!5m2!1sid!2sid"
                                class="h-100 w-100" frameborder="0" style="border:0;"
                                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 appear-animation" data-aos="fade-left">
                        <div class="footer-info-card">
                            <h3 class="footer-title">Hubungi Kami</h3>
                            
                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <i class="icon-clock icons"></i>
                                </div>
                                <div class="contact-details">
                                    <h5>Tanggal Pemilihan</h5>
                                    <p>10 Januari 2025</p>
                                </div>
                            </div>

                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <i class="icon-call-out icons"></i>
                                </div>
                                 <div class="contact-details">
                                    <h5>Narahubung</h5>
                                    <a href="https://api.whatsapp.com/send?phone=6287701115126" target="_blank">
                                        +6287701115126 (Whatsapp)
                                    </a>
                                    <a href="https://line.me/ti/p/~Komang.uda" target="_blank">
                                        Komang.uda (Line)
                                    </a>
                                </div>
                            </div>

                            <div class="contact-list-item">
                                <div class="contact-icon">
                                    <i class="icon-share icons"></i>
                                </div>
                                 <div class="contact-details">
                                    <h5>Media Sosial</h5>
                                     <a href="https://www.instagram.com/smft_unud/" target="_blank">
                                        @smft_unud (Instagram)
                                    </a>
                                    <a href="https://smft.unud.ac.id/" target="_blank">
                                        smft.unud.ac.id (Website)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <div class="modal fade" id="exampleModalalert" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-musma-maroon text-white">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Konfirmasi Pilihan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body-alert p-4 text-center font-weight-bold text-dark" style="font-size: 1.2rem;">
                    Apakah Anda yakin dengan kandidat pilihan Anda?
                    <p class="small text-muted font-weight-normal mt-2">Pilihan tidak dapat diubah setelah dikirim.</p>
                </div>
                <div class="modal-footer justify-content-center pb-4 border-0">
                    <button type="button" class="btn btn-outline-secondary px-4 font-weight-bold" data-dismiss="modal">Batal</button>
                    <button class="btn btn-musma-primary px-4" type="button" id="btn-submit-modal"
                        data-toggle="modal" data-target="#exampleModalalert">Ya, Kirim Pilihan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- FIX: Perbaikan logika cek status untuk modal tutor --}}
    @if (!Auth::user() or optional($mahasiswa)->status != 'voted')
        <div class="modal fade " id="modaltutor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-musma-maroon text-white">
                        <h5 class="modal-title font-weight-bold text-white"><i class="fas fa-info-circle mr-2"></i> Alur Pemilihan Musma 2025</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body-tutor p-4 bg-light">
                        <div class="musma-timeline">
                            <div class="timeline-item">
                                <div class="timeline-marker">1</div>
                                <div class="timeline-content">
                                    <h4 class="timeline-title">Registrasi</h4>
                                    <p class="timeline-text">
                                        Masuk ke web Pemira teknik lalu klik
                                        <a href="@if (Route::has('register')) {{ route('register') }} @else # @endif" class="timeline-link">Daftar</a>
                                        jika belum memiliki akun, atau klik
                                        <a href="@if (Route::has('auth')) {{ route('auth') }} @else # @endif" class="timeline-link">Login</a>
                                        jika sudah memiliki akun. <br>Registrasi: <strong>3 - 9 Januari 2025.</strong>
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-marker">2</div>
                                <div class="timeline-content">
                                    <h4 class="timeline-title">Verifikasi</h4>
                                    <p class="timeline-text">
                                        Lengkapi data diri dan siapkan foto KTM untuk persyaratan verifikasi. Panitia akan memverifikasi akun Anda setelah registrasi.
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-marker">3</div>
                                <div class="timeline-content">
                                    <h4 class="timeline-title">Cek Status</h4>
                                    <p class="timeline-text">
                                        Login secara berkala untuk mengecek status verifikasi akun Anda pada panel di halaman utama (bagian E-Voting).
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-marker">4</div>
                                <div class="timeline-content">
                                    <h4 class="timeline-title">Pemilihan</h4>
                                    <p class="timeline-text">
                                        Jika akun sudah terverifikasi, Anda dapat melakukan pemilihan secara serempak pada tanggal <b>10 Januari 2025</b>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-musma-primary font-weight-bold px-4" data-dismiss="modal">Saya Mengerti</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="hasil-sementara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white justify-content-center">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-check-circle mr-2"></i> Vote Berhasil!</h5>
                </div>
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-vote-yea text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="text-dark font-weight-bold mb-3">Terima Kasih Telah Berpartisipasi</h4>
                     <div class="alert alert-success" style="display:none">
                        {{ Session::get('success') }}
                    </div>
                    <p class="text-muted">Suara Anda telah berhasil direkam dalam Musma Teknik 2025.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn btn-success font-weight-bold px-5 py-2" data-dismiss="modal" onclick="location.reload();">Tutup & Refresh</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVisiMisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-musma-maroon text-white">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Visi & Misi Kandidat</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body-visimisi container p-4 bg-light">
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-musma-outline font-weight-bold px-4" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alert-vote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i> Peringatan!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-dark font-weight-bold">
                    <div id="text-modal"></div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-dark font-weight-bold px-4" data-dismiss="modal">Mengerti</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(window).on('load', function() {
            $('#modaltutor').modal('show');
        });
        var cSmft = document.getElementById('smft');
        var cBpmft = document.getElementById('bpmft');

        function loadDataChart() {
            $.ajax({
                url: '{{ Route('chart') }}',
                type: 'get',
                success: function(data) {
                    chart = JSON.parse(data);
                    updateChart(chart);
                }
            });
        }
        $('#btn-submit-modal').on("click", function(event) {
            event.preventDefault()
            var data = $('form').serialize();
            $.ajax({
                url: "{{ route('vote') }}",
                method: "POST",
                data: data,
                success: function(data) {
                    console.log(data);
                    $('#hasil-sementara').modal('show');
                    $(".alert-success").css("display", "block");
                    $(".warning").append(
                        "<div class='text-center text-musma-maroon' style='padding-top: 1.5rem; padding-bottom: 1.5rem; font-weight: bold; font-size: 1.1rem;'>" +
                        data + "</div");
                    $(".warning-start").hide();
                    $(".alert-success").append("<strong class='text-center'>" + data + "</strong");
                    $("#btn-submit").remove();
                    $('input[type="radio"]').attr('disabled', true);
                    $('.btn-visiMisi').attr('disabled', true); 
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
        const colors = [{
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)'
            },
            {
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)'
            },
            {
                backgroundColor: 'rgba(14, 255, 108, 0.2)',
                borderColor: 'rgba(54, 235, 65)'
            }
        ]

        function updateChart(data) {
            var smft_calons = [];
            for (var k in data.SMFT) smft_calons.push(k);
            var prodis = data.SMFT[smft_calons[0]]?.prodis;
            var smftDatasets = [];
            for (let i = 0; i < smft_calons.length; i++) {
                smftDatasets.push({
                    label: smft_calons[i],
                    backgroundColor: colors[i].backgroundColor,
                    borderColor: colors[i].borderColor,
                    borderWidth: 1,
                    data: data.SMFT[smft_calons[i]]?.prodi_value
                });
            }
            var datasmft = {
                labels: prodis,
                datasets: smftDatasets
            };
            var bpmft_calons = [];
            for (var k in data.BPMFT) bpmft_calons.push(k);
            const datesetsBpmft = [];
            for (let i = 0; i < bpmft_calons.length; i++) {
                datesetsBpmft.push({
                    label: bpmft_calons[i],
                    backgroundColor: colors[i].backgroundColor,
                    borderColor: colors[i].borderColor,
                    borderWidth: 1,
                    data: data.BPMFT[bpmft_calons[i]]?.prodi_value
                });
            }
            var databpmft = {
                labels: prodis,
                datasets: datesetsBpmft
            };
            var chartSMFT = new Chart(cSmft, {
                type: 'bar',
                data: datasmft,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            var chartBPMFT = new Chart(cBpmft, {
                type: 'bar',
                data: databpmft,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
        $('.btn-visiMisi').click(function(e) {
            e.preventDefault(); 
            e.stopPropagation(); 
            var id = $(this).data('id');
            $.ajax({
                url: '{{ Route('visimisi') }}',
                type: 'post',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.modal-body-visimisi').html(data);
                    $('#modalVisiMisi').modal('show');
                }
            });
        });
        $(document).on("click", '#btn-See', function() {
            loadDataChart();
            $('#hasil-sementara').modal('show');
        });
    </script>
@endsection