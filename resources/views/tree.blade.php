<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tree</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap.min.css">--}}
            <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap-theme.css">--}}
</head>
<body>

<div class="container">
    <div class="content">
        <ul class="list-group center-block" id="tree">
            @foreach($companies as $item)

                <li id="{{$item->id}}" class="list-group-item h3 panel panel-success alert-info" data-parent="{{$item->parent}}"
                    data-amount="{{$item->amount}}" data-total_amount="{{$item->amount}}" data-level="" >


                            <span>{!!$item->name!!}</span>
                    <form action="{{ url('destroy/'.$item->id) }}" method="POST" class="form-inline right">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" class="btn btn-danger" style="margin-bottom:8px;margin-top:8px;">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        <button type="button" class="btn btn-info form-inline" style="margin-bottom:8px;margin-top:8px;" data-toggle="modal" data-target="#Modal{{$item->id}}">
                            Edit
                        </button>
                    </form>

                        <div class="panel-footer">

                            <label class="label label-primary">id <span class='badge' style="color:#337AB7;background:#fff;">{!!$item->id!!}</span></label>
                            <label class="label label-primary">parent <span class='badge' style="color:#337AB7;background:#fff;">{!!$item->parent!!}</span></label>

                            <label class="label label-primary">Earnings <span class='badge' style="color:#337AB7;background:#fff;">${!!$item->amount!!}K</span></label>
                        </div>


                </li>
                {!!"<ul style='background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);' id='ul".$item->id."'></ul>"!!}
                {{--{!!$item->parent == 2?"</ul>":""!!}--}}
            @endforeach
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
        <form action="{{ url('/add')}}" method="POST" class="form-inline" >
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
            <label for="input_amount">Earnings</label>
            <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" class="form-control" id="input_amount" placeholder="0" name="amount">
                <div class="input-group-addon">K</div>
            </div>
            {{-- <div class="form-group">
                 <label for="input_total_amount">Total amount</label>
                 <input type="text" class="form-control" id="input_total_amount" placeholder="0" name="total_amount">
             </div>--}}


            <button type="submit" class="btn btn-primary">Add</button>
        </form>
            </div>
            <div class="panel-footer">Add form</div>
        </div>

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
                    <form action="{{ url('/edit/'.$item->id)}}" method="post">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put">

                        <div class="form-group">
                            <label for="iput_name">Name</label>
                            <input title="name" type="text" class="form-control" id="input_name{{$item->name}}"
                                   value="{{$item->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="input_amount">Earnings</label>
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input title="amount" type="text" class="form-control" id="input_amount{{$item->name}}"
                                       value="{{$item->amount}}" name="amount">
                                <div class="input-group-addon">K</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_parent">Parent</label>
                            <input title="parent" type="text" class="form-control" id="input_parent{{$item->name}}"
                                   value="{{$item->parent}}" name="parent">
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
    <script type="text/javascript" src="//code.jquery.com/jquery-2.2.4.min.js"></script>
    {{--<script src="bower_resources/jquery/dist/jquery.min.js"></script>--}}
            <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    {{-- <script src="bower_resources/bootstrap/dist/js/bootstrap.min.js"></script>--}}
    <script type="text/javascript">
        /*Build Tree*/
        var li_length = $('.list-group-item').length;
        var tree_arr = [];
        @foreach($companies as $item)
                tree_arr[tree_arr.length] = {{$item->id}};
        @endforeach
        /*console.log(tree_arr);*/
        function tree_builder() {
            for (var i = 0; i <= li_length; i++) {
                var parent = $('#' + tree_arr[i]).attr('data-parent');
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
        function add_value() {
            var number = null;
            if (li_length == 0) {
                number = 1;
            } else {
                number = tree_arr[tree_arr.length - 1] + 1;
            }
            $("#input_parent").attr("value", number);
            $("#input_id").attr("value", number);
        }
        add_value();
        /* Calculate total amount  */
        function total_calc(id) {
            var our_amount = Number($('#' + id).attr('data-amount'));
            var total_amount_id = our_amount;
            var our_parent = id;
            for (var i = 0; i < li_length; i++) {
                if (tree_arr[i] != our_parent) {
                    var id_parent = $('#' + tree_arr[i]).attr('data-parent');
                    /*console.log('id:'+id_parent);*/
                    var id_amount = Number($('#' + tree_arr[i]).attr('data-total_amount'));
                    /*console.log(id_amount);*/
                    if (id_parent == our_parent) {
                        total_amount_id = Number(total_amount_id + id_amount);
                    }
                }
            }
            return total_amount_id;
        }
        /* Add total amount from tree*/
        function total_add(i) {
            $("#" + i+" .panel-footer").append("<label role='presentation' class='label label-primary'>Total  <span class='badge' style='color:#337AB7;background:#fff;'>$" + total_calc(i) + "K</span></label>");
            $("#" + i).attr("data-total_amount", total_calc(i));
        }
        /*The order of addition*/

        var level_arr = [];
        function order_add_level() {
            for (var i = 0; i < tree_arr.length; i++) {
                var our_parent = $('#' + tree_arr[i]).attr('data-parent');
                var our_parent_length = $('.list-group-item[data-parent="' + tree_arr[i] + '"]').length;
                if (our_parent == tree_arr[i]) {
                    $("#" + tree_arr[i]).attr("data-level", 1);
                    /*tree_arr.splice(i, 1);*/
                    level_arr[level_arr.length] = 1;
                }
                if (our_parent != tree_arr[i]) {
                    $("#" + tree_arr[i]).attr("data-level", 2);
                    /*tree_arr.splice(i, 1);*/
                    level_arr[level_arr.length] = 2;
                }
                var id_parent_level = Number($('#' + our_parent).attr('data-level'));
                if (id_parent_level > 1) {
                    $("#" + tree_arr[i]).attr("data-level", id_parent_level + 1);
                    level_arr.splice(level_arr.length - 1, 1);
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
        var max_level = Math.max.apply(Math, level_arr);
        function order_calc() {
            console.log("level_arr:[" + level_arr + "]");
            console.log("tree_arr:[" + tree_arr + "]");
            for (var i = max_level; i > 0; i--) {
                for (var j = 0; j < level_arr.length; j++) {
                    var level = i;
                    var id_level = Number($('#' + tree_arr[j]).attr('data-level'));
                    console.log("level:" + i + " level_id: " + id_level + " id:" + tree_arr[j]);
                    if (level == id_level) {
                        console.log(level + " Print it! " + tree_arr[j]);
                        total_add(tree_arr[j]);

                    }
                }
            }
        }
        order_calc();
    </script>

</body>
</html>