@extends('layouts.app')

@section('body')
    <h1 class="mb-0">Property Details</h1>
    <hr />

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $property->name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ $property->address }}" readonly>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="{{ $property->type }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Number of Units</label>
            <input type="text" class="form-control" value="{{ $property->number_of_units }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Rental Cost</label>
            <input type="text" class="form-control" value="{{ $property->rental_cost }}" readonly>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" value="{{ $property->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" value="{{ $property->updated_at }}" readonly>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <h3>Property Images</h3>
            <div class="d-flex flex-wrap">
                @forelse($property->images as $image)
                    <div class="m-2">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Property Image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px;">
                    </div>
                @empty
                    <p>No images available for this property.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
