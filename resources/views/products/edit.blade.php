<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script>
        function validateForm(event) {
            event.preventDefault();

            // Clear existing error messages
            document.querySelectorAll('.error-message').forEach(error => error.textContent = '');

            let isValid = true;

            // Name validation
            const name = document.getElementById('name').value.trim();
            if (!name) {
                document.getElementById('nameError').textContent = "Name is required.";
                isValid = false;
            }

            // Description validation
            const description = document.getElementById('description').value.trim();
            if (!description) {
                document.getElementById('descriptionError').textContent = "Description is required.";
                isValid = false;
            }

            // Image validation (Optional for Edit)
            const image = document.getElementById('image').value.trim();
            if (!image && !document.getElementById('imagePreview').src) {
                document.getElementById('imageError').textContent = "Image is required.";
                isValid = false;
            }

            // Status validation
            const status = document.getElementById('status').value;
            if (!status) {
                document.getElementById('statusError').textContent = "Status is required.";
                isValid = false;
            }

            // Submit the form if valid
            if (isValid) {
                document.getElementById('editForm').submit();
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark text-white">Show Page</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card header bg-dark">
                        <h3 class="text-white ms-3">Edit Product</h3>
                    </div>
                    <form id="editForm" method="POST" action="{{route('products.update',$product->id)}}"
                        enctype="multipart/form-data" onsubmit="validateForm(event)">
                        @csrf
                        <!---put method is use for update purpose-->
                        @method('PUT')

                        <div class="card-body">
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Name</label>
                                <input type="text" value="{{ old('name', $product->name) }}" id="name" name="name"
                                    class="form-control form-control-lg" placeholder="Enter name">
                                <div id="nameError" class="text-danger error-message">{{ $errors->first('name') }}</div>
                            </div>
                            <!-- Description Field -->
                            <div class="mb-3">
                                <label for="description" class="form-label h5">Description</label>
                                <textarea id="description" name="description" class="form-control form-control-lg"
                                    placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
                                <div id="descriptionError" class="text-danger error-message">
                                    {{ $errors->first('description') }}</div>
                            </div>
                            <!-- Image Field -->
                            <div class="mb-3">
                                <label for="image" class="form-label h5">Image</label>
                                <input type="file" id="image" name="image" class="form-control form-control-lg">
                                <img  src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-25 my-3" >
                                <div id="imageError" class="text-danger error-message">{{ $errors->first('image') }}
                                </div>
                            </div>
                            <!-- Status Field -->
                            <div class="mb-3">
                                <label for="status" class="form-label h5">Status</label>
                                <select id="status" name="status" class="form-select form-select-lg">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                <div id="statusError" class="text-danger error-message">{{ $errors->first('status') }}
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
