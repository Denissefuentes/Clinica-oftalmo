<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Orden de exámenes</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #000;
        }

        .documento {
            max-width: 800px;
            margin: auto;
        }

        .encabezado {
            text-align: center;
            margin-bottom: 30px;
        }

        .encabezado h2 {
            margin-bottom: 5px;
        }

        .datos-paciente {
            margin-bottom: 25px;
        }

        .seccion {
            margin-top: 25px;
        }

        .seccion h4 {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .campo {
            margin-bottom: 15px;
        }

        .firma {
            margin-top: 100px;
            text-align: center;
        }

        .linea {
            border-top: 1px solid #000;
            width: 250px;
            margin: auto;
        }

        .botones {
            text-align: right;
            margin-bottom: 30px;
        }

        @media print {
            .botones {
                display: none;
            }

            body {
                margin: 20px;
            }
        }
    </style>
</head>

<body>

<div class="botones">
    <button onclick="window.print()">Imprimir orden de exámenes</button>
</div>

<div class="documento">

    <div class="encabezado">

        <h2>Farmacia y Clínica Médica San Lucas</h2>

        <h3>ORDEN DE EXÁMENES</h3>

        <p>
            Estelí, Nicaragua
        </p>

    </div>


    <div class="datos-paciente">

        <p>
            <strong>Paciente:</strong>
            {{ $consulta->expediente->paciente->nombre }}
        </p>

        <p>
            <strong>Fecha:</strong>
            {{ now()->format('d/m/Y') }}
        </p>

        <p>
            <strong>Tipo de paciente:</strong>
            {{ $consulta->expediente->paciente->tipo_paciente }}
        </p>

        <p>
            <strong>Diagnóstico:</strong>
            {{ $consulta->diagnostico ?? 'No registrado' }}
        </p>

    </div>


    @if($consulta->tratamiento)

        <div class="seccion">

            <h4>Exámenes solicitados</h4>

            @if($consulta->tratamiento->examenes_complementarios)

                <div class="campo">

                    <p>
                        {{ $consulta->tratamiento->examenes_complementarios }}
                    </p>

                </div>

            @else

                <p>
                    No se registraron exámenes complementarios.
                </p>

            @endif


            @if($consulta->tratamiento->referencias)

                <div class="campo">

                    <strong>Indicación / Referencia:</strong>

                    <p>
                        {{ $consulta->tratamiento->referencias }}
                    </p>

                </div>

            @endif

        </div>

    @else

        <p>
            No hay información de tratamiento registrada.
        </p>

    @endif


    <div class="firma">

        <div class="linea"></div>

        

        <p>
            {{$consulta->cita->doctor->nombre}}
        </p>

        <p>
            Firma y sello del médico
        </p>
    </div>

</div>

</body>
</html>