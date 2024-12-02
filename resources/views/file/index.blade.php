@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-dark text-white">
        <h4>All Files</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $index => $file)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $file->original_name }}</td>
                    <td><a href="{{ $file->url }}" target="_blank" class="btn btn-link">View</a></td>
                    <td>
                        <a href="{{ route('files.edit', $file->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
