
{{-- navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark wow slideInDown" style="background-color: #2C3E50!important;">
	<div class="container">
		<a class="navbar-brand mr-5" href="{{route('index')}}">
			<img src="logo.png" alt="Truyện Việt" width="30" height="30">
			TRUYỆN VIỆT
		</a>
  		
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>


	  	<div class="collapse navbar-collapse" id="myNav">
	    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item dropdown px-3">
			        <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="category_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fas fa-bars"></i> Thể loại
			        </a>
			        <div class="dropdown-menu" aria-labelledby="category_dropdown" id="category_dropdown_menu">
						<div class="container-fluid">			
							@foreach ($categories->chunk(3) as $chunk)
								<div class="row">
				        			@foreach ($chunk as $category)										
										<a class="col-xs-4 col-sm-4 col-md-4 col-lg-4 dropdown-item dropdown-item-custom" href="{{route('category.story',$category->slug)}}">{{ $category->name }}
										</a>
				        			@endforeach
				        		</div>

							@endforeach
						</div>
			      		{{-- <a class="dropdown-item" href="#">Action</a> --}}
			        	{{-- <a class="dropdown-item" href="#">Another action</a> --}}
			        </div>
			    </li>
			   	<li class="nav-item dropdown px-3">
			        <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="collection_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			         <i class="fas fa-bars"></i> Danh mục
			        </a>
			        <div class="dropdown-menu" aria-labelledby="collection_dropdown">
			          <a class="dropdown-item" href="{{route('hot-story')}}">Truyện Hot</a>
					  <a class="dropdown-item" href="{{route('full-story')}}">Truyện Hoàn Thành</a>
					  <a href="{{route('new-story')}}" class="dropdown-item">Truyện mới</a>
			        </div>
			    </li>

			    <li class="nav-item dropdown px-3" id="theme_setting" style="display: none;">
			    	<a class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          <i class="fas fa-cog"></i> Cài đặt
			        </a>
					@php
						$font = 16;
						$fontSize = "";
						while ( $font <= 40) {
							$fontSize .= "<option value=".$font.">".$font."</option> ";
							$font+=2;
						}

						$lineHeight = "";
						for ($line=1.0; $line < 2.0 ; $line+=0.2) { 
							$lineHeight .= "<option value=".$line.">".$line*100 ."%</option> ";	
						}

						$fontFamily = 
							'<option value="Merriweather Sans">Merriweather Sans</option>
							<option value="Arial">Arial</option>
							<option value="Tahoma">Tahoma</option>
							<option value="Verdana">Verdana</option>
							<option value="Times New Roman">Times New Roman</option>
							<option value="Roboto">Roboto</option>
							<option value="Segoe UI">Segoe UI</option>
							<option value="Palatino Linotype">Palatino Linotype</option>';

						$data_content = '
							<div id="data-content" class="dropdown-menu">
								<div class="row container my-3">
									<div class="col-5 mb-1 font-weight-bold">Font chữ</div>
									<div class="col-7 mb-1">
										<select name="font-family" class="font-family" style="width: 100%">
											'.$fontFamily.'
										</select>
									</div>
									<hr>

									<div class="col-5 mb-1 font-weight-bold">Cỡ chữ</div>
									<div class="col-7 mb-1">
										<select name="font-size" class="font-size" style="width: 100%">
											'.$fontSize.'
										</select>
									</div>

									<div class="col-5 mb-1 font-weight-bold">Dòng</div>
									<div class="col-7 mb-1">
										<select name="line-height" class="line-height" style="width: 100%">
											'.$lineHeight.'
										</select>					
									</div>

									<div class="col-12 mb-3 font-weight-bold">Màu nền</div>
									<div class="col-12">
										<div class="row container mx-auto">
											<div class="col mx-1 background-color" data-background-color="#F2F3F7" data-content-color="#ECEEF3" data-font-color="black" style="width:100%;padding-top: 20%; background-color: #F2F3F7;">
											</div>
											<div class="col mx-1 background-color" data-background-color="#ceb78e" data-content-color="#F1E8C1" data-font-color="black" style="width:100%;padding-top: 20%; background-color: #ceb78e;">
											</div>
											<div class="col mx-1 background-color" data-background-color="#4a4a4a" data-content-color="#DCDCDC" data-font-color="black" style="width:100%;padding-top: 20%; background-color: #4a4a4a;">
											</div>
											<div class="col mx-1 background-color" data-background-color="#0d0d0d" data-content-color="#151618" data-font-color="white" style="width:100%;padding-top: 20%; background-color: #0d0d0d;">
											</div>												
										</div>
									</div>
								</div>
							</div>	
						';

						echo $data_content;
					@endphp				    	
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