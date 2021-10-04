    <div class="all-wrapper with-side-panel solid-bg-all">
    
    	<div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="{{url('home')}}"><img src="{{ asset('storage/images/logo.jpg') }}"><span>{{config('app.name')}}</span></a>
            <div class="mm-buttons">
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>
          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img alt="" src="{{asset('storage/img/avatar1.jpg')}}">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
				{{Auth::user()->name}}
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
				{!!Menu::menu()!!}
			</ul>
			<!--------------------
            END - Mobile Menu List
            -------------------->
		  
		  
		  </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w color-scheme-light color-style-default menu-position-side menu-side-left menu-layout-full sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
          
		  
		    <div class="logo-w">
          
            <a class="logo center-block" href="{{url('home')}}">
              <div class="avatar-w">
                <img alt="{{config('app.name')}}" src="{{ asset('storage/images/logo.jpg') }}">
              </div>
              <div class="logo-label">
                {{config('app.name')}} Management system
              </div>
            </a>
        </div>
		  
		 

      <ul class="main-menu no-top">
	     {!!Menu::flyout()!!}
        
	   </ul>
      
		  
        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
          

		
		