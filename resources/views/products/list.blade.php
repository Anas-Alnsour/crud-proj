<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anas Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .header {
            background: linear-gradient(135deg, #6a8dd5, #2e3d8a);
            padding: 70px 0;
            color: white;
            text-align: center;
            border-radius: 0 0 50% 50%;
            box-shadow: 0px 12px 40px rgba(0, 0, 0, 0.15);
        }

        .header h3 {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .container {
            margin-top: -50px;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            background: #fff;
        }

        .card-header {
            background: #2e3d8a;
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            border-radius: 16px 16px 0 0;
            padding: 20px;
        }

        .card-body {
            background-color: #f9f9f9;
            padding: 30px;
        }

        .btn-dark {
            background-color: #2e3d8a;
            color: white;
            border-radius: 50px;
            padding: 12px 30px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .btn-dark:hover {
            background-color: #1d2850;
            cursor: pointer;
            transform: scale(1.05);
            box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.2);
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .table th:nth-child(7), .table td:nth-child(7) {
    height: auto;
    width: auto;
}

        .alert {
            margin-top: 20px;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-align: center;
        }

        .action-btns {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            
        }

        .action-btns .btn {
            padding: 8px 20px;
            font-size: 1rem;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #2e3d8a;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
            border-radius: 20px 20px 0 0;
        }

        @media (max-width: 768px) {
            .header h3 {
                font-size: 2rem;
            }

            .card-header h3 {
                font-size: 1.6rem;
            }

            .btn-dark {
                padding: 10px 25px;
            }

            .footer {
                font-size: 0.9rem;
            }
            
            ..img-thumbnail {
                  width: 100px;  
                  height: auto;
                 border-radius: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h3>Anas Shop</h3>
        <p>Your one-stop solution for managing products effortlessly</p>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create New Product</a>
            </div>
        </div>

        <div class="row justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10">
                <div class="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
            @endif

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3>Products List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if ($product->image != "")
                                        <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-thumbnail"
                                            alt="Product Image">
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                    <td class="action-btns">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                        <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>
                                        <form id="delete-product-from-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Anas CRUD. All Rights Reserved.</p>
    </div>

    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById("delete-product-from-" + id).submit();
            }
        }
    </script>
</body>

</html>
