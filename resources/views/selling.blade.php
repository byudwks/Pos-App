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
                                <h5 class="py-3 text-center card-title border-bottom fs-4 ">Dashboard</h5>
                                
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

                    <button type="button" class="my-2 btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AddItem"> New Order</button>

                    <div class="modal fade" id="AddItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="deletePreview()"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="/PosSelling" method="post">
                                        @csrf

                                        <div class="">
                                            <label for="item_id" class="form-label">Name Item</label>
                                            <select class="mb-2 form-select" aria-label="Default select example" name="item_id">
                                                @foreach ($Items as $item )
                                                <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                                                @endforeach
                                            </select>
                                        
                                            <label for="consumer_name" class="form-label" >Consumer Name</label>
                                            <input type="text" class="form-control text-capitalize @error('consumer_name') is-invalid @enderror" name="consumer_name">
                                            <div class="my-2 " >
                                                @error('consumer_name')
                                                    <div class="text-center invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                      
                                            <label for="amount" class="form-label" >Amount</label>
                                            <input type="text" class="form-control text-capitalize @error('amount') is-invalid @enderror" name="amount">
                                            <div class="my-2 " >
                                                @error('amount')
                                                    <div class="text-center invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3 text-center">
                                            <button type="submit" class="px-5 mt-2 border border-0 btn btn-sm bg-info fw-bold text-light">New Order</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    @foreach ($Sellings as $selling )
                    <div class="my-2 card rounded-3 ">
                        <div class="card-body">
                            <h5 class="pb-3 text-center card-title border-bottom">Your Order</h5>
                            <div class="table-respnsive col-md-5">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Faktur Date</th>
                                        <td>: {{ \Carbon\Carbon::parse($selling->faktur_date)->formatLocalized('%d-%m-%Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Number Faktur</th>
                                        <td>: {{ $selling->no_faktur }}/{{ \Carbon\Carbon::parse($selling->faktur_date)->formatLocalized('%d/%m') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <td>: {{ $selling->consumer_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Item Code</th>
                                        <td>: {{ $selling->item_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name Item</th>
                                        <td>: {{ $selling->item->name_item }}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount</th>
                                        <td>: {{ $selling->amount }}</td>
                                    </tr>
                                    <tr>
                                        <th>Unit Price</th>
                                        <td>: {{  'Rp ' . number_format($selling->unit_price, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td>: {{ 'Rp ' . number_format($selling->total_price , 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div>
                                <button type="button" class="btn btn-info text-light" data-bs-toggle="modal" data-bs-target="#EditOrder-{{ $selling->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <div class="modal fade" id= "EditOrder-{{ $selling->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="deletePreview()"></button>
                                            </div>

                                            <div class="modal-body">
                                                <form action="/PosSelling{{ $selling->id }}" method="post">
                                                    @csrf
    
                                                    <div class="">

                                                        <label for="item_id" class="form-label">Name Item</label>
                                                        <select class="mb-2 form-select" aria-label="Default select example" name="item_id" disabled>
                                                            @foreach ($Items as $item )
                                                            <option value="{{ $item->id }}">{{ $item->name_item }}</option>
                                                            @endforeach
                                                        </select>
                                                    
                                                        <label for="consumer_name" class="form-label" >Consumer Name</label>
                                                        <input type="text" class="form-control text-capitalize @error('consumer_name') is-invalid @enderror" name="consumer_name" value="{{ $selling->consumer_name}}">
                                                        
                                                  
                                                        <label for="amount" class="form-label" >Amount</label>
                                                        <input type="text" class="form-control text-capitalize @error('amount') is-invalid @enderror" name="amount" value="{{ $selling->amount}}">
                                                    
                                                    </div>
    
                                                    <div class="mb-3 text-center">
                                                        <button type="submit" class="px-5 mt-2 border border-0 btn btn-sm bg-info fw-bold text-light">Change Order</button>
                                                    </div>
    
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <form action ="/PosSelling{{$selling->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn bg-danger text-light" onclick="return confirm('You Sure Delete Order ?')"><i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </main>

            </div>
        </div>

    </body>
</html>