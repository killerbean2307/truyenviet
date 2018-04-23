
{{-- navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark wow slideInDown" style="background-color: #2C3E50!important;">
	<div class="container">
		<a class="navbar-brand" href="#">TRUYỆN VIỆT</a>
  		
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>


	  	<div class="collapse navbar-collapse" id="myNav">
	    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="category_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Thể loại
			        </a>
			        <div class="dropdown-menu" aria-labelledby="category_dropdown" id="category_dropdown_menu">
						<div class="container-fluid">			
							@foreach ($categories->chunk(3) as $chunk)
								<div class="row">
				        			@foreach ($chunk as $category)
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 dropdown-item-custom">
										
												<a href="#">{{ $category->name }}</a>
											
										</div>
				        			@endforeach
				        		</div>

							@endforeach
						</div>
			      		{{-- <a class="dropdown-item" href="#">Action</a> --}}
			        	{{-- <a class="dropdown-item" href="#">Another action</a> --}}
			        </div>
			    </li>
			   	<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="collection_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Danh mục
			        </a>
			        <div class="dropdown-menu" aria-labelledby="collection_dropdown">
			          <a class="dropdown-item" href="#">Action</a>
			          <a class="dropdown-item" href="#">Another action</a>
			        </div>
			    </li>
	    	</ul>
	    	<form class="form-inline my-2 my-lg-0">
				<div class="input-group">
		      		<input class="form-control border border-right-0" id="search-box" type="search" placeholder="Search" aria-label="Search">
		            	<span class="input-group-append">
		                	<button class="btn btn-outline border-left-0 border bg-light" type="button" id="search">
		                    	<i class="fa fa-search"></i>
		                	</button>
		            	</span>
	            </div>
	    	</form>
	  	</div>
	</div>
</nav>
{{-- end navbar --}}