<section>
    <header class="mb-4">
        <h5>{{ __('Eliminar Cuenta') }}</h5>
        <p class="text-muted small">{{ __('Una vez eliminada tu cuenta, todos sus recursos y datos serán eliminados permanentemente.') }}</p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="bi bi-trash me-1"></i>{{ __('Eliminar Cuenta') }}
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" @if($errors->userDeletion->isNotEmpty()) show @endif>
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('¿Estás seguro de eliminar tu cuenta?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small">{{ __('Una vez eliminada tu cuenta, todos sus recursos y datos serán eliminados permanentemente. Ingresa tu contraseña para confirmar.') }}</p>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" name="password" type="password"
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                   placeholder="{{ __('Contraseña') }}">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Eliminar Cuenta') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
