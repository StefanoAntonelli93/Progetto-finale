<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Conferma Eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare questo piatto?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button id="delete" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
