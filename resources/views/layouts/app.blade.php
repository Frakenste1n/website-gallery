<!DOCTYPE html>
<html>
<head>
    <title>{{ $setting->title ?? 'Default Title' }}</title>
    @if($setting->favicon ?? false)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">
</head>
<body>
    @yield('content')
    
    <footer class="footer">
        <div class="footer-container">
            <!-- Bagian Kiri -->
            <div class="footer-left">
                <h3 class="school-title">SMK Negeri 4 Bogor</h3>
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1982.3205688896112!2d106.80334881602356!3d-6.596207799021817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c434e0f3e4e3%3A0xd93a2499d1290011!2sSMK%20Negeri%204%20Bogor!5e0!3m2!1sid!2sid!4v1609654046783!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen 
                        loading="lazy">
                    </iframe>
                </div>
                <div class="social-media">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="https://facebook.com/smkn4bogor" target="_blank" title="Facebook">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://instagram.com/smkn4bogor" target="_blank" title="Instagram">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://youtube.com/@smkn4bogor" target="_blank" title="YouTube">
                            <i class="fab fa-youtube fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="footer-right">
                <div class="contact-info">
                    <h4>Contact Us</h4>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <p>+62 812-3456-7890</p>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <p>info@smk4bogor.sch.id</p>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Jl. Raya Tajur, Kp. Buntar, Muarasari, Bogor Selatan, Kota Bogor</p>
                    </div>
                </div>

                <div class="opening-hours">
                    <h4>Opening Hours</h4>
                    <p>Senin - Jumat: 07.00 - 17.00</p>
                    <p>Sabtu - Minggu: Tutup</p>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; 2024 SMK Negeri 4 Bogor. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Animasi smooth scroll untuk link footer
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>