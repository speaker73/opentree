<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Opentree</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap.min.css">--}}
            <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="bower_resources/bootstrap/dist/css/bootstrap-theme.css">--}}
    <style>
        body
        {
            background-color: #E9E3CB;
        }
        .ul-layer
        {
            background-color: #42A6DE;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            border: 1px solid #ccc;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
            padding-bottom: 20px;
        }
        .page-header
        {
            border-bottom: none;
        }
        .hidden{ display: none; }
    </style>
    
</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>Opentree <small>Company tree build and calculate</small></h1>
    </div>
    <div class="content">
        <ul class="list-group center-block" id="tree">
            @foreach($companies as $item)

                <li id="{{$item->id}}" data-name="{{$item->name}}" class="list-group-item h3 panel-success alert-info" data-parent="{{$item->parent}}"
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
                {!!"<ul class='ul-layer' id='ul_child".$item->id."'></ul>"!!}
                {{--{!!$item->parent == 2?"</ul>":""!!}--}}
            @endforeach
        </ul>
        <div class="panel panel-default">
            <div class="panel-body">
        <form action="{{ url('/add')}}" method="POST" class="form-inline" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

           
            <div class="form-group hidden">
                <label for="iput_name">id</label>
                <input type="text" class="form-control" id="input_id" placeholder="1" name="id" disabled> 
                <!-- disabled or readonly? -->
            </div>
            <div class="form-group">
                <label for="input_parent">Parent</label>
                <!-- <input type="text" class="form-control" id="input_parent" value="1" name="parent"> -->
                    <select class="form-control" id="parent-select" name="parent">  
                    </select>
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
<footer class="footer" style="background: url(//www.thewoodlandstx.com/images/footer_trees.jpg) repeat-x"; >
    <div class="container" >
<div style="height:155px;"></div>
    </div>
</footer>
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



        /*Add id from array*/
        var li_length = $('.list-group-item').length;
        var tree_arr = [];
        @foreach($companies as $item)
                tree_arr[tree_arr.length] = {{$item->id}};
        @endforeach

       

 

    </script>
    <script src="opentree.js"></script>

</body>
</html>
