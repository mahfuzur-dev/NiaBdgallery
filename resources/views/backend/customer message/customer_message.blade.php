@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Customer Message</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Message</a></li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card m-3">
               <div class="card-header">
                    <h3>Customer Contact</h3>
               </div>
                <div class="card-body m-3">
                    <table class="table table-striped table-active table-hover">
                        <tr>
                            <th>Sl No</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($all_contacts as $key=>$contact)
                             <tr>
                                   <td>{{$key+1}}</td>
                                   <td>{{$contact->name}}</td>
                                   <td>{{$contact->email}}</td>
                                   <td>{{$contact->mobile}}</td>
                                   <td>{{$contact->address}}</td>
                                   <td>{{$contact->message}}</td>
                                   <td class="actions">
                                        <a href="{{route('contact.delete',$contact->id)}}" class="on-default remove-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                   </td>
                             </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
