<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'EcoCycle')</title>

    <!-- Dark mode -->
    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = function (theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if(el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })

    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ Vite::asset('resources/assets/images/favicon.ico') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Poppins:wght@400;500;700&amp;display=swap">

    @vite([
    'resources/assets/vendor/font-awesome/css/all.min.css',
    'resources/assets/vendor/bootstrap-icons/bootstrap-icons.css',
    'resources/assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css',
    'resources/assets/vendor/apexcharts/css/apexcharts.css',
	'resources/assets/vendor/aos/aos.css',
	'resources/assets/vendor/flatpickr/css/flatpickr.min.css',
	'resources/assets/vendor/choices/css/choices.min.css',

    'resources/assets/css/style.css'
    ])
</head>
<body>

@yield('content')

<!-- Back to top -->
<div class="back-top"></div>

@vite([
    'resources/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
    'resources/assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js',
    'resources/assets/vendor/apexcharts/js/apexcharts.min.js',
    'resources/assets/vendor/aos/aos.js',
    'resources/assets/vendor/flatpickr/js/flatpickr.min.js',
    'resources/assets/vendor/choices/js/choices.min.js',

    'resources/assets/js/functions.js'
    ])
</body>
</html>
