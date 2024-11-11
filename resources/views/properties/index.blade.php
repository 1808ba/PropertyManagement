<!-- resources/views/properties/index.blade.php -->
@extends('layouts.app')

@section('body')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Properties</h1>
        <a href="{{ route('properties.create') }}" class="btn btn-primary">Add Property</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Address</th>
                <th>Type</th>
                <th>Number of Units</th>
                <th>Rental Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($properties->count() > 0)
                @foreach($properties as $property)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">
                            @if($property->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="Property Image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            @else
                                <p>No image</p>
                            @endif
                        </td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->address }}</td>
                        <td>{{ $property->type }}</td>
                        <td>{{ $property->number_of_units }}</td>
                        <td>{{ $property->rental_cost }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('properties.show', $property->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('properties.edit', $property->id) }}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="8">No properties found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
