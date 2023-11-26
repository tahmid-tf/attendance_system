@extends('admin.admin-panel.blank')

@section('content')

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif


    <div class="d-flex flex-wrap justify-content-between">
        <div>
            <h4>View Attendance List</h4>
        </div>
        <div>
            <a href="{{ route('attendance-report') }}" class="btn btn-primary">Attendance Report Export</a>
        </div>
    </div>

    <hr>

    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Arrival Time</th>
            <th>Leave Time</th>
            <th>Employee ID</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>

        <?php $id = 0; ?>
        @foreach($attendance as $em)
            <tr>
                <td>{{ $id += 1 }}</td>
                <td>{{ $em->employee_name }}</td>
                <td>{{ $em->arrival_time }}</td>
                <td>{{ $em->leave_time }}</td>
                <td>{{ $em->employee_token_id }}</td>
                <td>{{ $em->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
