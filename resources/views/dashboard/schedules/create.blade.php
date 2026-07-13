<x-dashboard-layout>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    Create new schedule
                </h2>
            </div>
        </div>

        <form action="/dashboard/schedules" method="post">
            @csrf
            <div class="mb-3">
                <label for="start_time" class="form-label @error('start_time') is-invalid @enderror">Start Time <span
                        class="text-danger">*</span></label>
                <input type="time" class="form-control" id="start_time" name="start_time"
                    value="{{ old('start_time') }}" required>
                @error('start_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label @error('end_time') is-invalid @enderror">End Time <span
                        class="text-danger">*</span></label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}"
                    required>
                @error('end_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-dashboard-layout>
