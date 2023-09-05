 @extends('admin.layouts.master')
 @section('title', 'Create User')
 @section('content')

     <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         <div class="container">
             <div class="row">
                 <div class="row justify-content-center">
                     <div class="col-md-6 ">
                         <div id="success"></div>
                         <div class="card">
                             <div class="card-header">
                                 <h4>
                                     Add food
                                     <a href="{{ route('food.index') }}" class="'btn btn-danger btn-sm float-end">Back</a>
                                 </h4>
                             </div>
                             <div class="card-body">
                                 <form id="addfood">
                                     @csrf
                                     <div class="form-group mb-3">
                                         <label for="name">food Name</label>
                                         <input type="text" name="name" value="{{ old('name') }}"
                                             class="form-control" id="name">
                                         <div class="name-errors"></div>
                                         @if ($errors->has('name'))
                                             <span class="text-danger">{{ $errors->first('name') }}</span>
                                         @endif
                                     </div>
                                     <div class="form-group mb-3">
                                         <label for="">description</label>
                                         <input type="text" name="description" value="{{ old('description') }}"
                                             class="form-control" id="descp">
                                         <div class="descp-errors"></div>
                                         @if ($errors->has('description'))
                                             <span class="text-danger">{{ $errors->first('description') }}</span>
                                         @endif
                                     </div>
                                     <div class="form-group mb-3">
                                         <label for="">cousin</label>
                                         <input type="text" name="cousin" value="{{ old('cousin') }}"
                                             class="form-control" id="cousin">
                                         <div class="cousin-errors"></div>
                                         @if ($errors->has('cousin'))
                                             <span class="text-danger">{{ $errors->first('cousin') }}</span>
                                         @endif
                                     </div>
                                     <div class="form-group mb-3">
                                         <button type="submit" class="btn btn-primary">Submit</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </h2>
 @endsection
 @push('script')
     <script>
         $(document).ready(function() {
             $(document).on('submit', '#addfood', function(event) {
                 event.preventDefault();
                 var ajaxData = new FormData(this);
                 var value = "an error occured"
                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     type: 'POST',
                     url: "{{ route('food.store') }}",
                     data: ajaxData,
                     cache: false,
                     processData: false,
                     contentType: false,
                     success: function(result) {
                         window.location.href = "{{ route('food.index') }}"
                     },
                     error: function(error) {
                     }
                 });
             });
         });
     </script>
 @endpush
