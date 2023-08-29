<!doctype html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point Of Sale App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    
</head>
<body>
    
        <header class="p-2 navbar navbar-light sticky-top bg-secondary flex-md-nowrap">
            <a class="px-3 my-2 navbar-brand col-md-3 col-lg-2 me-0 fw-bold ms-3 text-light" href="#">Point Of Sale App</a>
        </header>

        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="container-fluid" >
            <div class="row">
                <div class="col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky">

                        <div class="mx-auto mt-3 mb-3 card bg-light text-dark" style="width: auto;">
                            <div class="card-body">
                                <h5 class="py-3 card-title text-center border-bottom fs-4 ">Dashboard</h5>
                                
                                <div class="mb-3 menu text-end me-3">
                                    <a href="/PosItem" class="py-3 text-capitalize fs-5 text-decoration-none text-dark text-end">item</a>
                                </div>
                                
                                <div class="menu text-end me-3">
                                    <a href="/PosSelling" class="py-3 text-capitalize fs-5 text-decoration-none text-dark text-end">selling</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <main class="ms-sm-auto bg-light text-dark col-lg-10 px-md-4 " style="height: auto">
                    <div class="mx-auto mt-3 mb-3 card bg-light text-dark">
                        <div class="card-body">
                            
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AddItem"> Add Item</button>

                            <div class="modal fade" id="AddItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="deletePreview()"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="/PosItem" method="post">
                                                @csrf

                                                <div class="my-2 " >
                                                    <div class="col-12 form-floating ">
                                                        <input type="text" class="form-control bg-light text-dark text-capitalize @error('name_item') is-invalid @enderror" name="name_item" placeholder="Name Item">
                                                        <label for="name_item">Name Item</label>
                                                    </div>
                                                    @error('name_item')
                                                        <div class="text-center invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="my-2 " >
                                                    <div class="col-12 form-floating ">
                                                        <input type="text" class="form-control bg-light text-dark text-capitalize @error('selling_price') is-invalid @enderror" name="selling_price" placeholder="Selling Price">
                                                        <label for="selling_price">Selling Price</label>
                                                    </div>
                                                    @error('selling_price')
                                                        <div class="text-center invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="my-2 " >
                                                    <div class="col-12 form-floating ">
                                                        <input type="text" class="form-control bg-light text-dark text-capitalize @error('purchase_price') is-invalid @enderror" name="purchase_price" placeholder="Purchase Price">
                                                        <label for="purchase_price">Purchase Price</label>
                                                    </div>
                                                    @error('purchase_price')
                                                        <div class="text-center invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="my-2 " >
                                                    <div class="col-12 form-floating ">
                                                        <input type="text" class="form-control bg-light text-dark text-capitalize @error('unit') is-invalid @enderror" name="unit" placeholder="Unit">
                                                        <label for="unit">Unit</label>
                                                    </div>
                                                    @error('unit')
                                                        <div class="text-center invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="my-2 " >
                                                    <div class="col-12 ">
                                                        <label for="category" class="form-label ms-2">Category</label>
                                                        <select class="form-select" name="category">
                                                            <option value="new">New</option>
                                                            <option value="second">Second</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 text-center">
                                                    <button type="submit" class="px-5 mt-2 border border-0 btn btn-sm bg-info fw-bold text-light">Add Items</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 table-responsive">
                                <table class="table table-light table-striped text-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">Code Item</th>
                                            <th scope="col">Name Item</th>
                                            <th scope="col">Selling Price</th>
                                            <th scope="col">Purchase Price</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                        <tr>
                                            <td class="text-capitalize">{{ $item->item_code }}</td>
                                            <td class="text-capitalize">{{ $item->name_item }}</td>
                                            <td class="text-capitalize">{{ 'Rp ' . number_format($item->selling_price, 0, ',', '.')}}</td>
                                            <td class="text-capitalize">{{ 'Rp ' . number_format($item->purchase_price, 0, ',', '.') }}</td>
                                            <td class="text-capitalize">{{ $item->unit }}</td>
                                            <td class="text-capitalize">{{ $item->category }}</td>
                                            <td class="text-capitalize">
                                            
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Edititem-{{ $item->id }}">
                                                <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <div class="modal fade" id="Edititem-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="deletePreview()"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="/PosItem{{$item->id}}" method="post">
                                                                    @csrf
                    
                                                                    <div class="my-2 " >
                                                                        <div class="col-12 form-floating ">
                                                                            <input type="text" class="form-control bg-light text-dark text-capitalize @error('name_item') is-invalid @enderror" name="name_item" placeholder="Name Item" value="{{ $item->name_item }}">
                                                                            <label for="name_item">Name Item</label>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="my-2 " >
                                                                        <div class="col-12 form-floating ">
                                                                            <input type="text" class="form-control bg-light text-dark text-capitalize @error('selling_price') is-invalid @enderror" name="selling_price" placeholder="Selling Price" value="{{ $item->selling_price}}">
                                                                            <label for="selling_price">Selling Price</label>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="my-2 " >
                                                                        <div class="col-12 form-floating ">
                                                                            <input type="text" class="form-control bg-light text-dark text-capitalize @error('purchase_price') is-invalid @enderror" name="purchase_price" placeholder="Purchase Price" value="{{ $item->purchase_price }}">
                                                                            <label for="purchase_price">Purchase Price</label>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="my-2 " >
                                                                        <div class="col-12 form-floating ">
                                                                            <input type="text" class="form-control bg-light text-dark text-capitalize @error('unit') is-invalid @enderror" name="unit" placeholder="Unit" value="{{ $item->unit }}">
                                                                            <label for="unit">Unit</label>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="my-2 " >
                                                                        <div class="col-12">
                                                                            <label for="category" class="form-label ms-2">Category</label>
                                                                            <select class="form-select" name="category">
                                                                                <option value="new" {{ $item->category === 'new' ? 'selected' : '' }}>New</option>
                                                                                <option value="second" {{ $item->category === 'second' ? 'selected' : '' }}>Second</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="mb-3 text-center">
                                                                        <button type="submit" class="px-5 mt-2 border border-0 btn btn-sm bg-info fw-bold text-light">Change Items</button>
                                                                    </div>
                    
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <form action ="/PosItem{{$item->id}}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger text-dark" onclick="return confirm('You Sure Delete Item ?')"><i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>

    </body>
</html>