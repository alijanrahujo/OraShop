<div>
    <div class="form-group">
        <input
            type="date"
            id="date"
            name="date"
            wire:model.lazy="date"
            class="form-control @error('date') is-invalid @enderror"
        >
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('date-changed', event => {
           location.reload();
        });
    });
</script>
