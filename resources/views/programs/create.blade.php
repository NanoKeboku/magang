<form action="{{ route('programs.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Bidang Keahlian</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="company">Perusahaan</label>
        <input type="text" name="company" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="field">Field</label>
        <input type="text" name="field" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="compensation">Kompensasi</label>
        <input type="number" name="compensation" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="location">Lokasi</label>
        <input type="text" name="location" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="duration">Durasi</label>
        <input type="number" name="duration" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="career_opportunities">Peluang Karier</label>
        <input type="text" name="career_opportunities" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
