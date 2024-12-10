<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
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
            // Image validation
            const image = document.getElementById('image').value.trim();
            if (!image) {
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
                document.getElementById('createForm').submit();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark text-white">Show Products.</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card header bg-dark">
                        <h3 class="text-white ms-3"> Add New Product</h3>
                    </div>
                    <form id="createForm" method="POST" action="{{ route('products.store') }}"
                        enctype="multipart/form-data" onsubmit="validateForm(event)">
                        @csrf
                        <div class="card-body">
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Name</label>
                                <input type="text" value="{{ old('name') }} " id="name" name="name"
                                    class="form-control form-control-lg" placeholder="Enter name">
                                <div id="nameError" class="text-danger error-message">{{ $errors->first('name') }}</div>
                            </div>
                            <!-- Description Field -->
                            <div class="mb-3">
                                <label for="description" class="form-label h5">Description</label>
                                <textarea id="description" name="description" class="form-control form-control-lg" placeholder="Enter description">{{ old('description') }}</textarea>
                                <div id="descriptionError" class="text-danger error-message">
                                    {{ $errors->first('description') }}</div>
                            </div>
                            <!-- Image Field -->
                            <div class="mb-3">
                                <label for="image" class="form-label h5">Image</label>
                                <input type="file" id="image" name="image"
                                    class="form-control form-control-lg">
                                <div id="imageError" class="text-danger error-message">{{ $errors->first('image') }}
                                </div>
                            </div>
                            <!-- Status Field -->
                            <div class="mb-3">
                                <label for="status" class="form-label h5">Status</label>
                                <select id="status" name="status" class="form-select form-select-lg">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                <div id="statusError" class="text-danger error-message">{{ $errors->first('status') }}
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
