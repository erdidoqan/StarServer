@extends('home.layouts.master')
@section('content')
   <div class="col-sm-12">
       <div class="box text-center">
           <div class="box-header">
               <h3 class="box-title">Main Menu</h3>
           </div>
           <div class="box-body">
               <button class="btn btn-app" data-toggle="modal" data-target="#newAddCategory">
                   <i class="fa fa-plus"></i> New Category
               </button>
               <button class="btn btn-app" data-toggle="modal" data-target="#newAddMenu">
                   <i class="fa fa-play"></i> New Menu
               </button>
               <a class="btn btn-app" href="/logout">
                   <i class="fa fa-sign-out"></i> Logout
               </a>

           </div><!-- /.box-body -->
       </div><!-- /.box -->
   </div>

   <div class="col-sm-12">
       <div class="box">
           <div class="box-body">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                   @foreach($category as $cata)
                   <div class="panel panel-default">
                       <div class="panel-heading" role="tab" id="{{$cata->id}}">
                           <h4 class="panel-title">
                               <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$cata->id}}" aria-expanded="false" aria-controls="collapse{{$cata->id}}">
                                   {{ucwords($cata->category_name)}}
                               </a>
                           </h4>
                       </div>
                       <div id="collapse{{$cata->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$cata->id}}">
                           <div class="panel-body">
                               <div class="box-body no-padding">
                               <table class="table table-striped">
                                   <tr>
                                       <td style="width:10px"><button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button></td>
                                       <td style="width:1px"><input class="form-control input-xs" name="quanty" maxlength="2" value="1"></td>
                                       <td>Whopper® Menü</td>
                                       <td>&#163; 16,50</td>
                                   </tr>
                                   <tr>
                                       <td style="width:10px"><button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button></td>
                                       <td style="width:1px"><input class="form-control input-xs" name="quanty" maxlength="2" value="1"></td>
                                       <td>Double Whopper® Menü</td>
                                       <td>&#163; 22,50</td>
                                   </tr>
                                   <tr>
                                       <td style="width:10px"><button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button></td>
                                       <td style="width:1px"><input class="form-control input-xs" name="quanty" maxlength="2" value="1"></td>
                                       <td>Triple Whopper® Menü</td>
                                       <td>&#163; 27,50</td>
                                   </tr>
                                   <tr>
                                       <td style="width:10px"><button class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></button></td>
                                       <td style="width:1px"><input class="form-control input-xs" name="quanty" maxlength="2" value="1"></td>
                                       <td>Whopper Jr.® Menü</td>
                                       <td>&#163; 12,50</td>
                                   </tr>
                               </table>
                           </div>
                           </div>
                       </div>
                   </div>
                   @endforeach

               </div>
           </div>
       </div>
   </div>

   @include('home.partials.model')
@endsection
