@csrf
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $event->title ?? '') }}">
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $event->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Location</label>
    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
           value="{{ old('location', $event->location ?? '') }}">
    @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Start</label>
        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
               value="{{ old('start_date', isset($event) ? $event->start_date->format('Y-m-d\TH:i') : '') }}">
        @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">End</label>
        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
               value="{{ old('end_date', isset($event) ? $event->end_date->format('Y-m-d\TH:i') : '') }}">
        @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Capacity</label>
    <input type="number" name="capacity" min="1" class="form-control @error('capacity') is-invalid @enderror"
           value="{{ old('capacity', $event->capacity ?? '') }}">
    @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="form-check mb-3">
    <input type="checkbox" name="is_published" value="1" class="form-check-input" id="is_published"
           {{ old('is_published', $event->is_published ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_published">Published</label>
</div>