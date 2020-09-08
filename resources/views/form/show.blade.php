@extends('layouts.app')
@section('styles')

@endsection
@section('content')

<section class="padding-block">
	<div class="container-fluid">
			<form id="contact" method="post" class="form create" role="form">
		<div class="row">
			<div class="col-lg-6"><!-- first column -->
				<div class="card custom-card create-wrapper">
					<div class="card-header">
						<h3>नयाँ दर्ता</h3>
					</div>
					<div class="card-body">
							<div class="contact-form">
							    <div class="row"><!-- main row open-->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> दर्ता न.:</label>
							    			 <span class="col-xs-10 col-md-10 form-group">
							    			 	 <p>reg-0001-75/76</p>
							    			 </span>
							    			 <!-- close of one field -->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> दर्ता मिति:</label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<p>२०७५ /०९ /१८</p>
							    			 </span>
							    			 <!-- close of one field -->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> पठाउनेको   ठेगाना:</label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<p>काठमाडौं नेपाल </p>
							    			 </span>
							    			 <!-- close of one field -->

											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2"> पत्रांक न.:</label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<p>reg-0001-75/76</p>
							    			 </span>
							    			 <!-- close of one field -->
											
											<!-- opening of one field -->
							    			 <label class="col-xs-2 col-md-2">  पत्र संख्या:</label>
							    			 <span class="col-xs-4 col-md-4 form-group">
							    			 	<p>१२३</p>
							    			 </span>
							    			 <!-- close of one field -->


							    </div><!-- row main close -->
							    <label class=""> कैफियत	:</label>
							    <p>नयाँ उद्योग खोल्न पाउ भन्ने बारे </p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6"><!-- first column -->
				<div class="card custom-card create-wrapper">
					<div class="card-header">
						<h3>दर्ता विवरण</h3> <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
					</div>
					<div class="card-body">
							<div class="contact-form">
							    <div class="row"><!-- main row open-->	
									<!-- opening of one field -->
									 <label class="col-xs-2 col-md-2"> पठाउनेको नाम :</label>
					    			 <span class="col-xs-9 col-md-9 form-group">
					    			 	 <p>उद्योग, वाणिज्य तथा आपूर्ति मन्त्रालय</p>
					    			 </span>
					    			 <label class="col-xs-2 col-md-2"> विषय:</label>
					    			 <span class="col-xs-9 col-md-9 form-group">
					    			 	<p>नयाँ उद्योग खोल्न पाउ भन्ने बारे </p>
					    			 </span>
				    			 </div><!-- row main close -->
								<div class="row">								
								<!-- opening of one field -->
				    			 <label class="col-xs-2 col-md-2"> मध्यम:</label>
				    			 <span class="col-xs-4 col-md-4 form-group">
				    			 <p>इमेल</p>
				    			 </span>
				    			 <!-- close of one field -->
								</div>
							    <div class="row">
							    	 <label class="col-xs-3 col-md-3">  कागजातहरु : </label>
							    	<span class="col-xs-12 col-md-12 form-group">
							    		<p class="imglist">
							    		  <a href="https://source.unsplash.com/IvfoDk30JnI/1500x1000" data-fancybox data-caption="&lt;b&gt;Single photo&lt;/b&gt;&lt;br /&gt;Caption can contain &lt;em&gt;any&lt;/em&gt; HTML elements">
							    		    <img src="https://source.unsplash.com/IvfoDk30JnI/240x160" />
							    		  </a>

							    		  <a href="https://source.unsplash.com/0JYgd2QuMfw/1500x1000" data-fancybox data-caption="This image has a simple caption">
							    		    <img src="https://source.unsplash.com/0JYgd2QuMfw/240x160" />
							    		  </a>
							    		</p>
							    	</span>
							    </div><!--  -->
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>
	</div>
</section>
@endsection
@section('scripts')

@endsection