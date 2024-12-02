@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <h4>Edit File Details</h4>
    </div>
    <div class="card-body">
        <!-- Display file information -->
        <div class="mb-4">
            <h5>File Information</h5>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Original File Name:</strong> {{ $file->original_name }}
                </li>
                <li class="list-group-item">
                    <strong>Storage Path (S3):</strong> {{ $file->s3_path }}
                </li>
                <li class="list-group-item">
                    <strong>Public URL:</strong> 
                    <a href="{{ $file->url }}" target="_blank">{{ $file->url }}</a>
                </li>
                <li class="list-group-item">
                    <strong>Uploaded On:</strong> {{ $file->created_at->format('d M Y, H:i:s') }}
                </li>
                <li class="list-group-item">
                    <strong>Last Updated:</strong> {{ $file->updated_at->format('d M Y, H:i:s') }}
                </li>
            </ul>
        </div>

        <!-- Form to update the file -->
        <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="file" class="form-label">Replace File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update File</button>
        </form>
    </div>
</div>
@endsection
