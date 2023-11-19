@extends('admin.admin-panel.blank')

@section('content')

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif


    <h4>View Employee List</h4>
    <hr>

    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Status</th>
            <th>Employee Token ID</th>
            <th>Device ID</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>

        <?php $id = 0; ?>
        @foreach($employee as $em)
            <tr>
                <td>{{ $id += 1 }}</td>
                <td>{{ $em->name }}</td>
                <td>{{ $em->designation }}</td>
                <td>{{ $em->status }}</td>
                <td>{{ $em->employee_token_id }}</td>
                <td>{{ \App\Models\Device::find($em->device_id)->device_token ?? "No Device Found" }}</td>
                <td>
                    <a href="{{ route('employee.edit', $em->id) }}" class="btn btn-primary">Update</a>
                </td>

                @if($device = \App\Models\Device::find($em->device_id))
                    <td>
                        @if($device->device_status == "mode0")

                            <form action="{{ route('employee.destroy',$em->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        @else
                            <p>Attendance Mode On</p>
                        @endif
                    </td>

                @else
                    <td>
                        <p style="color: red">Device Info Missing</p>
                    </td>
                @endif


            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
