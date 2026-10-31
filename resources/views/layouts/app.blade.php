```blade
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clínica Oftalmológica San Lucas</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #f6f8fa;
            color: #263238;
            font-family: Arial, sans-serif;
        }

        /* BARRA LATERAL */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #173b4d;
            padding: 28px 16px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1000;
        }

        /* IDENTIDAD DE LA CLÍNICA */
        .sidebar-brand {
            padding: 0 14px;
            margin-bottom: 30px;
        }

        .sidebar-brand h5 {
            margin-top: 1rem;
            margin-bottom: 0;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.3px;
            color: #fff;
        }

        .sidebar-brand small {
            display: block;
            margin-top: 6px;
            color: #b9cbd2;
            font-size: 13px;
        }

        .sidebar-divider {
            height: 1px;
            margin: 0 10px 18px;
            background-color: rgba(255, 255, 255, 0.13);
        }

        .menu-label {
            padding: 0 14px;
            margin-bottom: 10px;
            color: #9fb8c3;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        /* MENÚ */
        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 8px;
            color: #d8e3e7;
            font-size: 14px;
            font-weight: 400;
            text-decoration: none;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sidebar .nav-link i {
            width: 20px;
            font-size: 17px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #dceff1;
            color: #176b75;
            font-weight: 600;
        }

        /* ZONA INFERIOR */
        .sidebar-bottom {
            margin-top: auto;
            padding-top: 25px;
        }

        .user-role {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid rgba(255, 255, 255, 0.13);
            border-radius: 9px;
            color: #d8e3e7;
            font-size: 12px;
        }

        .user-role i {
            font-size: 20px;
            color: #b9d9df;
        }

        .user-role strong {
            display: block;
            margin-bottom: 3px;
            color: #fff;
            font-size: 13px;
        }

        .user-role small {
            color: #b9cbd2;
        }

        /* BOTÓN DE COPIA DE SEGURIDAD */
        .backup-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 10px 12px;
            margin-bottom: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.05);
            color: #e7f3f5;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .backup-button:hover {
            background-color: #dceff1;
            border-color: #dceff1;
            color: #176b75;
        }

        /* BOTÓN CERRAR SESIÓN */
        .logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 11px 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.06);
            color: #d8e3e7;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .logout-button i {
            font-size: 17px;
        }

        .logout-button:hover {
            background-color: #b94a48;
            border-color: #b94a48;
            color: #fff;
        }

        /* CONTENIDO PRINCIPAL */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 35px 40px;
        }

        .page-title {
            margin-bottom: 4px;
            font-size: 25px;
            font-weight: 600;
            color: #263238;
        }

        .page-subtitle {
            margin-bottom: 28px;
            color: #78909c;
            font-size: 14px;
        }

        .alert {
            border: none;
            border-radius: 9px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .btn {
            border-radius: 7px;
        }

        /* ADAPTACIÓN A PANTALLAS PEQUEÑAS */
        @media (max-width: 768px) {
            .sidebar {
                width: 210px;
                padding: 22px 12px;
            }

            .main-content {
                margin-left: 210px;
                padding: 25px 18px;
            }
        }
    </style>
</head>

<body>

    @php
        $rol = auth()->user()->role ?? '';
    @endphp

    <aside class="sidebar">

        {{-- IDENTIDAD --}}
        <div class="sidebar-brand">
            <h5>CLÍNICA SAN LUCAS</h5>
            <small>Oftalmología</small>
        </div>

        <div class="sidebar-divider"></div>

        <div class="menu-label">Menú principal</div>

        <nav class="sidebar-menu">

            {{-- PACIENTES: admin, doctor y secretaria --}}
            @if(in_array($rol, ['admin', 'doctor', 'secretaria']))
                <a href="{{ route('pacientes.index') }}"
                   class="nav-link {{ request()->routeIs('pacientes.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Pacientes</span>
                </a>
            @endif

            {{-- CITAS: admin, doctor y secretaria --}}
            @if(in_array($rol, ['admin', 'doctor', 'secretaria']))
                <a href="{{ route('citas.index') }}"
                   class="nav-link {{ request()->routeIs('citas.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3"></i>
                    <span>Citas</span>
                </a>
            @endif

            {{-- DOCTORES: admin y doctor --}}
            @if(in_array($rol, ['admin']))
                <a href="{{ route('doctores.index') }}"
                   class="nav-link {{ request()->routeIs('doctores.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Doctores</span>
                </a>
            @endif

            {{-- EXPEDIENTES: admin y doctor --}}
            @if(in_array($rol, ['admin', 'doctor']))
                <a href="{{ route('expedientes.index') }}"
                   class="nav-link {{ request()->routeIs('expedientes.*') ? 'active' : '' }}">
                    <i class="bi bi-folder2-open"></i>
                    <span>Expedientes</span>
                </a>
            @endif

            {{-- USUARIOS: solamente admin --}}
            @if($rol === 'admin')
                <a href="{{ route('usuarios.index') }}"
                   class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear"></i>
                    <span>Administrar usuarios</span>
                </a>
            @endif

        </nav>

        {{-- ZONA INFERIOR --}}
        <div class="sidebar-bottom">

            {{-- ROL DEL USUARIO ACTUAL --}}
            <div class="user-role">
                <i class="bi bi-person-circle"></i>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <small>
                        @switch($rol)
                            @case('admin')
                                Administrador
                                @break
                            @case('doctor')
                                Doctor
                                @break
                            @case('secretaria')
                                Secretaria
                                @break
                            @default
                                Usuario
                        @endswitch
                    </small>
                </div>
            </div>

            {{-- COPIA DE SEGURIDAD: solamente admin --}}
            @if($rol === 'admin')
                <form action="{{ route('backup.download') }}" method="POST">
                    @csrf
                    <button type="submit" class="backup-button">
                        <i class="bi bi-database-down"></i>
                        <span>Copia de seguridad</span>
                    </button>
                </form>
            @endif

            {{-- CERRAR SESIÓN --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>

        </div>

    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="main-content">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>
```