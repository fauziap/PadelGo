<x-dashboard-layout>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    Create new court
                </h2>
            </div>
        </div>

        <form action="/dashboard/courts" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name"
                    class="form-label @error('name')
                    is-invalid
                @enderror">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price"
                    class="form-label @error('price')
                    is-invalid
                @enderror">Price</label>
                <input type="number" class="form-control" id="price" min="0" name="price"
                    value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="formFile"
                    class="form-label @error('image')
                    is-invalid
                @enderror">Image</label>

                <!-- Preview container -->
                <img id="imagePreview" style="max-width: 300px;display:none;" class="mb-3">

                <input class="form-control" type="file" id="formFile" name="image" accept="image/*"
                    onchange="previewImage(event)">
                @error('image')
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


<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
