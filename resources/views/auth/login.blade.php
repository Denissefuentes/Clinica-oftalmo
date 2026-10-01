<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inicio de sesión</title>

    <!-- Estilos de Tailwind mediante Vite -->
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">

    <!-- Contenedor que centra la card en la pantalla -->
    <main class="flex min-h-screen items-center justify-center px-4 py-10 sm:px-6">

    <!-- Card principal: panel de marca a la izquierda y formulario a la derecha -->
    <div class="grid w-full max-w-4xl overflow-hidden rounded-3xl bg-white shadow-2xl shadow-slate-900/10 ring-1 ring-slate-200 lg:grid-cols-2">

        <!-- Panel de marca (solo visible en pantallas grandes) -->
        <aside class="relative hidden overflow-hidden bg-cyan-950 lg:flex lg:min-h-[34rem] lg:flex-col lg:justify-between lg:p-10">

            <!-- Decoración: círculos concéntricos que recuerdan un iris -->
            <svg class="pointer-events-none absolute -bottom-32 -right-32 h-[28rem] w-[28rem] text-cyan-300"
                viewBox="0 0 200 200" fill="none" stroke="currentColor" aria-hidden="true">
                <circle cx="100" cy="100" r="95" stroke-opacity="0.10" />
                <circle cx="100" cy="100" r="75" stroke-opacity="0.15" />
                <circle cx="100" cy="100" r="55" stroke-opacity="0.20" />
                <circle cx="100" cy="100" r="35" stroke-opacity="0.30" />
                <circle cx="100" cy="100" r="15" fill="currentColor" fill-opacity="0.25" stroke="none" />
            </svg>

            <!-- Nombre de la clínica e imagen de ojo-->
            <div class="relative flex items-center gap-3 text-white">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 ring-1 ring-white/20">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </span>
                <span class="text-lg font-semibold">San Lucas</span>
            </div>

            <!-- Mensaje principal -->
            <div class="relative max-w-md">
                <h1 class="text-3xl font-semibold leading-tight text-white">
                    Clínica Oftalmológica San Lucas
                </h1>
                <p class="mt-4 text-base leading-relaxed text-cyan-100/80">
                    Gestiona pacientes, citas y expedientes desde un solo lugar.
                </p>
            </div>

            <p class="relative text-sm text-cyan-100/60">
                © {{ date('Y') }} Clínica Oftalmológica San Lucas
            </p>
        </aside>

        <!-- Zona del formulario -->
        <section class="flex items-center justify-center px-6 py-12 sm:px-10">

            <div class="w-full max-w-md">

                <!-- Nombre de la clínica (solo en móvil, donde no se ve el panel izquierdo) -->
                <p class="mb-8 text-center text-lg font-semibold text-cyan-950 lg:hidden">
                    Clínica Oftalmológica San Lucas
                </p>

                <!-- Encabezado del formulario -->
                <h2 class="text-3xl font-semibold text-slate-900">Iniciar sesión</h2>
                <p class="mt-2 text-sm text-slate-500">
                    Ingresa tus credenciales para acceder al sistema.
                </p>

                <!-- Formulario de inicio de sesión -->
                <form method="POST" action="{{ route('login.authenticate') }}" class="mt-8 space-y-5">
                    @csrf

                    <!-- Mensaje de error general (credenciales incorrectas) -->
                    @if ($errors->any())
                        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Correo electrónico -->
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                            Correo electrónico
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com" autocomplete="email" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-cyan-700 focus:ring-4 focus:ring-cyan-100">
                    </div>

                    <!-- Contraseña con botón para mostrar/ocultar -->
                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                            Contraseña
                        </label>

                        <div class="relative">
                            <input type="password" id="password" name="password"
                                placeholder="Ingresa tu contraseña" autocomplete="current-password" required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 pr-12 text-sm text-slate-800 placeholder:text-slate-400 shadow-sm outline-none transition focus:border-cyan-700 focus:ring-4 focus:ring-cyan-100">

                            <button type="button" id="togglePassword" aria-label="Mostrar contraseña"
                                class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1 text-slate-400 transition hover:text-cyan-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-cyan-700">

                                <!-- Ícono: ojo abierto (contraseña oculta) -->
                                <svg id="iconShow" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                                <!-- Ícono: ojo tachado (contraseña visible) -->
                                <svg id="iconHide" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 3l18 18" />
                                    <path d="M10.6 5.1A10.5 10.5 0 0 1 12 5c6.5 0 10 7 10 7a17 17 0 0 1-3.2 4.2" />
                                    <path d="M6.6 6.6A16.6 16.6 0 0 0 2 12s3.5 7 10 7a10 10 0 0 0 4.4-1" />
                                    <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Opciones adicionales -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-slate-600">
                            <input type="checkbox" name="remember"
                                class="h-4 w-4 rounded border-slate-300 text-cyan-900 focus:ring-cyan-700">
                            Recordarme
                        </label>

                        <a href="#" class="text-sm font-medium text-cyan-900 transition hover:text-cyan-700">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <button type="submit"
                        class="w-full rounded-xl bg-cyan-950 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-950/20 transition hover:bg-cyan-800 focus:outline-none focus:ring-4 focus:ring-cyan-200 active:scale-[0.99]">
                        Iniciar sesión
                    </button>
                </form>
            </div>
        </section>
    </div>
    </main>

    <!-- Script para mostrar u ocultar la contraseña -->
    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const iconShow = document.getElementById('iconShow');
        const iconHide = document.getElementById('iconHide');

        togglePassword.addEventListener('click', function () {
            const visible = passwordInput.type === 'text';

            // Alterna el tipo de campo y el ícono
            passwordInput.type = visible ? 'password' : 'text';
            iconShow.classList.toggle('hidden', !visible);
            iconHide.classList.toggle('hidden', visible);
            togglePassword.setAttribute('aria-label', visible ? 'Mostrar contraseña' : 'Ocultar contraseña');
        });
    </script>

</body>

</html>