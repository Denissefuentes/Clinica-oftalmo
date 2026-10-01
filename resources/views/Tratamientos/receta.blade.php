<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Receta médica</title>

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
    <button onclick="window.print()">Imprimir receta</button> 
</div>

<div class="documento">

    <div class="encabezado">

        <h2>Farmacia y Clínica Médica San Lucas</h2>

        <h3>RECETA MÉDICA</h3>

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

            <h4>Tratamiento indicado</h4>

            @if($consulta->tratamiento->medicacion)
                <div class="campo">
                    <strong>Medicación:</strong>
                    <p>
                        {{ $consulta->tratamiento->medicacion }}
                    </p>
                </div>
            @endif

            @if($consulta->tratamiento->lentes)
                <div class="campo">
                    <strong>Lentes:</strong>
                    <p>
                        Uso de lentes.
                    </p>
                </div>
            @endif

            @if($consulta->tratamiento->oclusion)
                <div class="campo">
                    <strong>Oclusión:</strong>
                    <p>
                        Tratamiento de oclusión indicado.
                    </p>
                </div>
            @endif

            @if($consulta->tratamiento->manejo_medico)
                <div class="campo">
                    <strong>Manejo médico:</strong>
                    <p>
                        {{ $consulta->tratamiento->manejo_medico }}
                    </p>
                </div>
            @endif

            @if($consulta->tratamiento->control_en)
                <div class="campo">
                    <strong>Control:</strong>
                    <p>
                        {{ $consulta->tratamiento->control_en }}
                    </p>
                </div>
            @endif

        </div>

    @else

        <p>
            No hay tratamiento registrado.
        </p>

    @endif


    <div class="firma">

        <div class="linea"></div>

        <p>
            Firma y sello del médico
        </p>

    </div>

</div>

</body>
</html>