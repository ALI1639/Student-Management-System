@extends('layout')

@section('title', 'Notifications')

@section('content')

    <div class="container-fluid">

        <div class="row mb-3">

            <div class="col-md-6">

                {{-- <h3>

                    <i class="fas fa-bell text-warning"></i>

                    Notifications

                </h3> --}}
                <form action="{{ route('destroyall') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete all records?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete All</button>
                </form>

            </div>

            <div class="col-md-6 text-end">

                <form action="{{ route('notifications.readAll') }}" method="POST" class="d-inline">

                    @csrf

                    <button class="btn btn-success">

                        <i class="fas fa-check-double"></i>

                        Mark All Read

                    </button>

                </form>

            </div>

        </div>



        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif



        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0 ">
                    <i class="fas fa-bell text-warning"></i>
                    Notification List

                </h5>

            </div>



            <div class="card-body p-0">

                <table class="table table-hover table-bordered mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">#</th>

                            <th>Title</th>

                            <th>Message</th>

                            <th width="120">Status</th>

                            <th width="180">Created</th>

                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($notifications as $notification)
                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>

                                <td>

                                    <i class="fas {{ $notification->icon }} text-{{ $notification->color }}"></i>

                                    {{ $notification->title }}

                                </td>

                                <td>

                                    {{ $notification->message }}

                                </td>

                                <td>

                                    @if ($notification->is_read)
                                        <span class="badge bg-success">

                                            Read

                                        </span>
                                    @else
                                        <span class="badge bg-danger">

                                            Unread

                                        </span>
                                    @endif

                                </td>

                                <td>

                                    {{ $notification->created_at->format('d M Y h:i A') }}

                                </td>

                                <td>

                                    @if (!$notification->is_read)
                                        <a href="{{ route('notifications.read', $notification->id) }}"
                                            class="btn btn-sm btn-primary">

                                            <i class="fas fa-eye">view</i>

                                        </a>
                                    @endif



                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this notification?')">
                                            <i class="fas fa-trash"></i>Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-4">

                                    <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>

                                    <br>

                                    No Notifications Found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>



            <div class="card-footer">

                {{ $notifications->links('pagination::bootstrap-5') }}

            </div>

        </div>

    </div>

@endsection
