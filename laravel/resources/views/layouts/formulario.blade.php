<h4>Registro de Computadores</h4>
<form id="formEquipo" class="was-validated" autocomplete="off" novalidate>
    <div class="row">

        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_nombre_equipo]"
                placeholder="Nombre del equipo" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_board]" placeholder="Board" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_case]" placeholder="Case" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_procesador]"
                placeholder="Procesador" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_grafica]" placeholder="Grafica" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_ram]" placeholder="RAM" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_disco_duro]"
                placeholder="Disco Duro" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_teclado]" placeholder="Teclado" required>
        </div>
        <div class="col-md-4 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_mouse]" placeholder="Mouse" required>
        </div>
        <div class="col-md-6 mt-1">
            <input type="text" class="form-control" name="gce_caracteristicas[gce_pantalla]" placeholder="Pantalla" required>
        </div>
        <div class="col-md-6 mt-1">
            {{-- <input type="text"  placeholder="Estado"> --}}
            <select class="form-control" name="gce_caracteristicas[gce_estado]" id="" required>
                <option value="">-- Seleccione un Estado --</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <input type="hidden" name="gce_caracteristicas[gce_id]" value="">
        </div>

        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-primary btn-block" id="btnGuardar">Agregar</button>
        </div>
    </div>
</form>
