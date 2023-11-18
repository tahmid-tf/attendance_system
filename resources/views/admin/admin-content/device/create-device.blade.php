@extends('admin.admin-panel.blank')

@section('content')

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif


    <h4>Add Devices</h4>
    <hr>


    <form action="{{ route('device.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1">Enter Device Token</label>
            <input type="text" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="" name="device_token"
                   class="form-control @error('device_token') is-invalid @enderror">
        </div>


        @error('device_token')
        <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
        @enderror


        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

    <br>

    <h4>View All Devices</h4>
    <hr>


    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Device Token</th>
            <th>Device Status</th>
            <th>Status Change</th>
        </tr>
        </thead>
        <tbody>

            <?php $id = 0; ?>
        @foreach($devices as $device)
            <tr>
                <td>{{ $id += 1 }}</td>
                <td>{{ $device->device_token }}</td>
                <td>{{ $device->device_status }}</td>
                <td>
                    <a href="{{ route('device.edit', $device->id) }}" class="btn btn-primary">Change Status</a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
