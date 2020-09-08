@extends('layouts.app')
@section('styles')

@endsection
@section('content')
<section class="padding-block">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header text-center">
						<h3> दर्ता किताब </h3>
					</div>
					<div class="card-body">
						<!-- filter -->
						<div class="filter">
							<div class="row form-group">
								<div class="col-lg-12">
			 						<div class="add-new mb-3">
    			 						<a href="form-create">
    			 							नयाँ थप गर्नुहोस्  <i class="fas fa-plus"></i>    	
		 		 						</a>
			 						</div>
								</div>
								<div class="col-lg-2">
									 <label> दर्ता न.:</label>
									 <input type="text" id="darta-no" class="form-control" placeholder="REG-0001-75/76">
								</div><!--  -->
								<div class="col-lg-2">
									 <label> पठाउनेको नाम </label>
									 <select class="form-control select" id="subject-select" >
				    			 	     <option></option>
				    			 	     <option>वन तथा वातावरण मन्त्रालय</option>
				    			 	     <option>प्रधानमन्त्री तथा मन्त्रिपरिषद्को कार्यालय</option>
				    			 	     <option>कृषि, भूमि व्यवस्था तथा सहकारी मन्त्रालय</option>
				    			 	     <option>संस्कृति, पर्यटन तथा नागरिक उड्डयन मन्त्रालय</option>
				    			 	     <option>उद्योग, वाणिज्य तथा आपूर्ति  मन्त्रालय</option>
				    			 	     <option>गृह मन्त्रालय</option>
			    			 	   </select>
								</div><!--  -->
								<div class="col-lg-2">
									 <label> मिती देखी  </label>
									 <input id="datepickerform" type="text" class="form-control" placeholder="२०७५ /०९ /१८">
								</div>
								<div class="col-lg-2">
									 <label> मिती सम्म</label>
									 <input id="datepickerto" type="text" class="form-control" placeholder="२०७५ /०९ /१८">
								</div><!--  -->
								<div class="col-lg-2">
									 <label> माध्यम</label>
									<select class="form-control select" id="subject-select">
					    			 	     <option>इमेल</option>
					    			 	     <option>कूरियर</option>
					    			 	     <option>वेबसाइट</option>
			    			 	   </select>
								</div><!--  -->
								<div class="col-lg-2">
									<p class="mt-4">
										<button class="btn custom-btn btn-submit" type="submit">पेश</button>
										<button class="btn custom-btn btn-clear" type="submit">रद्ध</button>
									</p>
								</div><!--  -->
							</div>
						</div>
						<!-- filter ends -->
						<table class="table table-bordered">
						  <thead>
						    <tr>
						      <th scope="col">क्रम </th>
						      <th scope="col">दर्ता न.</th>
						      <th scope="col">दर्ता मिति </th>
						      <th scope="col">पठाउनेको नाम </th>
						      <th scope="col">पत्रांक न.</th>
						      <th scope="col">पत्र संख्या</th>
						      <th scope="col">माध्यम</th>
						      <th scope="col">गतिबिधी </th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">१</th>
						      <td>REG-0001-75/76</td>
						      <td>२०७५ /०९ /१८</td>
						      <td>उद्योग, वाणिज्य तथा आपूर्ति  मन्त्रालय</td>
						      <td>१२३४</td>
						      <td>०९</td>
						      <td>इमेल</td>
						      <td>
						      	<a href="form-show" class="view"><i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
						      	<a href="form-show" class="edit"><i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
					      		<a href="#" class="delet"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delet"></i></a>
						      </td>
						    </tr>
						    <tr>
						      <th scope="row">२</th>
						      <td>REG-0002-75/76</td>
						      <td>२०७५ /०९ /१८</td>
						      <td>उद्योग, वाणिज्य तथा आपूर्ति  मन्त्रालय</td>
						      <td>१२३४</td>
						      <td>०९</td>
						      <td>इमेल</td>
						      <td>
						      	<a href="form-show" class="view"><i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
						      	<a href="form-show" class="edit"><i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
					      		<a href="#" class="delet"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delet"></i></a>
						      </td>
						    </tr>
						    <tr>
						      <th scope="row">३</th>
						      <td>REG-0003-75/76</td>
						      <td>२०७५ /०९ /१८</td>
						      <td>उद्योग, वाणिज्य तथा आपूर्ति  मन्त्रालय</td>
						      <td>१२३४</td>
						      <td>०९</td>
						      <td>इमेल</td>
						      <td>
						      	<a href="form-show" class="view"><i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
						      	<a href="form-show" class="edit"><i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
					      		<a href="#" class="delet"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delet"></i></a>
						      </td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
    @include('layouts.deleteModal')
@endsection
@section('scripts')
<script>
        $('#datepickerform,#datepickerto').flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            
        });
    </script>
@endsection