<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Nueva sentencia</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="nombre"></label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="archivos_id"></label>
                        <input wire:model="archivos_id" type="text" class="form-control" id="archivos_id" placeholder="Archivos Id">@error('archivos_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="users_id"></label>
                        <input wire:model="users_id" type="text" class="form-control" id="users_id" placeholder="Users Id">@error('users_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Sentencia</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="nombre"></label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="archivos_id"></label>
                        <input wire:model="archivos_id" type="text" class="form-control" id="archivos_id" placeholder="Archivos Id">@error('archivos_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="users_id"></label>
                        <input wire:model="users_id" type="text" class="form-control" id="users_id" placeholder="Users Id">@error('users_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>
<!-- Modal attach-->
<div wire:ignore.self class="modal fade" id="attachModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Adjuntar archivo</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<div class="table-responsive mb-4">
                        <form wire:submit.prevent="save" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="selected_id" id="selected_id">
                            <div class="form-group">
                                <label>Archivos</label> 
                                <input type="file" wire:model="archivo" class="form-control mb -2" accept = "application/pdf">
                                @error('archivo') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group mt-4" align="right">
                                <button type="submit" class="btn btn-danger">Adjuntar</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>