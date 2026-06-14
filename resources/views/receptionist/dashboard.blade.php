<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Recepción - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }
        :root { --bg-page-light: #f8fafc; --bg-page-celeste: #e0f2fe; --card-blue-top: #0284c7; --card-blue-bottom: #0369a1; --text-dark: #0f172a; --text-muted: #64748b; --text-white: #ffffff; }
        body { background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-celeste) 100%); background-attachment: fixed; font-family: 'Open Sans', sans-serif; min-height: 100vh; color: var(--text-dark); margin: 0; padding-bottom: 50px; }

        /* ==================== CABECERA ==================== */
        .sanatorio-header { background: linear-gradient(90deg, var(--card-blue-bottom) 0%, var(--card-blue-top) 100%); box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; padding: 15px 0; }
        .header-container { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 0 30px; }
        .header-box { flex: 1; display: flex; align-items: center; }
        .box-left { justify-content: flex-start; } .box-center { justify-content: center; } .box-right { justify-content: flex-end; }
        .header-logo { height: 70px; filter: brightness(0) invert(1); }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 1.8rem; margin: 0; }
        .btn-logout { background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 8px 25px; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; }
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        /* ==================== CONTENEDOR PRINCIPAL ==================== */
        .dashboard-container { max-width: 1200px; margin: 0 auto; padding-top: 40px; }
        .dashboard-header-title { color: var(--card-blue-bottom); font-weight: 800; font-size: 2rem; margin-bottom: 5px; }
        
        .dashboard-card { background: #ffffff; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 30px; }
        .card-header-custom { background: var(--card-blue-top); color: var(--text-white); padding: 18px 25px; font-weight: 800; font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase; border-bottom: 4px solid var(--card-blue-bottom); }
        
        /* ==================== DISEÑO MEJORADO DE FORMULARIO ==================== */
        .card-body-custom { padding: 35px; } /* Más espacio interno */
        
        .section-title { color: var(--card-blue-bottom); font-size: 1.15rem; font-weight: 800; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 10px; }
        .section-title.mt-custom { margin-top: 35px; } /* Separación entre bloques */

        .form-label-custom { color: #475569; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px; display: block; }
        
        /* Inputs sin bordes duros, con fondo suave */
        .sanatorio-input, .sanatorio-select { 
            background-color: #f4f6f9; 
            border: 2px solid transparent; 
            border-radius: 12px; 
            padding: 14px 20px; 
            color: #334155; 
            font-size: 1rem; 
            font-weight: 600; 
            width: 100%; 
            transition: all 0.3s ease; 
        }
        .sanatorio-input:focus, .sanatorio-select:focus { 
            background-color: #ffffff; 
            border-color: var(--card-blue-top); 
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15); 
            outline: none; 
        }
        .sanatorio-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1.2rem center; background-size: 14px; }
        
        .doctor-info-box { background: #f0f9ff; border: 1px solid #bae6fd; padding: 18px; margin-top: 15px; border-radius: 12px; display: none; transition: all 0.3s ease; }
        
        .btn-confirm { background-color: #0f172a; color: var(--text-white); border-radius: 12px; padding: 16px 0; font-weight: 800; font-size: 1.05rem; text-transform: uppercase; letter-spacing: 1.5px; width: 100%; border: none; transition: all 0.3s ease; margin-top: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-confirm:hover { background-color: var(--card-blue-bottom); transform: translateY(-2px); box-shadow: 0 8px 15px rgba(3, 105, 161, 0.3); }

        /* ==================== TABLA ==================== */
        .table-clinical th { background: #f1f5f9; color: var(--text-muted); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; padding: 18px; border-bottom: 2px solid #e2e8f0; letter-spacing: 0.5px; }
        .table-clinical td { padding: 18px; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; font-weight: 600; vertical-align: middle; color: #334155; }
        .badge-status { padding: 6px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
        .bg-available { background: #dcfce7; color: #15803d; }
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Recepción: {{ auth()->user()->first_name ?? 'Staff' }}</h1>
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
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="dashboard-header-title">Gestión de Agendas</h2>
                <p class="text-muted" style="font-size: 1.1rem;">Apertura de espacios y control de citas médicas.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5">
                <div class="dashboard-card">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-calendar-plus me-2"></i> Generación de Cita Médica
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('receptionist.store_schedule') }}" method="POST">
                            @csrf
                            
                            <div class="section-title">1. Selección de Médico</div>
                            
                            <label class="form-label-custom">Médico Especialista</label>
                            <select name="id_doctor" id="doctorSelect" class="sanatorio-select" required>
                                <option value="" selected disabled>Elige un doctor del catálogo...</option>
                                @foreach($doctors ?? [] as $doctor)
                                    <option value="{{ $doctor->id_doctor }}" 
                                            data-specialty="{{ $doctor->speciality }}" 
                                            data-license="{{ $doctor->professional_license }}">
                                        Dr(a). {{ $doctor->user->name }} {{ $doctor->user->first_name }} ({{ $doctor->speciality }})
                                    </option>
                                @endforeach
                            </select>

                            <div class="doctor-info-box" id="doctorInfoBox">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-user-doctor fa-2x me-3" style="color: var(--card-blue-top);"></i>
                                    <div>
                                        <div class="fw-bold" style="color: var(--card-blue-bottom); font-size: 0.95rem;" id="infoSpecialty">Especialidad</div>
                                        <div class="text-muted" style="font-size: 0.85rem;" id="infoLicense">Cédula: </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section-title mt-custom">2. Asignación de Turno</div>
                            
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Fecha de la cita</label>
                                    <input type="date" name="date" class="sanatorio-input" required min="{{ \Carbon\Carbon::today()->toDateString() }}">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Hora exacta</label>
                                    <input type="time" name="time" class="sanatorio-input" required>
                                </div>
                            </div>

                            <button type="submit" class="btn-confirm">
                                <i class="fa-solid fa-check-double me-2"></i> Registrar Espacio en Agenda
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom" style="background: #0f172a; border-bottom-color: #334155;">
                        <i class="fa-solid fa-list-check me-2"></i> Agenda Médica General
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-clinical mb-0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Médico</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_appointments ?? [] as $appt)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appt->date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appt->time)->format('h:i A') }}</td>
                                        <td>Dr(a). {{ $appt->doctor->user->name }}</td>
                                        <td>
                                            @if($appt->status === 'available')
                                                <span class="badge-status bg-available">Disponible</span>
                                            @elseif($appt->status === 'pending')
                                                <span class="badge-status" style="background: #fef9c3; color: #a16207;">Pendiente</span>
                                                
                                                <form action="{{ route('receptionist.checkin', $appt->id_appointment) }}" method="POST" class="d-inline ms-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm" style="font-size: 0.75rem;">
                                                        <i class="fa-solid fa-check me-1"></i> Pasar Asistencia
                                                    </button>
                                                </form>
                                                
                                            @elseif($appt->status === 'present')
                                                <span class="badge-status" style="background: #e0e7ff; color: #4338ca;">En Consultorio</span>
                                            @else
                                                <span class="badge-status bg-secondary text-white">{{ ucfirst($appt->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted fw-bold">
                                            <i class="fa-regular fa-calendar-xmark fa-2x mb-3 d-block"></i>
                                            Aún no hay horarios generados en el sistema.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lógica para mostrar info del doctor
            const doctorSelect = document.getElementById('doctorSelect');
            const infoBox = document.getElementById('doctorInfoBox');
            const infoSpecialty = document.getElementById('infoSpecialty');
            const infoLicense = document.getElementById('infoLicense');

            doctorSelect.addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                if (selected.value) {
                    infoSpecialty.textContent = selected.getAttribute('data-specialty');
                    infoLicense.textContent = "Cédula: " + selected.getAttribute('data-license');
                    infoBox.style.display = 'block'; 
                } else {
                    infoBox.style.display = 'none'; 
                }
            });

            // Disparador de SweetAlert2
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Espacio Registrado!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#0284c7',
                    background: '#ffffff',
                    borderRadius: '16px',
                    customClass: {
                        popup: 'shadow-lg border-0'
                    }
                });
            @endif
        });
    </script>
</body>
</html>