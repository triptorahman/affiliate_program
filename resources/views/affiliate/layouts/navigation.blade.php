    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    
                    <li class="active">
                        <a href="{{route('affiliate.dashboard')}}"> <i class="menu-icon fa fa-cubes"></i>Affiliate Dashboard </a>
                    </li>
                    
                   
                    @if(Auth::guard('affiliate')->user()->has_parent == 0)
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Sub Affiliate Management</a>
                        <ul class="sub-menu children dropdown-menu">
      
                            <li><i class="fa fa-list-ul"></i><a href="{{route('affiliate.sub_affiliate.list')}}">Sub Affiliate List</a></li>
                            <li><i class="fa fa-list-ul"></i><a href="{{route('affiliate.sub_affiliate.add')}}">Add Sub-Affiliate</a></li>
                            
                        </ul>
                    </li>
                    @endif


                    @if(Auth::guard('affiliate')->user()->has_parent == 1)
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Commission from User</a>
                        <ul class="sub-menu children dropdown-menu">
      
                            <li><i class="fa fa-list-ul"></i><a href="{{route('affiliate.sub_affiliate.commision')}}">Transaction List</a></li>
                            
                            
                        </ul>
                    </li>
                    @endif
                    {{-- route hide --}}
                    @if(Auth::guard('affiliate')->user()->has_parent == 0) 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Commissions</a>
                        <ul class="sub-menu children dropdown-menu">
      
                            <li><i class="fa fa-list-ul"></i><a href="{{route('affiliate.commision')}}">Transaction List For User</a></li>
                           
                            
                        </ul>
                    </li>
                    @endif


                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->