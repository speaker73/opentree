<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tree</title>
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   {{-- <link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap.min.css">--}}
    <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap-theme.css">--}}
</head>
<body>

<div class="container">
    <div class="content">
        <ul class="list-group" id="tree">
            @foreach($companies as $item)
                {{--{!!$item->parent == 2?"<ul>":""!!}
                {!!$item->id != $item->parent?"<ul>":""!!}--}}
                <li id="{{$item->id}}" class="list-group-item" parent="{{$item->parent}}" amount="{{$item->amount}}" total_amount="{{$item->amount}}" level="">
                    <form action="{{ url('destroy/'.$item->id) }}" method="POST">



                        <button type="submit" class="btn btn-danger" >
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modal{{$item->id}}">Edit</button>
                    <label>
                        {{--<input type="checkbox" /> --}}id:{!!$item->id!!} | parent:{!!$item->parent!!} | name:{!!$item->name!!} | amount:${!!$item->amount!!}K {{-- total amount from base:{!!$item->total_amount!!}--}}
                    </label>
                </li>
                {!!"<ul id='ul".$item->id."'></ul>"!!}
                {{--{!!$item->parent == 2?"</ul>":""!!}--}}
            @endforeach
        </ul>

        <form action="{{ url('/add')}}" method="POST" class="form-inline">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            {{--  name:<input type="text" name="name">
              amount: <input type="text" name="amount">
              total_amount: <input type="text" name="total_amount">
              parent: <input type="text" name="parent">--}}
            <div class="form-group">
                <label for="iput_name">id</label>
                <input type="text" class="form-control" id="input_id" placeholder="1" name="id" readonly>
            </div>
            <div class="form-group">
                <label for="input_parent">Parent</label>
                <input type="text" class="form-control" id="input_parent" value="1" name="parent">
            </div>
            <div class="form-group">
                <label for="iput_name">Name</label>
                <input type="text" class="form-control" id="input_name" placeholder="Company" name="name">
            </div>
            <label for="input_amount">Amount</label>
            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" class="form-control" id="input_amount" placeholder="0" name="amount">
                <div class="input-group-addon">K</div>
            </div>
            {{-- <div class="form-group">
                 <label for="input_total_amount">Total amount</label>
                 <input type="text" class="form-control" id="input_total_amount" placeholder="0" name="total_amount">
             </div>--}}


            <button type="submit"  class="btn btn-primary">Add</button>
        </form>



    </div>
</div>
<!-- Modal -->
@foreach($companies as $item)
    <div class="modal fade" id="Modal{{$item->id}}" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{$item->name}}</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/edit/'.$item->id)}}" method="POST">




                        <div class="form-group">
                            <label for="iput_name">Name</label>
                            <input type="text" class="form-control" id="input_name{{$item->name}}" value="{{$item->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="input_amount">Amount</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" id="input_amount{{$item->name}}" value="{{$item->amount}}" name="amount">
                                <div class="input-group-addon">K</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_parent">Parent</label>
                            <input type="text" class="form-control" id="input_parent{{$item->name}}" value="{{$item->parent}}" name="parent">
                        </div>

                        <button type="submit" class="btn btn-default">Send</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    @endforeach

            <!-- script -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    {{--<script src="bower_resources/jquery/dist/jquery.min.js"></script>--}}
    <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   {{-- <script src="bower_resources/bootstrap/dist/js/bootstrap.min.js"></script>--}}
    <script type="text/javascript">
        /*Build Tree*/
        var li_length = $('.list-group-item').length;
        var tree_arr = [];
        @foreach($companies as $item)
                tree_arr[tree_arr.length] = {{$item->id}};
        @endforeach
        /*console.log(tree_arr);*/
        function tree_builder(){
            for( var i=0;i<=li_length;i++) {
                var parent = $('#' + tree_arr[i]).attr('parent');
                if (tree_arr[i] != parent) {
                    $("#" + tree_arr[i])
                            .appendTo("#ul" + parent);
                    $("#ul" + tree_arr[i])
                            .appendTo("#ul" + parent);
                }
            }
        }
        tree_builder();
        /*Edit form*/
        function add_value(){
            var number = tree_arr[tree_arr.length-1] + 1
            $("#input_parent").attr("value", number);
            $("#input_id").attr("value", number);
        }
        add_value();
        /* Calculate total amount  */
        function total_calc(id){
            var our_amount = Number($('#' + id).attr('amount'));
            var total_amount_id = our_amount;
            var our_parent = id;
            for(var i = 0;i<li_length;i++){
                if(tree_arr[i]!=our_parent){
                    var id_parent = $('#' + tree_arr[i]).attr('parent');
                    /*console.log('id:'+id_parent);*/
                    var id_amount = Number( $('#' + tree_arr[i]).attr('total_amount') );
                    /*console.log(id_amount);*/
                    if(id_parent == our_parent){
                        total_amount_id = Number(total_amount_id + id_amount);
                    }
                }
            }
            return total_amount_id;
        }
        /* Add total amount from tree*/
        function total_add(i){
            $("#"+i).append( "<label>| total calc:$"+total_calc(i)+"K</label>" );
            $("#"+i).attr("total_amount", total_calc(i));
        }
        /*The order of addition*/
        function order(){
            /* Добавляем елементы у которых есть child, но которые тоже имеют родителя */
            for(var i=0;i<tree_arr.length;i++){
                var our_parent = $('#' + tree_arr[i]).attr('parent');
                var our_parent_length = $('.list-group-item[parent="'+tree_arr[i]+'"]').length;
                if(our_parent_length > 0 ){
                    if(tree_arr[i]!= our_parent){
                        total_add(tree_arr[i]);
                    }
                }
            }
            /* добавляем елементы без родителей */
            for(var i2=0;i2<tree_arr.length;i2++){
                var our_parent2 = $('#' + tree_arr[i2]).attr('parent');
                var our_parent_length2 = $('.list-group-item[parent="'+tree_arr[i2]+'"]').length;
                if(our_parent2 == tree_arr[i2] ){
                    total_add(tree_arr[i2]);
                }
            }
        }
        var level_arr = [];
        function order_add_level(){
            for(var i=0;i<tree_arr.length;i++){
                var our_parent = $('#' + tree_arr[i]).attr('parent');
                var our_parent_length =$('.list-group-item[parent="'+tree_arr[i]+'"]').length;
                if(our_parent == tree_arr[i]){
                    $("#"+tree_arr[i]).attr("level", 1);
                    /*tree_arr.splice(i, 1);*/
                    level_arr[level_arr.length] = 1;
                }
                if(our_parent != tree_arr[i])
                {
                    $("#"+tree_arr[i]).attr("level", 2);
                    /*tree_arr.splice(i, 1);*/
                    level_arr[level_arr.length] = 2;
                }
                var id_parent_level = Number($('#' + our_parent).attr('level'));
                if(id_parent_level > 1){
                    $("#"+tree_arr[i]).attr("level", id_parent_level + 1);
                    level_arr.splice(level_arr.length-1, 1);
                    level_arr[level_arr.length] = id_parent_level + 1;
                }
            }
        }
        order_add_level();
        function sortDown(a, b) {
            if (a < b) return 1;
            if (a > b) return -1;
        }
        level_arr.sort(sortDown);
        var iter = Math.max.apply( Math, level_arr);
        var max_level = Math.max.apply( Math, level_arr);
        function order_calc() {
            for(var i = max_level;i>0;i--){
                for(var j = 0;j<level_arr.length;j++){
                    var level = i;
                    var id_level = Number($('#' + tree_arr[j]).attr('level'));
                    console.log("level:"+i+" level_id: "+id_level+" id:"+tree_arr[j]);
                    if(level==id_level){
                        console.log(level+" Print it! "+tree_arr[j]);
                        total_add(tree_arr[j]);
                        console.log("delete level_arr: "+i+" value: "+level_arr[i]);
                        /*level_arr.splice(i, 1);*/
                        /*console.log("splice tree_arr: "+j+" value: "+tree_arr[j]);*/
                        /* tree_arr.splice(j, 1);*/
                        /*console.log("delete tree_arr: "+j+" value: "+tree_arr[j]);
                         delete tree_arr[j];
                         console.log("tree_arr:"+tree_arr);*/
                    }
                }
            }
        }
        order_calc();
    </script>

</body>
</html>