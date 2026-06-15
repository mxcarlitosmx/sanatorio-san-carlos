<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Médico - Sanatorio San Carlos</title>
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
            --status-green: #10b981;
            --status-orange: #f59e0b;
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

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: nowrap;
            width: 100%;
            padding: 0 30px;
        }

        .header-box { flex: 1; display: flex; align-items: center; min-width: 0; }
        .box-left { justify-content: flex-start; }
        .box-center { justify-content: center; }
        .box-right { justify-content: flex-end; }

        .header-logo {
            height: 90px; width: auto; max-width: 100%; filter: brightness(0) invert(1); transition: transform 0.3s ease;
        }
        .header-logo:hover { transform: scale(1.05); }

        .header-title {
            color: var(--text-white); font-weight: 800; font-size: 2rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .btn-logout {
            background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 10px 30px; font-size: 1.1rem; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; cursor: pointer;
        }
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        /* =========================================
           CONTENEDOR PRINCIPAL Y TARJETAS MÉTRICAS
           ========================================= */
        .dashboard-container { max-width: 1200px; margin: 0 auto; padding-top: 50px; }
        
        .dashboard-header-title {
            color: var(--card-blue-bottom); font-weight: 800; font-size: 2.2rem; letter-spacing: -0.5px; margin-bottom: 8px;
        }
        .header-spacing { margin-bottom: 3rem !important; }

        .metric-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            border: none;
            box-shadow: 0 10px 30px rgba(22, 76, 167, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }
        .metric-icon-box {
            width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem;
        }

        /* =========================================
           TABLA DE CONTROL DE PACIENTES
           ========================================= */
        .dashboard-card {
            background: #ffffff; border-radius: 24px; border: none; box-shadow: 0 15px 40px rgba(22, 76, 167, 0.08); overflow: hidden;
        }
        .card-header-gradient {
            background: linear-gradient(90deg, var(--card-blue-top) 0%, var(--card-blue-bottom) 100%);
            color: var(--text-white); padding: 20px 30px; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1.5px;
        }

        .table-clinical { width: 100%; margin: 0; vertical-align: middle; }
        .table-clinical th {
            background: #f8fafc; color: var(--card-blue-bottom); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; padding: 18px 25px; border: none;
        }
        .table-clinical td { padding: 22px 25px; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; font-weight: 600; }
        .table-clinical tr:last-child td { border-bottom: none; }

        /* Estados de citas de tu Enum */
        .badge-status {
            padding: 6px 14px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;
        }
        .status-present { background: #dcfce7; color: #15803d; } /* En sala de espera */
        .status-pending { background: #fef9c3; color: #a16207; } /* Agendada en espera */

        /* BOTÓN INTERACTIVO ATENDER */
        .btn-attend {
            background-color: #0b1a30; color: var(--text-white); border-radius: 50px; padding: 8px 22px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; border: none; transition: all 0.3s ease; text-decoration: none; display: inline-block;
        }
        .btn-attend:hover {
            background-color: var(--card-blue-bottom); transform: translateY(-1px); box-shadow: 0 5px 15px rgba(22, 76, 167, 0.25); color: var(--text-white);
        }

        .empty-state-box { text-align: center; padding: 60px 20px; color: var(--text-muted); }
        .empty-state-icon { font-size: 4rem; margin-bottom: 20px; opacity: 0.4; color: var(--card-blue-bottom); }

        /* RESPONSIVIDAD */
        @media (max-width: 991px) {
            .header-logo { height: 60px; } .header-title { font-size: 1.5rem; } .btn-logout { padding: 8px 20px; font-size: 1rem; } .header-container { padding: 0 15px; }
            .dashboard-header-title { font-size: 1.8rem; text-align: center; } .header-subtitle { text-align: center; }
            .table-clinical th { display: none; }
            .table-clinical td { display: block; width: 100%; text-align: left; padding: 12px 25px; border: none; }
            .table-clinical td:first-child { padding-top: 22px; font-size: 1.1rem; }
            .table-clinical td:last-child { padding-bottom: 22px; border-bottom: 2px solid #e2e8f0; }
            .table-clinical td::before { content: attr(data-label); display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 2px; }
            .table-clinical td[data-label="Acción"]::before { display: none; }
        }
        @media (max-width: 576px) {
            .header-logo { height: 40px; } .header-title { font-size: 1.1rem; } .btn-logout { padding: 6px 15px; font-size: 0.85rem; }
        }
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <a href="#">
                    <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
                </a>
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Bienvenido, Dr. {{ auth()->user()->name ?? 'Médico' }}</h1>
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
            <div class="col-12">
                <h2 class="dashboard-header-title m-0">Panel de Control Clínico</h2>
                <p class="text-muted header-subtitle mt-2 mb-0">Gestiona las consultas del día y realiza valoraciones médicas de tus pacientes.</p>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-4">
                <div class="metric-card">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold small mb-1" style="letter-spacing: 0.5px;">Pacientes en espera</h6>
                        <h3 class="m-0 fw-bold" style="color: var(--card-blue-bottom);">{{ $waiting_count ?? '0' }}</h3>
                    </div>
                    <div class="metric-icon-box" style="background: #eff6ff; color: #2563eb;">
                        <i class="fa-solid fa-hospital-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="metric-card">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold small mb-1" style="letter-spacing: 0.5px;">Consultas Completadas</h6>
                        <h3 class="m-0 fw-bold" style="color: var(--status-green);">{{ $completed_count ?? '0' }}</h3>
                    </div>
                    <div class="metric-icon-box" style="background: #ecfdf5; color: var(--status-green);">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-md-none d-lg-flex">
                <div class="metric-card w-100">
                    <div>
                        <h6 class="text-muted text-uppercase fw-bold small mb-1" style="letter-spacing: 0.5px;">Fecha Actual</h6>
                        <h5 class="m-0 fw-bold text-dark mt-1">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</h5>
                    </div>
                    <div class="metric-icon-box" style="background: #f8fafc; color: var(--text-dark);">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header-gradient">
                <i class="fa-solid fa-notes-medical me-2"></i> Lista de Espera y Citas Programadas de Hoy
            </div>
            
            <div class="table-responsive">
                <table class="table table-clinical">
                    <thead>
                        <tr>
                            <th>Horario</th>
                            <th>Paciente</th>
                            <th>CURP</th>
                            <th>Estado de la Cita</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse($today_appointments ?? [] as $appointment)
                            <tr>
                                <td data-label="Horario" style="color: var(--card-blue-bottom); font-weight: 700;">
                                    {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                </td>
                                <td data-label="Paciente">
                                    {{ $appointment->patient->user->name ?? 'Nombre' }} {{ $appointment->patient->user->first_name ?? '' }}
                                </td>
                                <td data-label="CURP" style="letter-spacing: 0.5px; font-size: 0.9rem;">
                                    {{ $appointment->patient->curp ?? 'N/A' }}
                                </td>
                                <td data-label="Estado de la Cita">
                                    @if($appointment->status === 'present')
                                        <span class="badge-status status-present"><i class="fa-solid fa-street-view me-1"></i> En Sala</span>
                                    @elseif($appointment->status === 'completed')
                                        <span class="badge-status" style="background: #e0e7ff; color: #4338ca;"><i class="fa-solid fa-check-double me-1"></i> Completada</span>
                                    @else
                                        <span class="badge-status status-pending"><i class="fa-regular fa-clock me-1"></i> Pendiente</span>
                                    @endif
                                </td>
                                <td class="text-md-end" data-label="Acción">
                                    @if($appointment->status === 'completed')
                                        <span class="text-muted fw-bold" style="font-size: 0.9rem;"><i class="fa-solid fa-lock me-1"></i> Finalizada</span>
                                    @else
                                        <a href="{{ route('doctor.attend', $appointment->id_appointment) }}" class="btn-attend">
                                            Atender <i class="fa-solid fa-chevron-right ms-1" style="font-size: 0.75rem;"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-0">
                                    <div class="empty-state-box">
                                        <i class="fa-solid fa-user-clock empty-state-icon"></i>
                                        <h5 class="fw-bold">No tienes pacientes en agenda hoy</h5>
                                        <p class="mb-0 text-muted">No se registran citas pendientes o pacientes confirmados para tu consultorio en esta fecha.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>