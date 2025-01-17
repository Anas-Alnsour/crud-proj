<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      background: #f0f4f8;
      font-family: 'Poppins', sans-serif;
      color: #333;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .header-bg {
      background: linear-gradient(135deg, #6a8dd5, #2e3d8a);
      padding: 120px 0;
      color: white;
      text-align: center;
      border-radius: 0 0 50% 50%;
      box-shadow: 0px 12px 40px rgba(0, 0, 0, 0.15);
      animation: slideIn 2s ease-out;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .img-preview {
  max-width: 100%;
  height: auto;
  object-fit: cover; 
  border-radius: 10px;
  margin-top: 10px;
}

    .header-bg h1 {
      font-size: 4.5rem;
      font-weight: 700;
      letter-spacing: 2px;
      margin-bottom: 20px;
    }

    .header-bg p {
      font-size: 1.6rem;
      font-weight: 300;
      margin-bottom: 30px;
    }

    .btn-custom {
      background-color: #1d3b8f;
      color: #fff;
      font-weight: 600;
      padding: 14px 40px;
      border-radius: 50px;
      transition: 0.3s;
      display: inline-block;
      margin: 15px 5px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-custom:hover {
      background-color: #0f2854;
      cursor: pointer;
      transform: scale(1.05);
      box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-back {
      background-color: transparent;
      color: #1d3b8f;
      border: 2px solid #1d3b8f;
      border-radius: 50px;
      padding: 12px 35px;
      font-weight: 600;
      transition: 0.3s;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-back:hover {
      background-color: #1d3b8f;
      color: white;
      transform: scale(1.05);
      box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.2);
    }

    .card {
      border-radius: 20px;
      box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.1);
      margin-top: -40px;
      background: #fff;
      overflow: hidden;
      transition: 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
    }

    .card-header {
      background: #2e3d8a;
      color: white;
      font-weight: 700;
      font-size: 1.8rem;
      border-radius: 20px 20px 0 0;
      padding: 30px;
      text-transform: uppercase;
      text-align: center;
    }

    label {
      font-size: 1.3rem;
      font-weight: 500;
      color: #555;
    }

    input, textarea {
      border-radius: 12px;
      border: 1px solid #ddd;
      padding: 14px;
      font-size: 1.1rem;
      margin-bottom: 25px;
      width: 100%;
      box-sizing: border-box;
      background: #f4f7fc;
      transition: 0.3s ease;
    }

    input:focus, textarea:focus {
      border-color: #2e3d8a;
      outline: none;
      box-shadow: 0 0 8px rgba(46, 61, 138, 0.2);
    }

    .form-container {
      padding: 50px 70px;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.1);
    }

    .form-container .card-body {
      background-color: #f9f9f9;
      border-radius: 12px;
    }

    .mb-3 {
      margin-bottom: 30px;
    }

    .d-grid button:active {
      transform: scale(0.98);
    }

    .invalid-feedback {
      font-size: 0.95rem;
      color: #e74c3c;
      font-weight: 600;
    }

    .container {
      max-width: 1150px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .form-container .card-header h3 {
      font-size: 2rem;
      color: white;
      text-transform: uppercase;
      text-align: center;
    }

    .row {
      margin-top: 60px;
    }

    .header-bg .text-muted {
      font-size: 1.3rem;
      font-weight: 300;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="header-bg">
    <h1>Edit Product</h1>
    <p>Update your product details here</p>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3>Edit Product</h3>
          </div>
          <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post">
            @method('put')
            @csrf
            <div class="card-body">
              <div class="form-container">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input value="{{ old('name', $product->name) }}" type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="sku" class="form-label">Sku</label>
                  <input value="{{ old('sku', $product->sku) }}" type="text" id="sku" class="form-control @error('sku') is-invalid @enderror" name="sku">
                  @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input value="{{ old('price', $product->price) }}" type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price">
                  @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea id="description" class="form-control" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mb-3">
                  <label for="image img-preview" class="form-label"  >Image</label>
                  <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                @if ($product->image != "")
                  <div class="mb-3">
                    <label for="current-image" class="form-label">Current Image</label>
                    <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-preview" alt="Current Image">
                  </div>
                @endif

                <div class="d-grid">
                  <button type="submit" class="btn btn-custom">Update Product</button>
                  <a href="{{ route('products.index') }}" class="btn btn-back">Back to Products</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>