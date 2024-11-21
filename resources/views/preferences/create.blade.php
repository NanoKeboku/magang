<form action="{{ route('preferences.store') }}" method="POST">    
@csrf
<!-- Menampilkan pesan sukses -->
@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan pesan kesalahan validasi -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="field_weight">Field Weight</label>
        <input type="number" name="field_weight" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="compensation_weight">Compensation Weight</label>
        <input type="number" name="compensation_weight" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="location_weight">Location Weight</label>
        <input type="number" name="location_weight" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="duration_weight">Duration Weight</label>
        <input type="number" name="duration_weight" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="career_opportunities_weight">Career Opportunities Weight</label>
        <input type="number" name="career_opportunities_weight" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
