@extends('affiliate.layouts.master')
@section('content')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                  
    
                    <div class="page-title">
                        <h1>Affiliate Dashboard</h1>
                    </div>
                   
                    
                    
                    
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif

        <div class="content mt-3">

            
            
             <!--/.col-->
 
             <div class="col-sm-6 col-lg-3">
                 <div class="card text-black bg-flat-color-2">
                     
                    <div class="card-body ">
                        <h5 class="card-title" >Information</h5>
                        <p class="card-text " style="color: black">Name : {{Auth::guard('affiliate')->user()->name}}</p>
                        <p class="card-text " style="color: black">Email : {{Auth::guard('affiliate')->user()->email}}</p>
                        <p class="card-text " style="color: black">Code : {{Auth::guard('affiliate')->user()->code}}</p>
                        
                      </div>
 
                         
                 </div>
                 
             </div>
             
                @if($user->notifications)
            
                
                <table class="table">
                    <caption>Notification</caption>
                    <thead>
                    <tr>
                        
                        <th scope="col">SL</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Commission From</th>

                        
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($user->notifications as $notification)

                        {{-- <p class="card-text " style="color: black">{{$notification->data['amount']}} commission amount add by {{$notification->data['email']}}</p> --}}

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$notification->data['amount']}}</td>
                                <td>{{$notification->data['email']}}</td>
                            </tr>
                            
                        @endforeach
                    
                    
                
                    </tbody>
                </table>
    
                
                @endif
            
             


        </div> <!-- .content -->

@endsection