<x-dashboard-layout>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    <i class="fas fa-table-tennis-paddle-ball me-2"></i>Manage Padel Courts
                </h2>
                <p class="text-muted">Admin dashboard to manage Padel courts</p>
            </div>

            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a class="btn btn-primary-custom" href="/dashboard/courts/create">
                    <i class="fas fa-plus me-2"></i>Add Court
                </a>
            </div>
        </div>

        @if (session('add-court'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('add-court') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('delete-court'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('delete-court') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('update-court'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('update-court') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <style>
            .court-img {
                width: 85px;
                height: 65px;
                object-fit: cover;
                border-radius: 10px;
                border: 1px solid #ddd;
                background-color: #f8f9fa;
            }

            .court-no-img {
                width: 85px;
                height: 65px;
                border-radius: 10px;
                border: 1px solid #ddd;
                background-color: #f1f1f1;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #999;
                font-size: 12px;
            }

            .action-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 34px;
                height: 34px;
                border-radius: 8px;
                margin-right: 5px;
                text-decoration: none;
                background: transparent;
            }

            .action-btn.edit {
                color: #0d6efd;
            }

            .action-btn.delete {
                color: #dc3545;
            }

            .action-btn:hover {
                background-color: #f1f1f1;
            }
        </style>

        <div class="card card-custom mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Photo</th>
                                <th>Court Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($courts as $court)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if ($court->image_url)
                                            @php
                                                $image = $court->image_url;

                                                if (filter_var($image, FILTER_VALIDATE_URL)) {
                                                    $imageSrc = $image;
                                                } elseif (str_starts_with($image, '/storage/')) {
                                                    $imageSrc = $image;
                                                } elseif (str_starts_with($image, 'storage/')) {
                                                    $imageSrc = asset($image);
                                                } else {
                                                    $imageSrc = asset('storage/' . $image);
                                                }
                                            @endphp

                                            <img src="{{ $imageSrc }}"
                                                alt="{{ $court->name }}"
                                                class="court-img"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                            <div class="court-no-img" style="display: none;">
                                                No Image
                                            </div>
                                        @else
                                            <div class="court-no-img">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="fw-medium">{{ $court->name }}</span>
                                    </td>

                                    <td>
                                        Rp {{ number_format($court->price, 0, ',', '.') }} / 3 hours
                                    </td>

                                    <td>
                                        <a class="action-btn edit"
                                            title="Edit"
                                            href="/dashboard/courts/{{ $court->id }}/edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="/dashboard/courts/{{ $court->id }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="action-btn delete border-0"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data court.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
