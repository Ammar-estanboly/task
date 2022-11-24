@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ show products</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                <div class="col-xl-12">
                <div class="card mg-b-20">
                @can('add-product')
                    <div class="card-header pb-0">

                        <a href="{{ route('show_add-product') }}" class="modal-effect btn btn-sm btn-primary"
                            style="color:white"><i class="fas fa-plus"></i>&nbsp;Add product</a>
                    </div>
                @endcan

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">name</th>
                                        <th class="border-bottom-0">image</th>
                                        <th class="border-bottom-0"> operation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($products as $product)
                                        @php
                                        $i++
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $product->name }} </td>
                                            <td><img src="{{ asset($product->image) }}" width="100px"class="img-thumbnail" /></td>

                                            <td>
                                                    <div class="d-flex justify-content-center">
                                                         @can('edit-product')
                                                         <a class=""
                                                         href="{{route('show-edit-product',$product->id)}}" title="update"><i
                                                         class="la la-cog fa-lg"></i>
                                                         </a>
                                                         @endcan
                                                        @can('edit-product')
                                                           <a class="" title="delete" href="#" data-product_id="{{ $product->id }}"
                                                            data-toggle="modal" data-target="#delete_product"><i
                                                                class="text-danger fas fa-trash-alt fa-lg"></i>&nbsp;&nbsp;
                                                            </a>

                                                           @endcan





                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{$products->links()}}
                        </div>
                    </div>


                <div class="modal fade" id="delete_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> delete product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <form action="{{ route('delete-product') }}" method="post">

                                    {{ csrf_field() }}
                            </div>
                            <div class="modal-body">
                                are you sure ?
                                <input type="hidden" name="product_id" id="product_id" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                <button type="submit" class="btn btn-danger">delete</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

@endsection
@section('js')
<script>
    $('#delete_product').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var product_id = button.data('product_id')
        var modal = $(this)
        modal.find('.modal-body #product_id').val(product_id);
    })

</script>
@endsection
