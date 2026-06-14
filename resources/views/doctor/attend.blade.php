<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atender Consulta - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }

        :root {
            --bg-page-light: #ffffff; --bg-page-celeste: #dbeafe; --card-blue-top: #3a9edb; --card-blue-bottom: #164ca7; --text-dark: #1e293b; --text-muted: #64748b; --text-white: #ffffff;
        }

        body { background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-celeste) 100%); background-attachment: fixed; font-family: 'Open Sans', sans-serif; min-height: 100vh; color: var(--text-dark); margin: 0; padding-bottom: 50px; }

        /* ========================================= CABECERA ========================================= */
        .sanatorio-header { background: linear-gradient(90deg, var(--card-blue-bottom) 0%, var(--card-blue-top) 100%); box-shadow: 0 10px 20px rgba(22, 76, 167, 0.15); width: 100%; padding: 15px 0; }
        .header-container { display: flex; justify-content: space-between; align-items: center; flex-wrap: nowrap; width: 100%; padding: 0 30px; }
        .header-box { flex: 1; display: flex; align-items: center; min-width: 0; }
        .box-left { justify-content: flex-start; } .box-center { justify-content: center; } .box-right { justify-content: flex-end; }
        .header-logo { height: 90px; width: auto; max-width: 100%; filter: brightness(0) invert(1); transition: transform 0.3s ease; }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 2rem; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .btn-logout { background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 10px 30px; font-size: 1.1rem; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; }
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        /* ========================================= FORMULARIO ========================================= */
        .dashboard-container { max-width: 900px; margin: 0 auto; padding-top: 50px; }
        .dashboard-header-title { color: var(--card-blue-bottom); font-weight: 800; font-size: 2.2rem; letter-spacing: -0.5px; margin-bottom: 8px; }
        .header-spacing { margin-bottom: 2.5rem !important; }
        .btn-back { color: var(--text-muted); font-weight: 700; text-decoration: none; font-size: 0.95rem; text-transform: uppercase; letter-spacing: 1px; transition: color 0.2s ease; display: inline-flex; align-items: center; }
        .btn-back:hover { color: var(--card-blue-bottom); }

        .dashboard-card { background: #ffffff; border-radius: 24px; border: none; box-shadow: 0 15px 40px rgba(22, 76, 167, 0.08); overflow: hidden; }
        .card-header-gradient { background: linear-gradient(90deg, var(--card-blue-top) 0%, var(--card-blue-bottom) 100%); color: var(--text-white); padding: 20px 30px; font-weight: 700; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1.5px; }
        .card-body-custom { padding: 40px; }

        .section-title { color: var(--text-muted); font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px; display: block; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px; }
        
        .input-group-custom { position: relative; width: 100%; margin-bottom: 20px; }
        .input-group-custom .icon-left { position: absolute; left: 20px; top: 16px; color: var(--card-blue-bottom); font-size: 1.1rem; z-index: 5; }
        
        .sanatorio-input, .sanatorio-textarea, .sanatorio-select { background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 15px; padding: 14px 20px 14px 50px; color: var(--text-dark); font-size: 1rem; font-weight: 500; width: 100%; transition: all 0.3s ease; }
        .sanatorio-textarea { padding-top: 14px; padding-left: 20px; resize: vertical; min-height: 120px; }
        .sanatorio-select { appearance: none; padding-left: 50px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px 12px; }
        .sanatorio-input:focus, .sanatorio-textarea:focus, .sanatorio-select:focus { background: #ffffff; border-color: var(--card-blue-top); box-shadow: 0 0 0 4px rgba(58, 158, 219, 0.15); outline: none; }

        .patient-info-box { background: #eff6ff; border-left: 4px solid var(--card-blue-bottom); padding: 15px 20px; border-radius: 0 12px 12px 0; margin-bottom: 30px; display: flex; align-items: center; gap: 15px; }

        /* Botones de acción */
        .btn-confirm { background-color: #0b1a30; color: var(--text-white); border-radius: 50px; padding: 16px 0; font-weight: 800; font-size: 1.05rem; text-transform: uppercase; letter-spacing: 2px; width: 100%; border: none; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); transition: all 0.3s ease; margin-top: 20px; }
        .btn-confirm:hover { background-color: var(--card-blue-bottom); transform: translateY(-2px); box-shadow: 0 15px 25px rgba(22, 76, 167, 0.3); }
        
        .btn-add-medicine { background: transparent; border: 2px dashed var(--card-blue-top); color: var(--card-blue-top); border-radius: 12px; padding: 12px; font-weight: 700; width: 100%; text-transform: uppercase; letter-spacing: 1px; transition: all 0.2s ease; margin-bottom: 20px; }
        .btn-add-medicine:hover { background: #eff6ff; border-style: solid; }
        
        .btn-remove-medicine { background: #fee2e2; color: #ef4444; border: none; border-radius: 12px; padding: 14px; font-weight: 700; width: 100%; transition: all 0.2s ease; }
        .btn-remove-medicine:hover { background: #fca5a5; color: #ffffff; }

        /* Contenedor dinámico de medicamento */
        .medicine-row { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-bottom: 15px; position: relative; transition: all 0.3s ease; }
        .medicine-row:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-color: #cbd5e1; }

        @media (max-width: 991px) {
            .header-logo { height: 60px; } .header-title { font-size: 1.5rem; } .btn-logout { padding: 8px 20px; font-size: 1rem; } .header-container { padding: 0 15px; }
            .dashboard-header-title { font-size: 1.8rem; text-align: center; } .btn-back-container { text-align: center; margin-top: 15px; }
        }
        @media (max-width: 576px) { .header-logo { height: 40px; } .header-title { font-size: 1.1rem; } .btn-logout { padding: 6px 15px; font-size: 0.85rem; } }
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <a href="{{ route('doctor.dashboard') }}">
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
            <div class="col-md-8 text-center text-md-start">
                <h2 class="dashboard-header-title m-0">Atención en Consultorio</h2>
                <p class="text-muted mt-2 mb-0">Completa el expediente clínico y emite la receta.</p>
            </div>
            <div class="col-md-4 text-end btn-back-container">
                <a href="{{ route('doctor.dashboard') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left me-2"></i> Volver a la agenda
                </a>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header-gradient">
                <i class="fa-solid fa-file-medical me-2"></i> Hoja de Valoración Clínica
            </div>
            <div class="card-body-custom">
                
                <div class="patient-info-box">
                    <i class="fa-solid fa-hospital-user fa-2x" style="color: var(--card-blue-bottom);"></i>
                    <div>
                        <h6 class="m-0 fw-bold" style="color: var(--card-blue-bottom);">
                            Paciente: {{ $appointment->patient->user->name ?? 'Nombre del Paciente' }} {{ $appointment->patient->user->first_name ?? '' }}
                        </h6>
                        <small class="text-muted fw-bold">
                            CURP: {{ $appointment->patient->curp ?? 'N/A' }} | Horario: {{ \Carbon\Carbon::parse($appointment->time ?? now())->format('h:i A') }}
                        </small>
                    </div>
                </div>

                <form action="{{ route('doctor.store_consultation', $appointment->id_appointment) }}" method="POST">
                    @csrf

                    <span class="section-title">1. Signos Vitales (Triage)</span>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted fw-bold small mb-2 ms-2">Peso Actual (kg)</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-weight-scale icon-left"></i>
                                <input type="number" step="0.01" name="current_weight" class="sanatorio-input" placeholder="Ej. 75.50" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted fw-bold small mb-2 ms-2">Estatura (metros)</label>
                            <div class="input-group-custom">
                                <i class="fa-solid fa-ruler-vertical icon-left"></i>
                                <input type="number" step="0.01" name="current_height" class="sanatorio-input" placeholder="Ej. 1.75" required>
                            </div>
                        </div>
                    </div>

                    <span class="section-title mt-3">2. Valoración Médica</span>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="text-muted fw-bold small mb-2 ms-2">Síntomas Reportados</label>
                            <textarea name="symptoms" class="sanatorio-textarea" placeholder="Describe los síntomas del paciente..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="text-muted fw-bold small mb-2 ms-2">Diagnóstico Clínico</label>
                            <textarea name="diagnosis" class="sanatorio-textarea" placeholder="Indica el diagnóstico médico oficial..." required></textarea>
                        </div>
                    </div>

                    <span class="section-title mt-4">3. Tratamiento Farmacológico (Receta)</span>
                    
                    <div id="medicines-container">
                        </div>

                    <button type="button" class="btn-add-medicine" id="btnAddMedicine">
                        <i class="fa-solid fa-plus me-2"></i> Añadir Medicamento a la Receta
                    </button>

                    <button type="submit" class="btn-confirm mt-3">
                        <i class="fa-solid fa-check-double me-2"></i> Guardar Consulta y Emitir Receta
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('medicines-container');
            const btnAdd = document.getElementById('btnAddMedicine');
            let medicineCount = 0;

            // Datos de catálogo inyectados desde Laravel (esto lo mandaremos desde el controlador)
            const catalog = @json($medicines ?? []); 

            function addMedicineRow() {
                medicineCount++;
                
                // Construir las opciones del Select iterando el catálogo de la DB
                let optionsHtml = '<option value="" disabled selected>Selecciona un fármaco del catálogo...</option>';
                catalog.forEach(med => {
                    optionsHtml += `<option value="${med.id_medicine}">${med.name} - ${med.dosage} ($${med.price})</option>`;
                });

                const rowHtml = `
                    <div class="row medicine-row align-items-center" id="row-${medicineCount}">
                        <div class="col-md-5 mb-3 mb-md-0">
                            <label class="text-muted fw-bold small mb-2 ms-2">Medicamento</label>
                            <div class="input-group-custom mb-0">
                                <i class="fa-solid fa-capsules icon-left"></i>
                                <select name="medicines[]" class="sanatorio-select" required>
                                    ${optionsHtml}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="text-muted fw-bold small mb-2 ms-2">Indicación / Frecuencia</label>
                            <div class="input-group-custom mb-0">
                                <i class="fa-regular fa-clock icon-left"></i>
                                <input type="text" name="frequencies[]" class="sanatorio-input" placeholder="Ej. 1 tab cada 8hrs" style="padding-left: 45px;" required>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3 mb-md-0">
                            <label class="text-muted fw-bold small mb-2 ms-2">Cajas</label>
                            <div class="input-group-custom mb-0">
                                <i class="fa-solid fa-box icon-left" style="left: 15px;"></i>
                                <input type="number" name="quantities[]" class="sanatorio-input" min="1" value="1" style="padding-left: 40px;" required>
                            </div>
                        </div>
                        <div class="col-md-1 text-end mt-3 mt-md-4">
                            <button type="button" class="btn-remove-medicine" onclick="removeMedicineRow(${medicineCount})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', rowHtml);
            }

            // Añadir una fila vacía por defecto al cargar la página
            addMedicineRow();

            // Evento click para añadir más
            btnAdd.addEventListener('click', addMedicineRow);

            // Función global para eliminar una fila
            window.removeMedicineRow = function(id) {
                const row = document.getElementById(`row-${id}`);
                if (row) row.remove();
            };
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>