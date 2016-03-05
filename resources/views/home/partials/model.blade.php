<div class="modal fade" id="newAddMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Menu</h4>
            </div>
            <form action="/addNewMenu" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Menu Name</label>
                        <input type="text" name="menu_name" class="form-control" id="menu" placeholder="Menu Name">
                    </div>

                    <div class="form-group">
                        <label for="category">Select a category</label>
                        <select class="form-control" name="category">
                            @foreach($category as $cate)
                                <option value="{{$cate->id}}">{{ucwords($cate->category_name)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Menu Price</label>
                        <input type="text" name="price" class="form-control" id="menu" placeholder="Menu Price">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addToBasket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/basket/new" method="post" id="menu-sepet">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <input type="hidden" name="menu_name">
                    <input type="hidden" name="menu_id">
                    <input type="hidden" name="category_id">
                    <input type="hidden" name="price">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h4 id="menu_name"></h4>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <h4 id="price" class="text-right"></h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Count: </label>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group number-spinner">
                                <span class="input-group-btn">
                                    <a class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></a>
                                </span>
                                        <input type="text" class="form-control text-center" name="count" value="1">
                                <span class="input-group-btn">
                                    <a class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category">Promotion: </label>
                                <div class="btn-group" style="float:right" data-toggle="buttons">

                                    <label class="btn btn-info">
                                        <input type="radio" name="promotionType" id="promotionType" autocomplete="off" value="percent">
                                        <span class="glyphicon glyphicon-info-sign"></span>
                                    </label>

                                    <label class="btn btn-info">
                                        <input type="radio" name="promotionType" id="promotionType" autocomplete="off" value="price">
                                        <span class="glyphicon glyphicon-euro"></span>
                                    </label>

                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <div class="form-group" id="pro">
                                <input type="text" name="promotion" class="form-control" id="promotion" placeholder="Promotion">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to Basket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newAddCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
            </div>
            <form action="/addNewCategory" method="post">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category" placeholder="Category Name">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('body').on('click','#promotionType',function(){
            $('#pro').parent().show();
        });
    });
</script>