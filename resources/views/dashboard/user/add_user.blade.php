@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ add user</span>
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
                    <div class="col-lg-12 col-md-12">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>error</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('store-user')}}" id='adduser' method="post"
                                    autocomplete="off">
                                    {{ csrf_field() }}
                                    {{-- 1 --}}


                                        <div class="mb-3">
                                            <label for="firstname" class="control-label">first name</label>
                                            <input type="text" class="form-control"  name="first_name"
                                                title="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastname" class="control-label">last name</label>
                                            <input type="text" class="form-control"  name="last_name"
                                                title="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="control-label">email</label>
                                            <input type="email" class="form-control"  name="email"
                                                title="" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="phonenumber" class="control-label">phone number</label>
                                            <input type="text" class="form-control"  name="phone_number"
                                                title="" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="text" class="control-label">password</label>
                                            <input type="password" class="form-control"  name="password"
                                                title="" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="control-label">password confirmation</label>
                                            <input type="password" class="form-control"  name="password_confirmation"
                                                title="" required>
                                        </div>


                                        <div class="mb-3">
                                            <label for="role" class="control-label">role</label>
                                            <select name="role_id" class="form-control SlectBox" >
                                                <!--placeholder-->
                                                <option value="" selected disabled>role </option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <br/>

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary"> store </button>
                                    </div>
                                    <br/>
                                    <br/>

                                </form>
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
    $(document).ready(function() {

        $(function() {
   $("#adduser").submit(function() {
      $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
      return true; // ensure form still submits
    });
});
})


</script>
@endsection
