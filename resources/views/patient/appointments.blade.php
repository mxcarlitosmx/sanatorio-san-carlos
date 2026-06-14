<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Disponibles - Sanatorio San Carlos</title>
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
            flex-wrap: nowrap; /* PROHIBIDO APILARSE */
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
           CONTENEDOR PRINCIPAL
           ========================================= */
        .dashboard-container { max-width: 1100px; margin: 0 auto; padding-top: 50px; }
        
        .dashboard-header-title {
            color: var(--card-blue-bottom); font-weight: 800; font-size: 2.2rem; letter-spacing: -0.5px; margin-bottom: 8px;
        }

        .header-subtitle { font-size: 1rem; font-weight: 400; }
        .header-spacing { margin-bottom: 3.5rem !important; }

        /* BOTÓN VOLVER */
        .btn-back {
            color: var(--text-muted); font-weight: 700; text-decoration: none; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s ease; display: inline-flex; align-items: center;
        }
        .btn-back:hover { color: var(--card-blue-bottom); }

        /* =========================================
           TARJETAS DE CITAS DISPONIBLES (TICKETS)
           ========================================= */
        .ticket-card {
            background: #ffffff;
            border-radius: 20px;
            border: none;
            border-top: 6px solid var(--card-blue-top);
            box-shadow: 0 10px 30px rgba(22, 76, 167, 0.08);
            padding: 25px;
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(22, 76, 167, 0.15);
        }

        .ticket-date {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--card-blue-bottom);
            margin-bottom: 5px;
        }

        .ticket-time {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--card-blue-top);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .ticket-doctor {
            font-size: 0.95rem;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 2px;
        }

        .ticket-specialty {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        /* BOTÓN DE UN SOLO CLIC */
        .btn-claim {
            background-color: #0b1a30;
            color: var(--text-white);
            border-radius: 50px;
            padding: 12px 0;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            border: none;
            margin-top: auto; /* Empuja el botón al fondo si la tarjeta es más alta */
            transition: all 0.3s ease;
        }

        .btn-claim:hover {
            background-color: var(--card-blue-bottom);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(22, 76, 167, 0.3);
        }

        /* ESTADOS VACÍOS */
        .empty-state-box { background: rgba(255,255,255,0.7); border-radius: 20px; text-align: center; padding: 60px 20px; color: var(--text-muted); width: 100%; box-shadow: 0 10px 30px rgba(22, 76, 167, 0.05); }
        .empty-state-icon { font-size: 4rem; margin-bottom: 20px; opacity: 0.5; color: var(--card-blue-bottom); }

        /* RESPONSIVIDAD */
        @media (max-width: 991px) {
            .header-logo { height: 60px; } .header-title { font-size: 1.5rem; } .btn-logout { padding: 8px 20px; font-size: 1rem; } .header-container { padding: 0 15px; }
            .dashboard-header-title { font-size: 1.8rem; text-align: center; } .header-subtitle { text-align: center; }
            .btn-back-container { text-align: center; margin-top: 20px; }
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
                <a href="{{ url('/patient/dashboard') }}">
                    <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
                </a>
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Bienvenido {{ auth()->user()->name ?? 'Usuario' }}</h1>
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
                <h2 class="dashboard-header-title m-0">Citas Disponibles</h2>
                <p class="text-muted header-subtitle mt-2 mb-0">Selecciona el horario de tu preferencia para agendar tu consulta al instante.</p>
            </div>
            
            <div class="col-md-4 text-end btn-back-container">
                <a href="{{ url('/patient/dashboard') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left me-2"></i> Volver al panel
                </a>
            </div>
        </div>

        <div class="row">
            
            @forelse($available_appointments ?? [] as $appointment)
                <div class="col-md-6 col-lg-4">
                    <div class="ticket-card">
                        
                        <div class="ticket-date">
                            <i class="fa-regular fa-calendar me-2"></i> {{ \Carbon\Carbon::parse($appointment->date)->format('d M, Y') }}
                        </div>
                        <div class="ticket-time">
                            <i class="fa-regular fa-clock me-2"></i> {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                        </div>
                        
                        <div class="ticket-doctor">
                            <i class="fa-solid fa-user-doctor me-2" style="color: var(--text-muted);"></i> 
                            Dr(a). {{ $appointment->doctor->user->name ?? 'Nombre del Médico' }}
                        </div>
                        <div class="ticket-specialty">
                            <i class="fa-solid fa-stethoscope me-2" style="color: var(--text-muted);"></i>
                            {{ $appointment->doctor->specialty ?? 'Especialidad' }}
                        </div>

                        <form action="{{ url('/patient/book/' . $appointment->id_appointment) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="btn-claim">
                                Seleccionar Cita
                            </button>
                        </form>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state-box">
                        <i class="fa-solid fa-calendar-xmark empty-state-icon"></i>
                        <h4 style="font-weight: 800; color: var(--card-blue-bottom);">No hay citas disponibles por el momento</h4>
                        <p class="mb-0">El personal médico aún no ha liberado espacios en la agenda. Por favor, regresa más tarde.</p>
                    </div>
                </div>
            @endforelse

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>