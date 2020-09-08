@extends('layouts.app')
@section('styles')

@endsection
@section('content')
<section class="padding-block">
	<div class="container-fluid">
			<form id="contact" method="post" class="form create" role="form">
		<div class="row">
			<div class="col-lg-7"><!-- first column -->
				<div class="card custom-card create-wrapper">
					<div class="card-header">
						<h3>नयाँ चलानी</h3>
					</div>
					<div class="card-body">
							<div class="contact-form">
							    <div class="row"><!-- main row open-->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> दर्ता न.: <span class="required-field">*</span></label>
							    			 <span class="col-xs-10 col-md-10 form-group">
							    			 	 <input type="number"  id="darta-no" class="form-control">
							    			 </span>
							    			 <!-- close of one field -->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> दर्ता मिति: <span class="required-field">*</span></label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<input id="datepicker" type="text" class="form-control">
							    			 </span>
							    			 <!-- close of one field -->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> पाउनेको   ठेगाना: <span class="required-field">*</span></label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<input id="address" type="text" class="form-control">
							    			 </span>
							    			 <!-- close of one field -->

											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> पत्रांक न.: <span class="required-field">*</span></label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<input id="ref-no" type="text" class="form-control">
							    			 </span>
							    			 <!-- close of one field -->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2">   पत्र संख्या: <span class="required-field">*</span></label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<input id="num-doc" type="text" class="form-control">
							    			 </span>
							    			 <!-- close of one field -->


							    </div><!-- row main close -->
							    <label class=""> कैफियत:</label>
							    <textarea class="form-control" id="message" name="message" placeholder="कैफियत" rows="6"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5"><!-- first column -->
				<div class="card custom-card create-wrapper">
					<div class="card-header">
						<h3>चलानी विवरण </h3> <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
					</div>
					<div class="card-body">
							<div class="contact-form">
							    <div class="row"><!-- main row open-->	
									<!-- opening of one field -->
									 <label class="col-xs-3 col-md-3"> पाउनेको नाम : <span class="required-field">*</span>	</label>
					    			 <span class="col-xs-7 col-md-7 form-group">
					    			  <select class="form-control select" id="subject-select">
				    			 	     <option>वन तथा वातावरण मन्त्रालय</option>
				    			 	     <option>प्रधानमन्त्री तथा मन्त्रिपरिषद्को कार्यालय</option>
				    			 	     <option>कृषि, भूमि व्यवस्था तथा सहकारी मन्त्रालय</option>
				    			 	     <option>संस्कृति, पर्यटन तथा नागरिक उड्डयन मन्त्रालय</option>
				    			 	     <option>उद्योग, वाणिज्य तथा आपूर्ति मन्त्रालय</option>
				    			 	     <option>गृह मन्त्रालय</option>
			    			 	   </select>
					    			 </span>
					    			  <span class="col-xs-2 col-md-2">
    			 						<div class="add-new">
	    			 						<a href="" data-toggle="modal" data-target="#sender-name">
	    			 							 <i class="fas fa-plus"></i>    	
			 		 						</a>
    			 						</div>
		 		 						<!-- model open for sender -->
    			 						<div class="modal fade" id="sender-name" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    			 						  <div class="modal-dialog" role="document">
    			 						    <div class="modal-content">
    			 						      <div class="modal-header">
    			 						        <h5 class="modal-title" id="sender-title">पठाउनेको नाम थप्नुहोस्  :</h5>
    			 						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    			 						          <span aria-hidden="true">&times;</span>
    			 						        </button>
    			 						      </div>
    			 						      <div class="modal-body">
    			 						       		<input id="add-sender" type="text" class="form-control" placeholder="नाम">
    			 						      </div>
    			 						      <div class="modal-footer">
    			 						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    			 						        <button type="button" class="btn btn-primary">Save changes</button>
    			 						      </div>
    			 						    </div>
    			 						  </div>
    			 						</div>
    			 						<!-- model close for sender -->
					    			 </span>
					    			 <label class="col-xs-3 col-md-3"> विषय: <span class="required-field">*</span>	</label>
					    			 <span class="col-xs-7 col-md-7 form-group">
					    			 <select class="form-control select" id="subject-select">
					    			 	     <option>नयाँ उद्योग खोल्न पाउ भन्ने बारे </option>
					    			 	     <option>नयाँ उद्योग खोल्न पाउ भन्ने बारे </option>
					    			 	     <option>नयाँ उद्योग खोल्न पाउ भन्ने बारे 1</option>
			    			 	   </select>
					    			 </span>
					    			 <span class="col-xs-2 col-md-2">
				 						<div class="add-new">
					 						<a href="" data-toggle="modal" data-target="#subject">
					 							 <i class="fas fa-plus"></i>    	
			 		 						</a>
				 						</div>
		 		 						<!-- model open for sender -->
				 						<div class="modal fade" id="subject" tabindex="-1" role="dialog" aria-labelledby="subjettitle" aria-hidden="true">
				 						  <div class="modal-dialog" role="document">
				 						    <div class="modal-content">
				 						      <div class="modal-header">
				 						        <h5 class="modal-title" id="subjectmodel">विषय थप्नुहोस्: <span class="required-field">*</span>	</h5>
				 						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				 						          <span aria-hidden="true">&times;</span>
				 						        </button>
				 						      </div>
				 						      <div class="modal-body">
				 						    	<input id="add-sender" type="text" class="form-control" placeholder="विषय">
				 						      </div>
				 						      <div class="modal-footer">
				 						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				 						        <button type="button" class="btn btn-primary">Save changes</button>
				 						      </div>
				 						    </div>
				 						  </div>
				 						</div>
				 						<!-- model close for sender -->
					    			 </span>
				    			 </div><!-- row main close -->
								<div class="row">								
								<!-- opening of one field -->
				    			 <label class="col-xs-3 col-md-3"> मध्यम: <span class="required-field">*</span>	</label>
				    			 <span class="col-xs-4 col-md-4 form-group">
			 						<select class="form-control select" id="subject-select">
			 		    			 	     <option>इमेल</option>
			 		    			 	     <option>कूरियर</option>
			 		    			 	     <option>वेबसाइट</option>
			     			 	   </select>
				    			 </span>
				    			 <!-- close of one field -->
								</div>
							    <div class="row">
							    	
							    	 <label class="col-xs-3 col-md-3">कागजात अपलोड  </label>
							    	<span class="col-xs-9 col-md-9 form-group">
							    		<input type="file" class="form-control-file" id="imageupload">
							    	</span>
							    </div><!--  -->
						</div>
					</div>
				</div>
				<!-- sadasd -->
				<div class="card">
					<div class="card-body">
						<p class="text-right">
							<button class="btn custom-btn btn-submit" type="submit">पेश गर्नुहोस्</button>
							<button class="btn custom-btn btn-clear" type="submit">रद्ध गर्नुहोस्</button>
						</p>
					</div>
				</div>
			</div>

		</div>
	</form>
	</div>
</section>
	

@endsection
@section('scripts')
<script>
        $('#datepicker').flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            
        });
    </script>
@endsection