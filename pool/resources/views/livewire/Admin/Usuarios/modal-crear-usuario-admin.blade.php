<x-modal title="Crear usuario nuevo" id="modalCrearUsuario" type="store">
    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">
            @error('rol_usuario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <label class="input-group-text text-success" for="rolUsuario">Rol:</label>
                <select class="form-select" id="rolUsuario" wire:model.live="rol_usuario">
                    <option value="0">Seleccionar...</option>
                    <option value="admin">Admin</option>
                    <option value="mesera">Mesera</option>
                    <option value="cajero">Cajero</option>
                </select>
            </div>

            @error('nombres_usuario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="nombresUsuario">Nombres:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="nombresUsuario"
                    wire:model.blur="nombres_usuario">
            </div>


            @error('email_usuario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="correoUsuario">Correo:</span>
                <input type="email" class="form-control" id="correoUsuario" aria-describedby="correoUsuario"
                    wire:model.blur="email_usuario">
            </div>

            @error('telefono_usuario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="telefonoUsuario">Telefono:</span>
                <input type="text" class="form-control" id="telefonoUsuario" aria-describedby="telefonoUsuario"
                    wire:model.blur="telefono_usuario">
            </div>

            @error('documento_usuario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="documentoUsuario">Documento:</span>
                <input type="text" class="form-control" id="documentoUsuario" aria-describedby="documentoUsuario"
                    wire:model.blur="documento_usuario">
            </div>

            @error('contrasena_usuario')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="contrasenaUsuario">Contraseña:</span>
                <input type="password" class="form-control" id="contrasenaUsuario" aria-describedby="contrasenaUsuario"
                    wire:model.blur="contrasena_usuario">
            </div>
        </div>
    </div>
</x-modal>
