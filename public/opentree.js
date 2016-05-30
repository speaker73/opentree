/**
 * Created by User on 26.05.2016.
 */
 (function(){ 
  function parentselctor(){
           if(tree_arr.length === 0){
            $("#parent-select").append("<option value='1'>1</option>");
           } else {
                for(i=0;i<tree_arr.length;i++) {
                    var parent_input = tree_arr[i];
                    var input_name = $('#' + tree_arr[i]).attr('data-name')
                    $("#parent-select").append("<option value='"+ parent_input +"'>"+parent_input+". "+input_name+"</option>");
                }
            }
        }
        parentselctor(); 
function tree_builder() {
    var timeParadox = 0;
    for (var i = 0; i < li_length; i++) {
    	var parent = Number($('#' + tree_arr[i]).attr('data-parent'));
        	if (tree_arr[i] != parent) {
            $("#" + tree_arr[i])
                .appendTo("#ul_child" + parent);
            $("#ul_child" + tree_arr[i])
                .appendTo("#ul_child" + parent);
        }
    }
}
//tree_builder();
function tree_builder2(){
	var timeParadox = 0;
    for (var i = 0; i < li_length; i++) {
		var parent = Number($('#' + tree_arr[i]).attr('data-parent'));
    	var company = {
    		paradox:0    		
    	}
    		company.parent2=Number($('#' + tree_arr[i]).attr('data-parent'));
    		company.id2=tree_arr[i];
    		company.id=tree_arr[i];
    		company.parent=Number($('#' + tree_arr[i]).attr('data-parent'));
    		company.level=Number($('#' + tree_arr[i] ).attr('data-level'));
    		company.parent1=Number($('#' + company.parent2).attr('data-parent'));
    		company.id1=Number($('#' + company.parent2).attr('id'));
    		//console.log("id1="+company.id1+" parent2="+company.parent2+" parent1=" + company.parent1+" id2="+company.id2+" level="+company.level);
    	//if(company.id2 != company.parent1){
    	for (var k = 0; k < max_level; k++) {
			if(company.parent1===company.id&&company.parent2===company.id1&&tree_arr[i] != parent){
            	timeParadox = timeParadox + 1;
            	if(timeParadox<=1){
            		$("#tree").append("<ul class='time-paradox alert alert-danger'>Oops! You have a time-paradox! In the future that is a partners group. But not this time. Calculate is not true.</ul>");
            	}
            	company.paradox=1;
                $("#" + company.id)
                    .appendTo(".time-paradox");
                $("#ul_child" + company.id)
                    .appendTo(".time-paradox");
                    console.log("find time-paradox from id="+company.id);
        	}else{
        		console.log("none time-paradox from id="+company.id);
        		company.id2 = company.id1;
        		company.parent2 = company.parent1;
        		company.parent1=Number($('#' + company.parent2).attr('data-parent'));
    			company.id1=Number($('#' + company.parent2).attr('id'));
        	}
    	//}
    	}
    	 if (tree_arr[i] != parent&&company.paradox==0) {
            $("#" + tree_arr[i])
                .appendTo("#ul_child" + parent);
            $("#ul_child" + tree_arr[i])
                .appendTo("#ul_child" + parent);
        }
    }
}

/*Edit form*/
function add_value() {
    var number = null;
    if (li_length == 0) {
        number = 1;
    } else {
        number = tree_arr[tree_arr.length - 1] + 1;
    }
    /*$("#input_parent").attr("value", number);*/
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
var max_level = Math.max.apply(Math, level_arr);
tree_builder2();
function sortDown(a, b) {
    if (a < b) return 1;
    if (a > b) return -1;
}
level_arr.sort(sortDown);

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

})(); 
