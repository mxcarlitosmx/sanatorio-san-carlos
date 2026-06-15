<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }
        :root { 
            --bg-page-light: #f8fafc; 
            --bg-page-cyan: #cffafe; 
            --card-cyan-top: #0891b2; 
            --card-cyan-bottom: #164e63; 
            --card-blue-top: #0284c7; 
            --card-blue-bottom: #0369a1; 
            --text-dark: #0f172a; 
            --text-muted: #64748b; 
            --text-white: #ffffff; 
        }
        body { background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-cyan) 100%); background-attachment: fixed; font-family: 'Open Sans', sans-serif; min-height: 100vh; color: var(--text-dark); margin: 0; padding-bottom: 50px; }

        /* CABECERA AZUL INSTITUCIONAL */
        .sanatorio-header { background: linear-gradient(90deg, var(--card-blue-bottom) 0%, var(--card-blue-top) 100%); box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; padding: 15px 0; }
        .header-container { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 0 30px; }
        .header-box { flex: 1; display: flex; align-items: center; }
        .box-left { justify-content: flex-start; } .box-center { justify-content: center; } .box-right { justify-content: flex-end; }
        .header-logo { height: 70px; filter: brightness(0) invert(1); }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 1.8rem; margin: 0; }
        .btn-logout { background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 8px 25px; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; }
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        .dashboard-container { max-width: 1200px; margin: 0 auto; padding-top: 40px; }
        .dashboard-header-title { color: var(--card-cyan-bottom); font-weight: 800; font-size: 2rem; margin-bottom: 5px; }
        
        .dashboard-card { background: #ffffff; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 30px; }
        .card-header-custom { background: var(--card-cyan-top); color: var(--text-white); padding: 18px 25px; font-weight: 800; font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase; border-bottom: 4px solid var(--card-cyan-bottom); }
        
        .table-pharma th { background: #f1f5f9; color: var(--text-muted); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; padding: 18px; border-bottom: 2px solid #e2e8f0; letter-spacing: 0.5px; }
        .table-pharma td { padding: 18px; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; font-weight: 600; vertical-align: middle; color: #334155; }
        
        .folio-text { color: var(--card-cyan-top); font-family: monospace; font-weight: 800; font-size: 1.05rem; letter-spacing: 1px; }
        
        .btn-surtir { background-color: #0f172a; color: var(--text-white); border-radius: 10px; padding: 10px 20px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-surtir:hover { background-color: var(--card-cyan-top); transform: translateY(-2px); color: white; box-shadow: 0 8px 15px rgba(8, 145, 178, 0.3); }

        .badge-status { padding: 6px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Farmacia: {{ auth()->user()->first_name ?? 'Farmacéutico' }}</h1>
            </div>
            <div class="header-box box-right">
                <a href="{{ route('pharmacist.inventory') }}" class="btn-logout me-3">
                    <i class="fa-solid fa-boxes-stacked me-1"></i> Inventario
                </a>

                <form method="POST" action="{{ url('/logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn-logout border-0 bg-transparent text-white fw-bold" title="Cerrar Sesión">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid px-4 dashboard-container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="dashboard-header-title">Mostrador de Farmacia</h2>
                <p class="text-muted" style="font-size: 1.1rem;">Surtido y entrega de recetas médicas a pacientes.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-prescription-bottle-medical me-2"></i> Recetas por Surtir
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-pharma mb-0">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Paciente</th>
                                    <th>Médico</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pending_prescriptions ?? [] as $prescription)
                                    <tr>
                                        <td class="folio-text">REC-00{{ $prescription->id_prescription }}</td>
                                        <td>{{ $prescription->consultation->appointment->patient->user->name ?? 'Paciente' }}</td>
                                        <td class="text-muted" style="font-size: 0.85rem;">
                                            Dr(a). {{ $prescription->consultation->doctor->user->first_name ?? 'Médico' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('pharmacist.dispense', $prescription->id_prescription) }}" class="btn-surtir text-decoration-none d-inline-block">
                                                <i class="fa-solid fa-box-open me-1"></i> Surtir
                                            </a>
                                            <a href="#" class="btn btn-sm btn-outline-secondary ms-1 rounded-3">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted fw-bold">
                                            <i class="fa-solid fa-prescription fa-2x mb-3 d-block" style="color: #cbd5e1;"></i>
                                            No hay recetas pendientes en este momento.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom" style="background: #0f172a; border-bottom-color: #334155;">
                        <i class="fa-solid fa-clipboard-check me-2"></i> Últimas Entregas
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-pharma mb-0">
                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Paciente</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recent_dispensed ?? [] as $delivered)
                                    <tr>
                                        <td class="folio-text" style="color: #64748b;">REC-00{{ $delivered->id_prescription }}</td>
                                        <td class="fw-bold">{{ $delivered->consultation->appointment->patient->user->first_name ?? 'Paciente' }}</td>
                                        <td>
                                            <span class="badge-status" style="background: #cffafe; color: #0891b2;">Entregado</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted fw-bold">
                                            Aún no has surtido recetas hoy.
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
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Receta Surtida!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#0891b2',
                    background: '#ffffff',
                    borderRadius: '16px',
                    customClass: { popup: 'shadow-lg border-0' }
                });
            @endif
        });
    </script>
</body>
</html>