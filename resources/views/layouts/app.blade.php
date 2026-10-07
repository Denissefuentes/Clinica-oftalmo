```html
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

        body {
            margin: 0;
            background-color: #f6f8fa;
            color: #263238;
            font-family: Arial, sans-serif;
        }


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

            z-index: 1000;
        }


        .sidebar-brand {
            padding: 0 14px;
            margin-bottom: 35px;
        }

        .sidebar-brand h5 {
            margin-top: 1rem;

            font-size: 18px;
            font-weight: 600;

            letter-spacing: 0.3px;

            color: #fff;
        }

        .sidebar-brand small {
            display: block;

            margin-top: 4px;

            color: #b9cbd2;
            font-size: 13px;
        }


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

            transition: all 0.2s ease;
        }



        .sidebar .nav-link i {
            width: 20px;

            font-size: 17px;

            text-align: center;
        }



        .sidebar .nav-link:hover {

            background-color: rgba(255, 255, 255, 0.08);

            color: white;
        }



        .sidebar .nav-link.active {

            background-color: #dceff1;

            color: #176b75;

            font-weight: 600;
        }



        .main-content {

            margin-left: 250px;

            min-height: 100vh;

            padding: 35px 40px;
        }



        .alert {

            border: none;

            border-radius: 9px;
        }


        .card {

            border: none;

            border-radius: 12px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.04);
        }



        .btn {

            border-radius: 7px;
        }



        .page-title {

            margin-bottom: 4px;

            font-size: 25px;

            font-weight: 600;

            color: #263238;
        }

        .page-subtitle {

            color: #78909c;

            font-size: 14px;

            margin-bottom: 28px;
        }

        
        /* BOTÓN CERRAR SESIÓN */
        .logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            padding: 11px 14px;

            border: 1px solid rgba(255, 255, 255, 0.20);
            border-radius: 8px;

            background-color: rgba(255, 255, 255, 0.06);
            color: #d8e3e7;

            font-size: 14px;
            font-weight: 500;

            cursor: pointer;

            transition: all 0.2s ease;
        }

        /* Tamaño del icono del botón. */
        .logout-button i {
            font-size: 17px;
        }

        /* Efecto cuando el usuario pasa el mouse. */
        .logout-button:hover {
            background-color: #b94a48;
            border-color: #b94a48;
            color: #ffffff;
            transform: translateY(-1px);
        }

        /* Efecto al hacer clic. */
        .logout-button:active {
            transform: translateY(0);
        }

    </style>

</head>


<body>



    <aside class="sidebar">


        <div class="sidebar-brand">

            <h5>
                CLÍNICA SAN LUCAS
            </h5>

            <small>
                Oftalmología
            </small>

        </div>


        <!-- Menú -->

        <nav class="sidebar-menu">


            <a
                href="{{ route('pacientes.index') }}"
                class="nav-link {{ request()->routeIs('pacientes.*') ? 'active' : '' }}"
            >

                <i class="bi bi-people"></i>

                <span>Pacientes</span>

            </a>


            <!--  Solo el administrador puede ver el acceso a Doctores -->
            @if(auth()->user()->role === 'admin')
                <a
                    href="{{ route('doctores.index') }}"
                    class="nav-link {{ request()->routeIs('doctores.*') ? 'active' : '' }}"
                >

                    <i class="bi bi-person-badge"></i>

                    <span>Doctores</span>

                </a>
            @endif


            <a
                href="{{ route('citas.index') }}"
                class="nav-link {{ request()->routeIs('citas.*') ? 'active' : '' }}"
            >

                <i class="bi bi-calendar3"></i>

                <span>Citas</span>

            </a>


            <!--  Solo el administrador puede ver el acceso a expedientes -->
            @if(auth()->user()->role === 'admin')
                <a
                    href="{{ route('expedientes.index') }}"
                    class="nav-link {{ request()->routeIs('expedientes.*') ? 'active' : '' }}"
                >

                    <i class="bi bi-folder2-open"></i>

                    <span>Expedientes</span>

                </a>
            @endif


        </nav>


            <!-- Solo el administrador puede gestionar los usuarios del sistema. -->
            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('usuarios.index') }}"
                    class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-person-gear"></i>

                    <span>Administrar usuarios</span>
                </a>

            @endif


         <!-- Botón para cerrar la sesión del usuario actual. -->
        <div class="mt-auto pt-4">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    <i class="bi bi-box-arrow-right"></i>

                    <span>Cerrar sesión</span>
                </button>
            </form>

        </div>

            </form>

        </div>


    </aside>



    <!-- =========================
         CONTENIDO
    ========================= -->

    <main class="main-content">


        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        @yield('content')


    </main>


</body>

</html>
```
