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
                                   <thead>
                                   <tr>
                                       <th>Add</th>
                                       <th></th>
                                       <th>Menu Name</th>
                                       <th>Price</th>
                                   </tr>
                                   </thead>
                                   @foreach($cata->menu as $menu)
                                   <tr>
                                       <td style="width:10px"><a id="add-button" data-menu-name="{{$menu->menu_name}}" data-menu-id="{{$menu->id}}" data-cate-id="{{$cata->id}}" data-price="{{$menu->price}}" class="btn btn-primary add-button"><i class="fa fa-plus"></i></a></td>
                                       <td></td>
                                       <td>{{$menu->menu_name}}</td>
                                       <td>&#163; {{$menu->price}}</td>
                                   </tr>
                                   @endforeach
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

   <div class="sepet">
       <a class="btn btn-primary btn-lg fis-button" id="sepet-buton">
           <i class="fa fa-shopping-basket pull-left"></i><span>Sepet</span>
       </a>
       <div class="sepet-box">
           <div class="box-body">
               @foreach($allBasket as $basket)
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h5>{{$basket->menu_name}}</h5>
                   <p><input class="form-control input-xs" name="quanty" maxlength="2" value="1"> x £ 16,50</p>
                   <hr>
               @endforeach
               <a href="/basket" class="btn btn-block btn-sm btn-success">Print</a>
           </div>
       </div>
   </div>

    <script>
        $(document).ready(function () {
            var box = $('.sepet-box');
            box.hide();
            $('body').on('click','#sepet-buton',function(){
                box.slideToggle('slow');
            });

            $('body').on('click','.add-button',function(event){
                var menu_name = $(this).attr('data-menu-name'),
                    menu_id = $(this).attr('data-menu-id'),
                    category_id = $(this).attr('data-cate-id'),
                    price = $(this).attr('data-price');

                $('#addToBasket').modal('show');

                $('#menu-sepet input[name="menu_name"]').val(menu_name);
                $('#menu-sepet input[name="menu_id"]').val(menu_id);
                $('#menu-sepet input[name="category_id"]').val(category_id);
                $('#menu-sepet input[name="price"]').val(price);
                $('#menu_name').html(menu_name);
                $('#price').html('&#163;' + price);
            });
        });


    </script>
   @include('home.partials.model')
@endsection
