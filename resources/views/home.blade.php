@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('upload.image') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="col-10">
                            <input type="file" class="form-control" name="image" accept="image/png, image/gif, image/jpeg" />
                        </div>
                        <div class="col-2 text-end">
                            <button type="submit" class="btn btn-primary px-4">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @forelse ($images as $key => $image)
                        <div class="card border-0 mb-1">
                            <div class="card-body justify-content-between d-flex align-items-center">
                                <img class="img-thumbnail" style="max-height: 80px;" src="{{ Storage::url($image->image) }}" alt="">
                                <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-image{{ $key }}').submit();">Delete</button>
                                <form id="delete-image{{ $key }}" action="{{ route('delete.image', $image->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted mb-0">No Images Found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
