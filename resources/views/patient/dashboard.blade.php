<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Paciente - Sanatorio San Carlos</title>
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
           RESTO DEL DISEÑO (DASHBOARD)
           ========================================= */
        .dashboard-container { max-width: 1100px; margin: 0 auto; padding-top: 50px; }
        
        .dashboard-header-title {
            color: var(--card-blue-bottom); font-weight: 800; font-size: 2.2rem; letter-spacing: -0.5px; margin-bottom: 8px;
        }

        .header-subtitle { font-size: 1rem; font-weight: 400; }

        .btn-action-primary {
            background-color: #0b1a30; color: var(--text-white); border-radius: 50px; padding: 14px 35px; font-weight: 700; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1.5px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); transition: all 0.3s ease; text-decoration: none; display: inline-block; border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-action-primary:hover { background-color: #051020; color: var(--text-white); transform: translateY(-2px); box-shadow: 0 15px 25px rgba(22, 76, 167, 0.3); }

        .header-spacing { margin-bottom: 3.5rem !important; }

        .dashboard-card {
            background: #ffffff; border-radius: 24px; border: none; box-shadow: 0 15px 40px rgba(22, 76, 167, 0.08); overflow: hidden; margin-bottom: 30px; transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover { transform: translateY(-4px); box-shadow: 0 20px 45px rgba(22, 76, 167, 0.12); }

        .card-header-gradient {
            background: linear-gradient(90deg, var(--card-blue-top) 0%, var(--card-blue-bottom) 100%); color: var(--text-white); padding: 20px 30px; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1.5px; border: none; display: flex; align-items: center;
        }

        .card-body-custom { padding: 30px; }

        /* TICKETS DE CITAS REALES */
        .appointment-item {
            border-left: 5px solid var(--card-blue-top); background: #f8fafc; border-radius: 12px; padding: 18px 22px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; transition: background 0.2s ease;
        }
        .appointment-item:hover { background: #f1f5f9; }
        .appointment-item:last-child { margin-bottom: 0; }

        .appointment-date { font-weight: 800; color: var(--card-blue-bottom); font-size: 1.1rem; margin-bottom: 4px; }
        .appointment-doctor { color: var(--text-muted); font-size: 0.9rem; font-weight: 600; }

        .status-badge {
            background: var(--bg-page-celeste); color: var(--card-blue-bottom); padding: 6px 14px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }

        /* FILAS DE RECETAS REALES */
        .prescription-item {
            border-bottom: 1px solid #e2e8f0; padding: 18px 0; display: flex; justify-content: space-between; align-items: center;
        }
        .prescription-item:first-child { padding-top: 0; }
        .prescription-item:last-child { border-bottom: none; padding-bottom: 0; }

        .prescription-folio { color: var(--card-blue-bottom); font-weight: 800; font-size: 1.05rem; margin-bottom: 4px; }
        .prescription-date { color: var(--text-muted); font-size: 0.85rem; font-weight: 600; }

        .btn-outline-pill {
            color: var(--card-blue-bottom); border: 2px solid var(--card-blue-bottom); background: transparent; border-radius: 50px; padding: 6px 18px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: all 0.2s ease; text-decoration: none; display: inline-block;
        }
        .btn-outline-pill:hover { background: var(--card-blue-bottom); color: var(--text-white); }

        .view-all-link { color: var(--card-blue-top); font-weight: 700; text-decoration: none; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s ease; }
        .view-all-link:hover { color: var(--card-blue-bottom); }

        .empty-state-box { text-align: center; padding: 40px 20px; color: var(--text-muted); }
        .empty-state-icon { font-size: 3.5rem; margin-bottom: 15px; opacity: 0.4; color: var(--card-blue-bottom); }

        /* RESPONSIVIDAD */
        @media (max-width: 991px) {
            .header-logo { height: 60px; } .header-title { font-size: 1.5rem; } .btn-logout { padding: 8px 20px; font-size: 1rem; } .header-container { padding: 0 15px; }
            .dashboard-header-title { font-size: 1.8rem; text-align: center; } .header-subtitle { text-align: center; } .btn-action-primary { width: 100%; text-align: center; }
            .appointment-item { flex-direction: column; align-items: flex-start; gap: 15px; }
            .prescription-item { flex-direction: column; align-items: flex-start; gap: 15px; }
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
                <h2 class="dashboard-header-title m-0">Mi Panel Médico</h2>
                <p class="text-muted header-subtitle mt-2 mb-0">Genera tus próximas citas y revisa tu historial clínico.</p>
            </div>
            <div class="col-md-4 text-center text-md-end mt-4 mt-md-0">
                <a href="{{ route('patient.book') }}" class="btn-action-primary">
                    <i class="fa-solid fa-calendar-plus me-2"></i> Agendar Cita
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="dashboard-card">
                    <div class="card-header-gradient">
                        <i class="fa-solid fa-stethoscope me-2"></i> Mis Próximas Citas
                    </div>
                    <div class="card-body-custom">
                        
                        @forelse($appointments ?? [] as $appointment)
                            <div class="appointment-item" style="{{ $appointment->status === 'present' || $appointment->status === 'completed' ? 'border-left-color: #cbd5e1; background: #f1f5f9;' : '' }}">
                                <div>
                                    <div class="appointment-date" style="{{ $appointment->status === 'present' || $appointment->status === 'completed' ? 'color: #64748b;' : '' }}">
                                        <i class="fa-regular fa-clock me-2"></i> 
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                    </div>
                                    <div class="appointment-doctor">
                                        Dr(a). {{ $appointment->doctor->user->name ?? 'Médico Especialista' }} - {{ $appointment->doctor->specialty ?? 'General' }}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="status-badge" style="{{ $appointment->status === 'present' || $appointment->status === 'completed' ? 'background: #e2e8f0; color: #64748b;' : '' }}">
                                        {{ $appointment->status }}
                                    </span>
                                    <a href="{{ route('patient.appointment.detail', $appointment->id_appointment) }}" class="btn-outline-pill">
                                        Ver detalle
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state-box">
                                <i class="fa-regular fa-calendar-xmark empty-state-icon"></i>
                                <h5>Sin citas programadas</h5>
                                <p class="mb-0">Actualmente no tienes citas médicas próximas en tu agenda.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="dashboard-card">
                    <div class="card-header-gradient">
                        <i class="fa-solid fa-pills me-2"></i> Recetas Recientes
                    </div>
                    <div class="card-body-custom">
                        
                        @forelse($prescriptions ?? [] as $prescription)
                            <div class="prescription-item">
                                <div>
                                    <div class="prescription-folio">Folio: #REC-00{{ $prescription->id_prescription }}</div>
                                    <div class="prescription-date">Emitida: {{ \Carbon\Carbon::parse($prescription->created_at)->format('d/m/Y') }}</div>
                                </div>
                                <a href="{{ route('patient.prescription.detail', $prescription->id_prescription) }}" class="btn-outline-pill">
                                    Ver detalle
                                </a>
                            </div>
                        @empty
                            <div class="empty-state-box" style="padding: 20px 10px;">
                                <i class="fa-solid fa-notes-medical empty-state-icon" style="font-size: 3rem;"></i>
                                <h6>Sin recetas recientes</h6>
                                <p style="font-size: 0.85rem;" class="mb-0">No se han emitido recetas médicas a tu nombre recientemente.</p>
                            </div>
                        @endforelse

                        <div class="text-center mt-4 pt-3" style="border-top: 1px dashed #e2e8f0;">
                            <a href="#" class="view-all-link">
                                Ver todo mi historial <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>