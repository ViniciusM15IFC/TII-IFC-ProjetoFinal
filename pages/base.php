<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Crítico</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.iconify.design/iconify-icon/1.0.8/iconify-icon.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body.darkmode {
            background-color: #1a1a1a;
            color: #e0e0e0;
        }

        /* Slider Styles */
        .slider-container {
            position: relative;
            margin: 2rem 0;
        }

        .slider-container h3 {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .slider {
            display: flex;
            gap: 1rem;
            overflow: hidden;
            scroll-behavior: smooth;
            transition: transform 0.5s ease-in-out;
        }

        .slider > div {
            flex-shrink: 0;
            min-width: 200px;
            height: 280px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .slider > div:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .img-slider {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .btn-left,
        .btn-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.5) !important;
            border: none !important;
            color: white;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-left:hover,
        .btn-right:hover {
            background-color: rgba(0, 0, 0, 0.8) !important;
            transform: translateY(-50%) scale(1.1);
        }

        .btn-left {
            left: 10px;
        }

        .btn-right {
            right: 10px;
        }

        body.darkmode .slider > div {
            box-shadow: 0 2px 8px rgba(255, 255, 255, 0.1);
        }

        body.darkmode .slider > div:hover {
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.2);
        }

        /* Header Styles */
        .navbar {
            background-color: white;
            transition: background-color 0.3s ease;
        }

        body.darkmode .navbar {
            background-color: #2a2a2a;
            color: #e0e0e0;
        }

        .nav-link {
            color: #333;
            transition: color 0.3s ease;
        }

        body.darkmode .nav-link {
            color: #e0e0e0;
        }

        .btn-theme {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg py-2 shadow-sm">
        <div class="container d-flex align-items-center justify-content-between w-100 gap-5">
            <div class="d-flex align-items-center gap-3 mb-2">
                <a href="#" class="nav-link">
                    <div class="logo">O Crítico</div>
                </a>
                <a href="#" class="nav-link">Catálogo</a>
                <a href="#" class="nav-link">Explorar</a>
            </div>

            <form class="d-flex align-items-center position-relative w-100 mb-2" method="get" action="">
                <input type="text" class="form-control rounded-pill ps-3 pe-5" name="s" placeholder="Buscar...">
                <button class="btn position-absolute end-0 me-2 p-0 border-0 bg-transparent" type="submit">
                    <iconify-icon icon="mdi:magnify" class="fs-5 text-secondary"></iconify-icon>
                </button>
            </form>

            <div class="d-flex align-items-center mb-2">
                <img src="https://via.placeholder.com/36" alt="Foto de perfil" class="rounded-circle me-2"
                    style="width:36px; height:36px; object-fit:cover;">

                <div class="dropdown">
                    <a class="dropdown-toggle text-decoration-none fw-semibold" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Usuário
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end perfil-menu shadow">
                        <li><a class="dropdown-item" href="#">Ver Perfil</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="#">Início</a></li>
                        <li><a class="dropdown-item" href="#">Feed</a></li>
                        <li><a class="dropdown-item" href="#">Sair</a></li>
                    </ul>
                </div>

                <button type="button" id="theme-switch" class="btn btn-sm btn-theme ms-3">
                    <iconify-icon icon="solar:moon-bold-duotone"></iconify-icon>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            <div class="slider-container position-relative py-3">
                <h3>Galeria Estilo Netflix 1</h3>
                <button class="btn btn-dark btn-left">&#10094;</button>
                <div class="d-flex overflow-hidden gap-2 slider">
                    <div>
                        <img src="https://via.placeholder.com/200x280/FF6B6B/FFFFFF?text=Filme+1" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/4ECDC4/FFFFFF?text=Filme+2" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/45B7D1/FFFFFF?text=Filme+3" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/FFA07A/FFFFFF?text=Filme+4" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/98D8C8/FFFFFF?text=Filme+5" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/F7DC6F/FFFFFF?text=Filme+6" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/BB8FCE/FFFFFF?text=Filme+7" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/85C1E2/FFFFFF?text=Filme+8" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/F8B88B/FFFFFF?text=Filme+9" class="img-slider" alt="">
                    </div>
                </div>
                <button class="btn btn-dark btn-right">&#10095;</button>
            </div>

            <div class="slider-container position-relative py-3">
                <h3>Galeria Estilo Netflix 2</h3>
                <button class="btn btn-dark btn-left">&#10094;</button>
                <div class="d-flex overflow-hidden gap-2 slider">
                    <div>
                        <img src="https://via.placeholder.com/200x280/FF6B6B/FFFFFF?text=Série+1" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/4ECDC4/FFFFFF?text=Série+2" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/45B7D1/FFFFFF?text=Série+3" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/FFA07A/FFFFFF?text=Série+4" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/98D8C8/FFFFFF?text=Série+5" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/F7DC6F/FFFFFF?text=Série+6" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/BB8FCE/FFFFFF?text=Série+7" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/85C1E2/FFFFFF?text=Série+8" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/F8B88B/FFFFFF?text=Série+9" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/FF6B6B/FFFFFF?text=Série+10" class="img-slider" alt="">
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/200x280/4ECDC4/FFFFFF?text=Série+11" class="img-slider" alt="">
                    </div>
                </div>
                <button class="btn btn-dark btn-right">&#10095;</button>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        // Theme Switch
        document.addEventListener('DOMContentLoaded', () => {
            let darkmode = localStorage.getItem("darkmode") || "inactive";
            const themeSwitch = document.getElementById("theme-switch");

            const enableDarkmode = () => {
                document.body.classList.add("darkmode");
                localStorage.setItem("darkmode", "active");
                darkmode = "active";
            };

            const disableDarkmode = () => {
                document.body.classList.remove("darkmode");
                localStorage.setItem("darkmode", "inactive");
                darkmode = "inactive";
            };

            if (darkmode === "active") {
                enableDarkmode();
            }

            if (themeSwitch) {
                themeSwitch.addEventListener("click", () => {
                    const currentMode = localStorage.getItem("darkmode");
                    if (currentMode !== "active") {
                        enableDarkmode();
                    } else {
                        disableDarkmode();
                    }
                });
            }

            // Slider Functionality
            const sliderContainers = document.querySelectorAll('.slider-container');

            sliderContainers.forEach(container => {
                const slider = container.querySelector('.slider');
                const btnLeft = container.querySelector('.btn-left');
                const btnRight = container.querySelector('.btn-right');
                
                let scrollAmount = 0;
                const scrollDistance = 300;

                btnLeft.addEventListener('click', () => {
                    scrollAmount = Math.max(0, scrollAmount - scrollDistance);
                    slider.style.transition = 'transform 0.5s ease-in-out';
                    slider.style.transform = `translateX(-${scrollAmount}px)`;
                });

                btnRight.addEventListener('click', () => {
                    const maxScroll = slider.scrollWidth - slider.clientWidth;
                    scrollAmount = Math.min(maxScroll, scrollAmount + scrollDistance);
                    slider.style.transition = 'transform 0.5s ease-in-out';
                    slider.style.transform = `translateX(-${scrollAmount}px)`;
                });
            });
        });
    </script>
</body>

</html>