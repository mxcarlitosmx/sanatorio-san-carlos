<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Receta - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }

        :root {
            --bg-page-light: #ffffff;
            --bg-page-celeste: #dbeafe;
            --card-blue-top: #3a9edb;
            --card-blue-bottom: #164ca7;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --text-white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-celeste) 100%);
            background-attachment: fixed;
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
            color: var(--text-dark);
            margin: 0;
            padding-bottom: 50px;
        }

        /* =========================================
           CABECERA ESTRICTA DE 3 CONTENEDORES
           ========================================= */
        .sanatorio-header {
            background: linear-gradient(90deg, var(--card-blue-bottom) 0%, var(--card-blue-top) 100%);
            box-shadow: 0 10px 20px rgba(22, 76, 167, 0.15);
            width: 100%;
            padding: 15px 0;
        }
        .header-container { display: flex; justify-content: space-between; align-items: center; flex-wrap: nowrap; width: 100%; padding: 0 30px; }
        .header-box { flex: 1; display: flex; align-items: center; min-width: 0; }
        .box-left { justify-content: flex-start; }
        .box-center { justify-content: center; }
        .box-right { justify-content: flex-end; }
        .header-logo { height: 90px; width: auto; max-width: 100%; filter: brightness(0) invert(1); transition: transform 0.3s ease; }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 2rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-logout {
            background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 10px 30px; font-size: 1.1rem; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;
        }
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        /* =========================================
           DISEÑO DE TARJETA ESTILO RECETA DIGITAL
           ========================================= */
        .dashboard-container { max-width: 800px; margin: 0 auto; padding-top: 50px; }
        .dashboard-header-title { color: var(--card-blue-bottom); font-weight: 800; font-size: 2.2rem; letter-spacing: -0.5px; margin-bottom: 8px; }
        .header-spacing { margin-bottom: 2.5rem !important; }
        
        .btn-back {
            color: var(--text-muted); font-weight: 700; text-decoration: none; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s ease; display: inline-flex; align-items: center;
        }
        .btn-back:hover { color: var(--card-blue-bottom); }

        .prescription-card {
            background: #ffffff; border-radius: 24px; border: none; box-shadow: 0 15px 40px rgba(22, 76, 167, 0.08); overflow: hidden; border-left: 8px solid var(--card-blue-bottom);
        }
        .card-body-custom { padding: 45px; }

        /* CABECERA RECETA */
        .rx-title-box { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px dashed #e2e8f0; padding-bottom: 25px; margin-bottom: 30px; }
        .rx-folio { font-size: 1.4rem; font-weight: 800; color: var(--card-blue-bottom); }
        .rx-date { font-size: 0.95rem; color: var(--text-muted); font-weight: 600; }

        .meta-label { font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 2px; }
        .meta-value { font-size: 1.1rem; color: var(--text-dark); font-weight: 600; margin-bottom: 25px; }

        /* TABLA DE MEDICAMENTOS PRESTIGIO */
        .med-table { width: 100%; margin-top: 10px; }
        .med-table th { background: #f8fafc; color: var(--card-blue-bottom); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; padding: 12px 20px; border: none; }
        .med-table td { padding: 20px; border-bottom: 1px solid #f1f5f9; font-size: 1rem; font-weight: 600; }
        .med-table tr:last-child td { border-bottom: none; }
        .med-dosage { font-size: 0.9rem; color: var(--text-muted); font-weight: 500; margin-top: 4px; }

        @media (max-width: 768px) {
            .rx-title-box { flex-direction: column; align-items: flex-start; gap: 10px; }
            .med-table th { display: none; }
            .med-table td { display: block; width: 100%; padding: 15px 10px; text-align: left; border-bottom: 1px solid #e2e8f0; }
            .med-table td::before { content: attr(data-label); display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 4px; }
        }
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <a href="{{ route('patient.dashboard') }}">
                    <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
                </a>
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Bienvenido, {{ auth()->user()->name ?? 'Usuario' }}</h1>
            </div>
            <div class="header-box box-right">
                <form method="POST" action="{{ url('/logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn-logout">Salir</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid px-4 dashboard-container">
        
        <div class="row align-items-center header-spacing">
            <div class="col-md-8 text-center text-md-start">
                <h2 class="dashboard-header-title m-0">Receta Médica Digital</h2>
                <p class="text-muted mt-2 mb-0">Presenta este folio en ventanilla de farmacia para surtir tus medicamentos.</p>
            </div>
            <div class="col-md-4 text-end btn-back-container">
                <a href="{{ route('patient.dashboard') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left me-2"></i> Volver al panel
                </a>
            </div>
        </div>

        <div class="prescription-card">
            <div class="card-body-custom">
                
                <div class="rx-title-box">
                    <div class="rx-folio"><i class="fa-solid fa-prescription me-2"></i> Folio: #REC-00{{ $prescription->id_prescription ?? '89' }}</div>
                    <div class="rx-date"><i class="fa-regular fa-calendar me-2"></i> Emitida: {{ \Carbon\Carbon::parse($prescription->created_at)->format('d/m/Y') }}</div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="meta-label">Médico emisor</div>
                        <div class="meta-value">Dr(a). {{ $prescription->consultation->appointment->doctor->user->name ?? 'Especialista' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="meta-label">Cédula Profesional</div>
                        <div class="meta-value">{{ $prescription->consultation->appointment->doctor->professional_license ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table med-table">
                        <thead>
                            <tr>
                                <th>Medicamento y Presentación</th>
                                <th class="text-center" style="width: 150px;">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prescription->items ?? [] as $item)
                                <tr>
                                    <td data-label="Medicamento">
                                        <div style="color: var(--card-blue-bottom); font-weight: 700;">{{ $item->medicine->name }}</div>
                                        <div class="med-dosage">Indicación: {{ $item->instruction ?? 'Tomar según indicaciones médicas' }}</div>
                                    </td>
                                    <td data-label="Cantidad" class="text-md-center font-weight-bold" style="color: var(--text-dark);">
                                        {{ $item->quantity }} Cajas / Unidades
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td data-label="Medicamento">
                                        <div style="color: var(--card-blue-bottom); font-weight: 700;">Paracetamol 500mg</div>
                                        <div class="med-dosage">Indicación: 1 tableta cada 8 horas por 5 días.</div>
                                    </td>
                                    <td data-label="Cantidad" class="text-md-center" style="font-weight: 700;">2 Cajas</td>
                                </tr>
                                <tr>
                                    <td data-label="Medicamento">
                                        <div style="color: var(--card-blue-bottom); font-weight: 700;">Amoxicilina 250mg / Suspension</div>
                                        <div class="med-dosage">Indicación: 5ml cada 12 horas por 7 días.</div>
                                    </td>
                                    <td data-label="Cantidad" class="text-md-center" style="font-weight: 700;">1 Frasco</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>