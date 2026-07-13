<x-dashboard-layout>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    <i class="fa-solid fa-calendar-xmark me-2"></i>Court Schedules
                </h2>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a class="btn btn-primary-custom" href="/dashboard/schedules/create">
                    <i class="fas fa-plus me-2"></i>Add Schedules
                </a>
            </div>
        </div>

        @if (session('add-schedule'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('add-schedule') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('update-schedule'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('update-schedule') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('delete-schedule'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('delete-schedule') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $schedule->start_time }}
                                    </td>
                                    <td>{{ $schedule->end_time }}</td>
                                    <td>
                                        <a class="action-btn edit" href="/dashboard/schedules/{{ $schedule->id }}/edit"
                                            title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="/dashboard/schedules/{{ $schedule->id }}" method="post" onsubmit="return confirm('yakin?')"
                                            class="action-btn delete border-0">
                                            @csrf
                                            @method('DELETE')

                                            <button class="action-btn delete border-0" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-dashboard-layout>
