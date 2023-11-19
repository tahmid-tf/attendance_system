@extends('admin.admin-panel.blank')

@section('content')

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif


    <h4>View Attendance List</h4>
    <hr>

    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Arrival Time</th>
            <th>Leave Time</th>
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
                <td>{{ $em->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
