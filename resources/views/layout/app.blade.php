<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChildProtection</title>

    {{-- Bootstrap e LineIcons --}}
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Assets Laravel Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo ps-2">
                    <a href="#">ChildProtection</a>
                </div>
            </div>
            <ul class="sidebar-nav">

                {{-- Countries --}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" 
                       data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-flag"></i>
                        <span>Países</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a href="{{ route('countries.index') }}" class="sidebar-link">Listar</a></li>
                        <li class="sidebar-item"><a href="{{ route('countries.create') }}" class="sidebar-link">Adicionar</a></li>
                    </ul>
                </li>

                {{-- Sectors --}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" 
                       data-bs-target="#menu-sectors" aria-expanded="false" aria-controls="menu-sectors">
                        <i class="lni lni-briefcase"></i>
                        <span>Sectores</span>
                    </a>
                    <ul id="menu-sectors" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a href="{{ route('sectors.index') }}" class="sidebar-link">Listar</a></li>
                        <li class="sidebar-item"><a href="{{ route('sectors.create') }}" class="sidebar-link">Adicionar</a></li>
                    </ul>
                </li>

                {{-- Prohibited Activities --}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" 
                       data-bs-target="#menu-activities" aria-expanded="false" aria-controls="menu-activities">
                        <i class="lni lni-ban"></i>
                        <span>Actividades Proibidas</span>
                    </a>
                    <ul id="menu-activities" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a href="{{ route('prohibited_activities.index') }}" class="sidebar-link">Listar</a></li>
                        <li class="sidebar-item"><a href="{{ route('prohibited_activities.create') }}" class="sidebar-link">Adicionar</a></li>
                    </ul>
                </li>

                {{-- Comparações --}}
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" 
                       data-bs-target="#menu-comparison" aria-expanded="false" aria-controls="menu-comparison">
                        <i class="lni lni-layout"></i>
                        <span>Comparações</span>
                    </a>
                    <ul id="menu-comparison" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item"><a href="{{ route('comparisons.index') }}" class="sidebar-link">Histórico</a></li>
                    </ul>
                </li>

            </ul>

            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Sair</span>
                </a>
            </div>
        </aside>

        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <div class="container-fluid justify-content-end">
                    <div class="navbar-nav">
                        <p class="mb-0">ChildProtection Dashboard</p>
                    </div>
                </div>
            </nav>

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>

            <footer class="footer bg-light py-3 bottom-0 position-fixed w-100">
                <div class="container-fluid d-flex justify-content-center text-muted">
                    <div>
                        <strong>ChildProtection © {{ date('Y') }}</strong>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            
            // Toggle sidebar
            const toggleBtn = document.querySelector('.toggle-btn');
            const sidebar = document.querySelector('#sidebar');
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        });
    </script>
</body>
</html>