<div class="active tab-pane" id="Datos_trabajador">
    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info_personal-tab" data-toggle="tab" href="#info_personal" role="tab"
                    aria-selected="true">1. Información Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="info-laboral-tab" data-toggle="tab" href="#info_laboral" role="tab"
                    aria-selected="false">2. Información laboral</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="info_personal" role="tabpanel">
                <div class="row">
                    <x-input-icon type="text" name="nombre_trabajador" id="nombre_trabajador" label="Nombre Completo"
                        topclass="col-md-12" icon="fas fa-user" disabled
                        value="{{ $trabajador->nombre . ' ' . $trabajador->apellido_paterno . ' ' . $trabajador->apellido_materno }}" />
                    <x-dg-input type="text" name="ci_trabajador" id="ci_trabajador" disabled label="Documento(CI)"
                        value="{{ $trabajador->ci . $comp . $trabajador->complemento }}" topclass="col-md-5" />
                    <x-dg-select id="expedido" name="expedido" disabled label="Expedido" topclass="col-md-4">
                        <option value="">--SELECCIONE--</option>
                        <option value="CH" {{ $trabajador->expedido == 'CH' ? 'selected' : '' }}>Chuquisaca</option>
                        <option value="LP" {{ $trabajador->expedido == 'LP' ? 'selected' : '' }}>La Paz</option>
                        <option value="CB" {{ $trabajador->expedido == 'CB' ? 'selected' : '' }}>Cochabamba</option>
                        <option value="OR" {{ $trabajador->expedido == 'OR' ? 'selected' : '' }}>Oruro</option>
                        <option value="PT" {{ $trabajador->expedido == 'PT' ? 'selected' : '' }}>Potosí</option>
                        <option value="TJ" {{ $trabajador->expedido == 'TJ' ? 'selected' : '' }}>Tarija</option>
                        <option value="SC" {{ $trabajador->expedido == 'SC' ? 'selected' : '' }}>Santa Cruz</option>
                        <option value="BE" {{ $trabajador->expedido == 'BE' ? 'selected' : '' }}>Beni</option>
                        <option value="PD" {{ $trabajador->expedido == 'PD' ? 'selected' : '' }}>Pando</option>
                    </x-dg-select>
                    <x-dg-input type="text" name="nro_asegurado" id="nro_asegurado" disabled
                        value="{{ $trabajador->nro_asegurado }}" label="Nro. Asegurado" topclass="col-md-3" />
                    <x-dg-input type="text" disabled name="direccion" id="direccion" label="Direccion"
                        topclass="col-md-8" value="{{ $trabajador->direccion }}" />
                    <x-dg-input type="text" disabled label="Sexo" topclass="col-md-4"
                        value="{{ Funciones::genero($trabajador->sexo) }}" />

                    <x-dg-input type="text" label="Nacionalidad" topclass="col-md-8" disabled
                        value="{{ $trabajador->nacionalidad }}" />
                    {{-- Fecha de nacmiento --}}
                    <x-dg-input type="text" label="Fecha de Nacimiento" topclass="col-md-4" disabled
                        value="{{ $trabajador->fecha_nacimiento->format('d-m-Y') }}" />
                </div>
            </div>
            <div class="tab-pane fade" id="info_laboral" role="tabpanel">
                <div class="row">
                    <x-input type="number" name="antiguedad_anios" id="antiguedad_anios" disabled
                        label="AÑOS DE ANTIGUEDAD" topclass="col-md-4"
                        value="{{ $trabajador->antiguedad_anios }}" />
                    <x-input type="number" name="antiguedad_meses" id="antiguedad_meses" label="MESES DE ANTIGUEDAD"
                        topclass="col-md-4" value="{{ $trabajador->antiguedad_meses }}" disabled />
                    <x-input type="number" name="antiguedad_dias" id="antiguedad_dias" label="DIAS DE ANTIGUEDAD"
                        topclass="col-md-4" value="{{ $trabajador->antiguedad_dias }}" disabled />
                    <x-input type="text" label="Estado civil" topclass="col-md-6" disabled
                        value="{{ Funciones::estadoCivil($trabajador->sexo,$trabajador->estado_civil) }}"
                        inputclass="form-control-sm" />
                    <x-input-icon type="text" name="estado" id="estado" label="ESTADO" topclass="col-md-6"
                        icon="fas fa-check" disabled value="{{ $trabajador->estado_trabajador }}"
                        inputclass="form-control-sm" />

                </div>
            </div>
        </div>

    </div>
</div>
