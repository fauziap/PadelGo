@php
    $profileImage = auth()->user()->profile_image_url;
    $isCourtImage = Str::substr($profileImage, 0, 11) === 'user_photos';
    $imageSrc = $isCourtImage ? '/storage/' . $profileImage : asset($profileImage);
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Padel Court Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('styles/dashboard.css') }}">
</head>

<body class="d-flex">
    <!-- Sidebar -->
    <x-dashboard-sidebar :profileUrl="$imageSrc"></x-dashboard-sidebar>

    @if (session('update-profile'))
        <script>
            alert("{{ session('update-profile') }}");
        </script>
    @endif

    <!-- Main Content -->
    <div class="flex-grow-1 overflow-auto main">
        <!-- Header -->
        <x-dashboard-header :profileUrl="$imageSrc" />

        <!-- Dashboard Content -->
        <main class="p-3">
            {{ $slot }}
        </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="profileSetting" tabindex="-1" aria-labelledby="profileSettingLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/update/profile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="d-flex justify-content-center">
                            <label for="profileImage" class="profile-upload-wrapper">
                                <img id="preview-image" src="{{ $imageSrc }}" alt="Profile Picture" width="120"
                                    height="120">
                                <div class="edit-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                            </label>

                            <input type="file" id="profileImage" class="profile-upload-input" accept="image/*"
                                name="image">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ auth()->user()->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ auth()->user()->first_name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ auth()->user()->last_name }}" required>
                        </div>

                        <input type="hidden" name="profile_image_url" value="{{ auth()->user()->profile_image_url }}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.querySelector('.sidebar')
        const menu = document.querySelector('.humberger')
        const menu2 = document.querySelector('.humberger-2')

        menu.addEventListener('click', () => sidebar.classList.toggle('active'))
        menu2.addEventListener('click', () => sidebar.classList.toggle('active'))

        const input = document.getElementById('profileImage');
        const preview = document.getElementById('preview-image');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

</body>

</html>
