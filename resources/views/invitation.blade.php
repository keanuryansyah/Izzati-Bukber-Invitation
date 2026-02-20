<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Izzatishot Bukber 2026</title>

    <!-- Scripts & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --blue: #0078b7;
            --gold: #d98604;
            --dark: #00263e;
            --thick-shadow: 0 25px 50px -12px rgba(0, 58, 92, 0.4);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f0f4f8;
            color: var(--dark);
            -webkit-tap-highlight-color: transparent;
            overflow-x: hidden;
            /* Optimasi scrolling agar enteng */
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        .font-serif { font-family: 'Playfair Display', serif; }

        .card-elevated {
            background: #ffffff;
            border-radius: 2rem;
            border: 2px solid #ffffff;
            box-shadow: var(--thick-shadow);
        }

        .btn-thick {
            background: var(--blue);
            color: white;
            font-weight: 800;
            letter-spacing: 0.1em;
            border-radius: 1.5rem;
            box-shadow: 0 15px 30px -5px rgba(0, 120, 183, 0.4);
            transition: all 0.2s ease;
        }

        .btn-thick:active { transform: translateY(4px); }

        /* TIMELINE SYSTEM */
        .timeline-wrapper { position: relative; padding-left: 50px; }
        .timeline-line-base { position: absolute; left: 20px; top: 0; bottom: 0; width: 8px; background: #e2e8f0; border-radius: 20px; z-index: 0; }
        .timeline-line-progress { position: absolute; left: 20px; top: 0; width: 8px; background: var(--gold); height: 0; border-radius: 20px; z-index: 1; box-shadow: 0 0 15px rgba(217, 134, 4, 0.5); transition: height 0.1s ease-out; }
        .agenda-item { position: relative; margin-bottom: 40px; }
        .step-dot { position: absolute; left: -36px; margin-right: 1px; top: 25px; width: 20px; height: 20px; background: #ffffff; border: 5px solid #e2e8f0; border-radius: 50%; z-index: 10; box-shadow: 0 0 0 5px #f0f4f8; transition: all 0.3s ease; }
        .step-dot.active { border-color: var(--gold); transform: scale(1.1); box-shadow: 0 0 15px rgba(217, 134, 4, 0.5); }
        .agenda-card { background: #ffffff; border-radius: 2rem; padding: 24px; box-shadow: 0 20px 40px -10px rgba(0, 58, 92, 0.2); border: 1px solid white; }

        /* GALLERY OPTIMIZED (ANTI-LAG) */
        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        
        .gallery-item { 
            aspect-ratio: 1/1; 
            border-radius: 1.5rem; 
            overflow: hidden; 
            border: 4px solid white; 
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            background: #e2e8f0; /* Placeholder warna sebelum gambar muncul */
            
            /* Trick GPU Acceleration */
            transform: translateZ(0); 
            will-change: transform, opacity;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Fade in halus saat loading agar tidak kaget */
            transition: opacity 0.5s ease;
        }

        #gate { position: fixed; inset: 0; z-index: 9999; background: white; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        #successModal { display: none; position: fixed; inset: 0; z-index: 10000; background: rgba(0, 38, 62, 0.9); backdrop-filter: blur(10px); align-items: center; justify-content: center; }
        
        @keyframes mouse-scroll {
            0% { transform: translate(-50%, 0); opacity: 1; }
            100% { transform: translate(-50%, 15px); opacity: 0; }
        }
        .animate-mouse-scroll { animation: mouse-scroll 1.5s infinite; }
        ::-webkit-scrollbar { width: 0; }
    </style>
</head>

<body class="overflow-x-hidden">

    <!-- AUDIO -->
    <audio id="petasanSound"><source src="{{ asset('music/petasan.mp3') }}" type="audio/mpeg"></audio>
    <audio id="bgMusic" loop><source src="{{ asset('music/backsound.mp3') }}" type="audio/mpeg"></audio>

    <!-- SUCCESS POPUP -->
    <div id="successModal">
        <div id="modalContent" class="card-elevated p-8 w-full max-w-[320px] text-center opacity-0 scale-50">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-4xl mx-auto mb-6 shadow-inner">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <h2 class="font-serif text-2xl font-black mb-2 italic">Terimakasih!</h2>
            <p class="text-sm text-gray-500 font-bold italic mb-8 leading-relaxed">Konfirmasi kamu sudah terkirim. Sampai jumpa ya!</p>
            <button onclick="closeModal()" class="btn-thick w-full py-4 text-xs">OKE SIAP!</button>
        </div>
    </div>

    <!-- GATE -->
    <div id="gate">
        <div class="text-center px-8" id="gate-ui">
            <div class="w-24 h-24 border-[10px] border-[#0078b7] rounded-full flex items-center justify-center mb-8 mx-auto shadow-2xl bg-white">
                <i class="fa-solid fa-star-and-crescent text-[#d98604] text-5xl"></i>
            </div>
            <h1 class="font-serif text-5xl font-black mb-4 text-[#00263e] leading-tight">Izzatishot <br><span class="text-[#d98604] italic">Family</span></h1>
            <p class="text-[10px] tracking-[0.5em] text-gray-400 uppercase font-black mb-12 italic">Eksklusif Bukber 2026</p>
            <button onclick="explodeAndOpen()" class="btn-thick px-12 py-5 text-sm uppercase italic">Buka Undangan</button>
        </div>
    </div>

    <main id="main-app" class="hidden opacity-0">

        <!-- HERO -->
        <section class="min-h-screen flex flex-col items-center justify-center px-6 text-center relative overflow-hidden">
            <div class="hero-static">
                <div class="h-2.5 w-20 bg-[#d98604] mx-auto mb-8 rounded-full shadow-sm"></div>
                <h1 class="font-serif text-7xl font-black mb-4 leading-none text-[#00263e]">Bukber <br><span class="text-[#0078b7] italic">2026</span></h1>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mb-16 italic">Assalamu’alaikum Wr. Wb.</p>
                <div class="grid grid-cols-4 gap-3 mb-20">
                    @foreach(['hari' => 'days', 'jam' => 'hours', 'menit' => 'minutes', 'detik' => 'seconds'] as $l => $id)
                    <div class="card-elevated py-4 flex flex-col items-center justify-center bg-white">
                        <span id="{{ $id }}" class="text-2xl font-black text-[#0078b7]">00</span>
                        <span class="text-[7px] font-black uppercase tracking-widest text-gray-300">{{ $l }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50">
                <div class="w-6 h-10 border-2 border-[#00263e] rounded-full relative">
                    <div class="w-1.5 h-1.5 bg-[#d98604] rounded-full absolute left-1/2 -translate-x-1/2 top-2 animate-mouse-scroll"></div>
                </div>
                <p class="text-[8px] font-black uppercase tracking-widest text-[#00263e]">Scroll Down</p>
            </div>
        </section>

        <!-- INFO -->
        <section class="py-12 px-6 space-y-8">
            <div class="card-elevated p-8" data-aos="fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-[#0078b7] text-white rounded-2xl flex items-center justify-center text-xl shadow-lg"><i class="fa-solid fa-map-location-dot"></i></div>
                    <div>
                        <h2 class="text-xl font-black leading-none text-[#00263e]">RM Babeh Kite</h2>
                        <span class="text-[9px] font-bold text-[#d98604] uppercase tracking-widest italic">Lokasi Acara</span>
                    </div>
                </div>
                <div class="space-y-6 mb-8">
                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 shadow-inner">
                        <i class="fa-solid fa-calendar-day text-[#d98604] mt-1 text-lg"></i>
                        <div><p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Hari & Tanggal</p><p class="text-sm font-bold">Senin, 23 Februari 2026</p></div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 shadow-inner">
                        <i class="fa-solid fa-clock text-[#d98604] mt-1 text-lg"></i>
                        <div><p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Waktu</p><p class="text-sm font-bold">15.00 WIB - Selesai</p></div>
                    </div>
                </div>
                <a href="https://www.google.com/maps/search/?api=1&query=RM+Babeh+Kite+Bangka+Kemang" target="_blank" class="btn-thick block w-full py-5 text-center text-xs uppercase italic">Buka Di Google Maps</a>
            </div>

            <div class="bg-[#00263e] rounded-[2rem] p-8 relative overflow-hidden text-white shadow-2xl" data-aos="fade-up">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#d98604] opacity-20 rounded-full blur-3xl"></div>
                <div class="relative z-10 text-center">
                    <div class="w-12 h-12 bg-[#d98604] rounded-2xl flex items-center justify-center text-white text-xl mb-6 shadow-lg mx-auto"><i class="fa-solid fa-shirt"></i></div>
                    <h3 class="text-2xl font-black mb-2 italic text-[#d98604]">Dresscode Wajib!</h3>
                    <p class="text-white/60 text-xs font-bold leading-relaxed italic mb-6">Seluruh keluarga wajib memakai T-Shirt resmi Izzatishot!</p>
                    <div class="p-3 bg-white/5 border border-white/10 rounded-xl">
                        <p class="text-[#d98604] font-black text-[9px] tracking-[0.3em] uppercase italic underline decoration-2">Pakaian: T-Shirt Izzatishot</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- AGENDA -->
        <section class="py-20 px-6">
            <div class="text-center mb-16">
                <h2 class="font-serif text-5xl font-black italic text-[#00263e]">Agenda</h2>
                <p class="text-[9px] font-black text-[#0078b7] uppercase tracking-[0.4em] mt-2 italic">Rangkaian Acara</p>
            </div>
            <div class="timeline-wrapper" id="timeline-box">
                <div class="timeline-line-base"></div>
                <div class="timeline-line-progress" id="step-progress"></div>
                @php
                $steps = [['15.00', 'Persiapan'], ['16.00', 'Berbagi Takjil'], ['17.00', 'Dokumentasi'], ['17.30', 'Soft Briefing'], ['18.00', 'Doa Bersama'], ['18.15', 'Bukber']];
                @endphp
                @foreach($steps as $s)
                <div class="agenda-item">
                    <div class="step-dot"></div>
                    <div class="agenda-card" data-aos="fade-left">
                        <span class="text-[9px] font-black text-[#d98604] uppercase tracking-widest mb-1 block italic">{{ $s[0] }} WIB</span>
                        <h4 class="text-xl font-black mb-1 leading-none text-[#00263e]">{{ $s[1] }}</h4>
                        <p class="text-[11px] text-gray-400 font-bold leading-relaxed italic">Agenda penting keluarga Izzatishot.</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- GALLERY OPTIMIZED (ANTI-LAG) -->
        <section class="py-20 px-6">
            <div class="mb-10 text-center">
                <h2 class="font-serif text-5xl font-black italic text-[#00263e]">Galeri</h2>
                <p class="text-[9px] font-black text-[#0078b7] uppercase tracking-[0.4em] mt-2 italic underline decoration-[#d98604] decoration-2">Momen Izzatishot</p>
            </div>
            <div class="gallery-grid">
                @php 
                $images = ['aa', 'kalinda', 'aji', 'arul', 'apit', 'fahri', 'farel', 'fb-1', 'gf', 'ipan', 'jojo', 'jon', 'nopal', 'rani', 'rapli', 'zahra', 'dwi', 'takjil']; 
                @endphp
                @foreach($images as $img)
                    <div class="gallery-item" data-aos="fade"> <!-- Pake fade aja biar enteng -->
                        <!-- PENTING: Pake loading="lazy" biar ga ngeleg -->
                        <img src="{{ asset('images/'.$img.'.webp') }}" loading="lazy" alt="Gallery Izzatishot">
                    </div>
                @endforeach
            </div>
        </section>

        <!-- RSVP -->
        <section class="py-20 px-6">
            <div class="card-elevated p-8 text-center border-t-8 border-t-[#0078b7]" data-aos="fade-up">
                <h2 class="font-serif text-5xl font-black mb-2 italic text-[#00263e]">RSVP</h2>
                <p class="text-[9px] font-black text-[#d98604] uppercase tracking-[0.6em] mb-12 italic">Konfirmasi Kehadiran</p>
                <form action="{{ route('rsvp.store') }}" method="POST" class="text-left space-y-8">
                    @csrf
                    <div>
                        <label class="text-[9px] font-black uppercase text-gray-300 tracking-widest mb-3 block ml-4">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-slate-50 border-4 border-transparent focus:border-[#0078b7] p-5 rounded-2xl font-bold transition-all outline-none" placeholder="Masukkan nama kamu">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer group">
                            <input type="radio" name="status" value="hadir" checked class="hidden peer" onchange="toggleReason()">
                            <div class="p-5 border-4 border-slate-50 bg-slate-50 rounded-2xl text-center peer-checked:bg-[#0078b7] peer-checked:text-white transition-all font-black text-[10px] tracking-widest">HADIR</div>
                        </label>
                        <label class="cursor-pointer group">
                            <input type="radio" name="status" value="tidak_hadir" class="hidden peer" onchange="toggleReason()">
                            <div class="p-5 border-4 border-slate-50 bg-slate-50 rounded-2xl text-center peer-checked:bg-red-500 peer-checked:text-white transition-all font-black text-[10px] tracking-widest">ABSEN</div>
                        </label>
                    </div>
                    <div id="reason_box" class="hidden">
                        <textarea name="reason" rows="3" class="w-full bg-slate-50 border-4 border-transparent focus:border-red-400 p-5 rounded-2xl font-bold outline-none" placeholder="Kenapa berhalangan?"></textarea>
                    </div>
                    <button type="submit" class="btn-thick w-full py-6 text-sm uppercase italic">Kirim Konfirmasi <i class="fa-solid fa-paper-plane ml-2"></i></button>
                </form>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-24 text-center px-8">
            <h2 class="font-serif text-3xl font-black text-[#00263e] italic mb-4">Izzatishot Family</h2>
            <p class="text-sm text-gray-500 font-bold italic leading-relaxed mb-10 mx-auto max-w-xs">"Merajut Kasih, Mempererat Silaturahmi dalam Hangatnya Kebersamaan di Bulan Penuh Berkah."</p>
            <div class="h-1.5 w-16 bg-slate-200 mx-auto rounded-full mb-10"></div>
            <p class="text-[8px] font-black text-gray-300 uppercase tracking-[1em] italic">Gathering 2026</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function explodeAndOpen() {
            document.getElementById('petasanSound').play();
            setTimeout(() => { document.getElementById('bgMusic').play(); }, 1200);

            const duration = 3000;
            const end = Date.now() + duration;
            (function frame() {
                confetti({ particleCount: 5, angle: 60, spread: 55, origin: { x: 0 }, colors: ['#0078b7', '#d98604'] });
                confetti({ particleCount: 5, angle: 120, spread: 55, origin: { x: 1 }, colors: ['#0078b7', '#d98604'] });
                if (Date.now() < end) requestAnimationFrame(frame);
            }());

            gsap.to("#gate-ui", { scale: 0.8, opacity: 0, duration: 0.8 });
            gsap.to("#gate", { yPercent: -100, duration: 1.2, ease: "expo.inOut", onComplete: () => {
                document.getElementById('main-app').style.display = "block";
                gsap.to("#main-app", { opacity: 1, duration: 0.5 });
                AOS.init({ duration: 800, once: true, offset: 50 }); // Animasi lebih cepet biar ga ngeleg
                window.addEventListener('scroll', handleTimeline);
            }});
        }

        function handleTimeline() {
            const timelineBox = document.getElementById('timeline-box');
            const progressBar = document.getElementById('step-progress');
            const dots = document.querySelectorAll('.step-dot');
            const rect = timelineBox.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            let progress = (windowHeight / 2 - rect.top) / rect.height;
            progress = Math.min(Math.max(progress, 0), 1);
            progressBar.style.height = (progress * 100) + "%";
            dots.forEach((dot) => {
                const dotRect = dot.getBoundingClientRect();
                if (dotRect.top < windowHeight / 2) dot.classList.add('active');
                else dot.classList.remove('active');
            });
        }

        function toggleReason() {
            const isAbsent = document.querySelector('input[name="status"]:checked').value === 'tidak_hadir';
            const box = document.getElementById('reason_box');
            if (isAbsent) { box.classList.remove('hidden'); gsap.fromTo(box, { height: 0, opacity: 0 }, { height: "auto", opacity: 1, duration: 0.4 }); }
            else { box.classList.add('hidden'); }
        }

        function closeModal() {
            gsap.to("#modalContent", { scale: 0.8, opacity: 0, duration: 0.4 });
            gsap.to("#successModal", { opacity: 0, duration: 0.4, onComplete: () => { document.getElementById('successModal').style.display = 'none'; }});
        }

        @if(session('success'))
            const modal = document.getElementById('successModal');
            modal.style.display = 'flex';
            gsap.to(modal, { opacity: 1, duration: 0.4 });
            gsap.to("#modalContent", { scale: 1, opacity: 1, duration: 0.7, ease: "back.out(1.7)", delay: 0.5 });
        @endif

        const target = new Date("Feb 23, 2026 15:00:00").getTime();
        setInterval(() => {
            const now = new Date().getTime();
            const d = target - now;
            if (d < 0) return;
            document.getElementById('days').innerText = Math.floor(d / 86400000);
            document.getElementById('hours').innerText = Math.floor((d % 86400000) / 3600000);
            document.getElementById('minutes').innerText = Math.floor((d % 3600000) / 60000);
            document.getElementById('seconds').innerText = Math.floor((d % 60000) / 1000);
        }, 1000);
    </script>
</body>
</html>