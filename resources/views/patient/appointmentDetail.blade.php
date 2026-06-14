<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Cita - Sanatorio San Carlos</title>
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
        .header-logo:hover { transform: scale(1.05); }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 2rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-logout {
            background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 10px 30px; font-size: 1.1rem; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;
        }
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        /* =========================================
           CONTENEDOR Y DISEÑO DE TARJETA
           ========================================= */
        .dashboard-container { max-width: 850px; margin: 0 auto; padding-top: 50px; }
        .dashboard-header-title { color: var(--card-blue-bottom); font-weight: 800; font-size: 2.2rem; letter-spacing: -0.5px; margin-bottom: 8px; }
        .header-spacing { margin-bottom: 2.5rem !important; }
        
        .btn-back {
            color: var(--text-muted); font-weight: 700; text-decoration: none; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s ease; display: inline-flex; align-items: center;
        }
        .btn-back:hover { color: var(--card-blue-bottom); }

        .dashboard-card {
            background: #ffffff; border-radius: 24px; border: none; box-shadow: 0 15px 40px rgba(22, 76, 167, 0.08); overflow: hidden;
        }
        .card-header-gradient {
            background: linear-gradient(90deg, var(--card-blue-top) 0%, var(--card-blue-bottom) 100%);
            color: var(--text-white); padding: 20px 30px; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1.5px;
        }
        .card-body-custom { padding: 40px; }

        /* DETALLES INTERNOS */
        .info-section-title {
            color: var(--card-blue-bottom); font-size: 1.1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px; margin-bottom: 20px; display: block;
        }
        .meta-label { font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 2px; }
        .meta-value { font-size: 1.1rem; color: var(--text-dark); font-weight: 600; margin-bottom: 20px; }
        
        .status-badge-detail {
            display: inline-block; padding: 6px 20px; border-radius: 50px; font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;
        }
        .badge-completed { background: #dcfce7; color: #15803d; }
        .badge-pending { background: #fef9c3; color: #a16207; }

        .clinical-text-box {
            background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; padding: 20px; font-size: 1rem; line-height: 1.6; font-weight: 500; color: #334155; margin-bottom: 20px;
        }

        @media (max-width: 991px) {
            .header-logo { height: 60px; } .header-title { font-size: 1.5rem; } .btn-logout { padding: 8px 20px; font-size: 1rem; } .header-container { padding: 0 15px; }
            .dashboard-header-title { font-size: 1.8rem; text-align: center; } .btn-back-container { text-align: center; margin-top: 15px; }
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
                <h2 class="dashboard-header-title m-0">Resumen de Cita</h2>
                <p class="text-muted mt-2 mb-0">Consulta los detalles de tu reservación e historial clínico.</p>
            </div>
            <div class="col-md-4 text-end btn-back-container">
                <a href="{{ route('patient.dashboard') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left me-2"></i> Volver al panel
                </a>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header-gradient">
                <i class="fa-solid fa-file-medical me-2"></i> Expediente de la Consulta
            </div>
            <div class="card-body-custom">
                
                <span class="info-section-title"><i class="fa-regular fa-calendar-check me-2"></i> Información General</span>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="meta-label">Fecha de la Cita</div>
                        <div class="meta-value">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="meta-label">Horario asignado</div>
                        <div class="meta-value">{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</div>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-3 mb-md-0">
                        <div class="meta-label">Estado actual</div>
                        @if($appointment->status === 'present' || $appointment->status === 'completed')
                            <span class="status-badge-detail badge-completed">Completada</span>
                        @else
                            <span class="status-badge-detail badge-pending">Pendiente</span>
                        @endif
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="meta-label">Médico Especialista</div>
                        <div class="meta-value">Dr(a). {{ $appointment->doctor->user->name ?? 'Médico Asignado' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="meta-label">Especialidad Clínica</div>
                        <div class="meta-value">{{ $appointment->doctor->specialty ?? 'General' }}</div>
                    </div>
                </div>

                @if($appointment->consultation)
                    <span class="info-section-title mt-4"><i class="fa-solid fa-heart-pulse me-2"></i> Signos Vitales y Diagnóstico</span>
                    <div class="row">
                        <div class="col-6 col-sm-3">
                            <div class="meta-label">Peso registrado</div>
                            <div class="meta-value">{{ $appointment->consultation->current_weight }} kg</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="meta-label">Estatura medida</div>
                            <div class="meta-value">{{ $appointment->consultation->current_height }} m</div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="meta-label">Síntomas declarados</div>
                            <div class="clinical-text-box">
                                {{ $appointment->consultation->symptoms }}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="meta-label">Diagnóstico Clínico</div>
                            <div class="clinical-text-box" style="border-left: 4px solid var(--card-blue-bottom);">
                                {{ $appointment->consultation->diagnosis }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info rounded-3 mt-4 p-4 border-0 d-flex align-items-center" style="background-color: #f0f7ff; color: #0369a1;">
                        <i class="fa-solid fa-circle-info fa-2x me-3 opacity-70"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Cita en espera de atención</h6>
                            <p class="small mb-0">Los datos de diagnóstico, peso y síntomas aparecerán aquí una vez que seas atendido en el Sanatorio.</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>