function currentPage(obj) {
	$(obj).addClass("current_page_item");
	$(obj).siblings().removeClass("current_page_item");
	$value = $(obj).attr('value');
	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/admin/loadPageByItem",
		data: {'value' : $value},
		type:"POST",
	    dataType:"html",
		success: function(data) {
			$('#main').empty();
			$('#main').html(data);
			if ($value == 2) {
				altRows('alternatecolor');
			}
		},
		error: function(data) {
			alert("error !" );
		}
	});
}

function altRows(id){
    if(document.getElementsByTagName){  
        
        var table = document.getElementById(id);  
        var rows = table.getElementsByTagName("tr"); 
         
        for(i = 0; i < rows.length; i++){          
            if(i % 2 == 0){
                rows[i].className = "evenrowcolor";
            }else{
                rows[i].className = "oddrowcolor";
            }      
        }
    }
}

function setPrevPage(obj) {
	$page = $(obj).siblings('#page-num').text().split('/')[0];
	if ($page == 1) {

	} else {
		// alert($page - 1);
		$.ajax({
			url: "http://localhost/~maydaygjf/adlerordering/index.php/admin/loadPageUser",
			data: {'page' : parseInt($page) - 1},
			type:"POST",
		    dataType:"html",
			success: function(data) {
				// alert(data);
				$('#main').empty();
				$('#main').html(data);
				altRows('alternatecolor');
			},
			error: function(data) {
				alert("error !" );
			}
		});
	}
}

function setNextPage(obj) {
	$page = $(obj).siblings('#page-num').text().split('/')[0];
	$last_page = $(obj).siblings('#page-num').text().split('/')[1];
	if ($page == $last_page) {

	} else {
		// alert($page + 1);
		$.ajax({
			url: "http://localhost/~maydaygjf/adlerordering/index.php/admin/loadPageUser",
			data: {'page' : parseInt($page) + 1},
			type:"POST",
		    dataType:"html",
			success: function(data) {
				// alert(data);
				$('#main').empty();
				$('#main').html(data);
				altRows('alternatecolor');
			},
			error: function(data) {
				alert("error !" );
			}
		});
	}
}

function editUser(obj) {
	$(obj).parent().parent().css('background-color', 'yellow');
	$(obj).parent().next().css('display','true');
	$(obj).parent().next().next().next().css('display', 'true');
	$(obj).next('span').removeAttr("onclick");
	$(obj).removeAttr("onclick");
	$siblings = $(obj).parent().siblings();
	$siblings.each(function(index) {
		if (index <= 3) {
			$tmpval = $(this).text();
			$(this).empty();
			 var inputObj = $("<input type='text'>").css("border-width","0").width($(this).width())
            .css("background-color",$(this).css("background-color")).css('padding','0px').css('margin-bottom', '0px')
            .css('font-size', '11px')
            .val($tmpval).appendTo($(this));
		}
	});
	
}

function deleteConfirmUser(obj) {
	var $id = parseInt($(obj).parent().prev().prev().prev().prev().prev().prev().text());
	// alert($id);
	$.ajax({
			url: "http://localhost/~maydaygjf/adlerordering/index.php/admin/deleteUser",
			data: {'id': $id},
			type:"POST",
			success: function(data) {
				// alert(data);
				// alert('delete success');
			},
			error: function(data) {
				alert("delete error !" );
			}
		});
	$(obj).parent().parent().remove();
}

function deleteUser(obj) {
	$(obj).parent().parent().css('background-color', 'yellow');
	$(obj).parent().next().next().css('display','true');
	$(obj).parent().next().next().next().css('display', 'true');
	$(obj).removeAttr("onclick");
	$(obj).prev().removeAttr("onclick");
}

function confirmUser(obj) {
	$(obj).parent().parent().css('background-color', '');
	$(obj).parent().prev().find('span:first').attr('onclick', 'editUser(this)');
	$(obj).parent().css('display','none');
	$siblings = $(obj).parent().siblings();
	var $id;
	var $name;
	var $email;
	var $pw;
	$siblings.each(function(index) {
		if (index <= 3) {
			$tmpval = $(this).find('input').val();
			$(this).empty().html($tmpval);
			if (index == 0) {
				$id = parseInt($tmpval);
			}
			if (index == 1) {
				$name = $tmpval + "";
			}
			if (index ==2) {
				$email = $tmpval + "";
			}
			if (index == 3) {
				$pw = $tmpval + "";
			}
		}
		
	});
	// alert($user[3]);
	// alert($id + " " + $name + " " + $email + " " + $pw);

	$.ajax({
			url: "http://localhost/~maydaygjf/adlerordering/index.php/admin/updateUser",
			data: {'id': $id, 'name': $name, 'email': $email, 'pw': $pw},
			type:"POST",
			success: function(data) {
				// alert(data);
				// alert('success');
			},
			error: function(data) {
				alert("error !" );
			}
		});
	$(obj).parent().prev().find("span:last").attr('onclick', 'deleteUser(this)');
	$(obj).parent().next().next().css('display', 'none');
	
}



function cancel(obj) {
	if (!$(obj).parent().prev().prev().is(':hidden')) {
		$(obj).parent().siblings().each(function(index) {
		if (index <= 3) {
			$tmpval = $(this).find('input').val();
			$(this).empty().html($tmpval);
		}
		
		});
	}
	$(obj).parent().parent().css('background-color', '');
	$(obj).parent().prev().prev().prev().find('span:first').attr('onclick', 'editUser(this)');
	$(obj).parent().prev().prev().prev().find('span:last').attr('onclick', 'deleteUser(this)');
	$(obj).parent().prev().prev().css('display', 'none');
	$(obj).parent().prev().css('display', 'none');
	$(obj).parent().css('display', 'none');
}



function search() {
	$key = $('#search-user').val();
	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/admin/search",
			data: {'key': $key},
			type:"POST",
			dataType:"html",
			success: function(data) {
				// alert("success");
				if (data) {
					$('#main').empty();
					$('#main').html(data);
					altRows('alternatecolor');
				} else {
					$('#main').empty();
					$('#main').html(data);
				}
				
			},
			error: function(data) {
				alert("delete error !" );
			}
		});
}

/* used in view/overview.php */
function homebtn(obj) {
	var $num = $(obj).attr('alt');
	switch($num) {
		case "1":
			$("#menu-event")[0].click();
			break;
		case "2":

			break;
		case "3":
			$('#menu-status')[0].click();
			break;
		case "4":
			$('#menu-report')[0].click();
			break;
		case "5":

			break;
		case "6":

			break;
		case "7":

			break;
		case "8":

			break;
	}
}


function addNewItem(obj) {
	$(obj).attr('disabled','disabled');
	var a_tmp_table = document.createElement("table");
	var a_tr = document.createElement("tr");
	var a_td_btn = document.createElement("td");


	var add_btn = document.createElement("button");
	add_btn.innerHTML="Add Image";
	add_btn.setAttribute("onClick", "uploadNewItemImg();");
	a_td_btn.appendChild(add_btn);


	var a_td_img = document.createElement("td");
	var the_img = document.createElement("img");
	the_img.setAttribute("width", "128px");
	the_img.setAttribute("height", "128px");
	a_td_img.appendChild(the_img);
	a_td_img.id = "new-item-img-show";


	var a_td_input1 = document.createElement("td");
	a_td_input1.id = "new-item-number";
	var input1 = document.createElement("input");
	input1.placeholder="Stock Number";
	a_td_input1.appendChild(input1);
	var a_td_input2 = document.createElement("td");
	var input2 = document.createElement("input");
	input2.placeholder="Description";
	a_td_input2.appendChild(input2);
	a_td_input2.id = "new-item-description";
	var a_td_input3 = document.createElement("td");
	var input3 = document.createElement("input");
	input3.placeholder="Avail Qty";
	a_td_input3.appendChild(input3);
	a_td_input3.id = "new-item-aqty";
	var a_td_input4 = document.createElement("td");
	var input4 = document.createElement("input");
	input4.placeholder="Backorder Qty";
	a_td_input4.appendChild(input4);
	a_td_input4.id = "new-item-bqty";
	a_tr.appendChild(a_td_btn);
	a_tr.appendChild(a_td_img);
	a_tr.appendChild(a_td_input1);
	a_tr.appendChild(a_td_input2);
	a_tr.appendChild(a_td_input3);
	a_tr.appendChild(a_td_input4);
	a_tmp_table.appendChild(a_tr);

	a_submit_btn = document.createElement("button");
	a_submit_btn.innerHTML = "Add";
	a_submit_btn.id = "add-new-item-submit-btn";
	a_submit_btn.setAttribute("onClick", "storeNewItem(this);");
	a_cancle_btn = document.createElement("button");
	a_cancle_btn.innerHTML = "Cancel";
	a_cancle_btn.id = "cancel-new-item-btn";
	a_cancle_btn.setAttribute("onClick", "cancelNewItem(this);");

	
	$('.add-item-layer').html('<p>Add a New Item</p>').append(a_tmp_table).append(a_submit_btn).append(a_cancle_btn).toggleClass('dont-display');
}

/* used in place-order.php */
function storeNewItem(obj) {
	var $sn = $('#new-item-number').find('input').val();
	// alert($sn);
	var $description = $('#new-item-description').find('input').val();
	// alert($description);
	var $aqty = $('#new-item-aqty').find('input').val();
	// alert($aqty);
	var $bqty = $('#new-item-bqty').find('input').val();
	// alert($bqty);

	if( isEffective("tmp")) {
		$.ajax({
			type: "POST",
			url: "http://localhost/~maydaygjf/AdlerOrdering/index.php/item/renameImg",
			data: {
				'sn' : $sn,
				},
		
				success: function(data) {
					// alert(data);
				}
		});
	}

	$.ajax({
		type: "POST",
		url: "http://localhost/~maydaygjf/AdlerOrdering/index.php/item/addNewItem",
		data: {
				'sn' : $sn,
				'description' : $description,
				'aqty' : $aqty,
				'bqty' : $bqty
				},
		
		success: function(data)
		{
			$('#add-new-item').removeAttr('disabled');
			$('.add-item-layer').toggleClass('dont-display').empty();
			// add the new item to table 
			var a_tr = createItemFormat($sn, $description, $aqty, $bqty);

			$('#itemlist-header').after(a_tr);

			var table = document.getElementById("alternatecolor");  
		        var rows = table.getElementsByTagName("tr"); 
		         
		        for(i = 0; i < rows.length; i++){          
		            if(i % 2 == 0){
		                rows[i].className = "evenrowcolor";
		            }else{
		                rows[i].className = "oddrowcolor";
		            }      
		        }

		}

	})

}

function createItemFormat($sn, $description, $aqty, $bqty) {
	var a_tr = document.createElement("tr");
			var a_td_btn = document.createElement("td");
			var the_btn = document.createElement("button");
			the_btn.innerHTML = "Add/Change";
			the_btn.id = "item-change-img";
			the_btn.setAttribute('onClick', 'changeImg(this)');
			a_td_btn.appendChild(the_btn);
			a_tr.appendChild(a_td_btn);

			var a_td_img = document.createElement("td");
			var the_img = document.createElement("img");
			the_img.setAttribute('height', '128px');
			the_img.setAttribute('width', '128px');
			if (isEffective($sn)) {
				the_img.setAttribute('src', 'http://localhost/~maydaygjf/AdlerOrdering/static/images/item-images/' + $sn + '.jpg');
			} else {
				the_img.setAttribute('src', 'http://localhost/~maydaygjf/AdlerOrdering/static/images/no-img.png');
			}
			a_td_img.appendChild(the_img);
			a_tr.appendChild(a_td_img);

			a_td_text1 = document.createElement("td");
			a_td_text1.innerHTML = $sn;
			a_tr.appendChild(a_td_text1);

			a_td_text2 = document.createElement("td");
			a_td_text2.innerHTML = $description;
			a_tr.appendChild(a_td_text2);

			a_td_text3 = document.createElement("td");
			a_td_text3.innerHTML = $aqty;
			a_tr.appendChild(a_td_text3);

			a_td_text4 = document.createElement("td");
			a_td_text4.innerHTML = $bqty;
			a_tr.appendChild(a_td_text4);
	return a_tr
}

/* used in place-order.php */
function uploadNewItemImg() {
	$('.choose-item-img').toggleClass('dont-display');
}

function cancelNewItem(obj) {
	$('#add-new-item').removeAttr('disabled');
	$('.add-item-layer').toggleClass('dont-display').empty();
}

function isEffective(url) {
	url = "http://localhost/~maydaygjf/AdlerOrdering/static/images/item-images/" + url + '.jpg';
   try {
     var xmlhttp;
     if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp = new XMLHttpRequest();
     } else { // code for IE6, IE5
       xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
     xmlhttp.open("get", url, false);
     xmlhttp.send();
     if (xmlhttp.status == "404") {
       return false;
     } else {
       return true;
     }
   } catch (e) {
     return false;
   }
 }

 function changeImg(obj) {
 	var $sn = $(obj).parent().next().next().text();
 	// alert($sn);
 	$(".add-item-img").find('input[type=hidden]').val($sn);
 	$(".add-item-img").toggleClass('dont-display');
 }

 function cancleAddChange(obj) {
 	$(obj).parent().toggleClass("dont-display");
 }


 function showAvailableItem(obj) {
 	var $key = $(obj).parent().prev().children().val();
 	alert("the key is :" + $key);
 	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/item/search",
			data: {'key': $key},
			type:"POST",
			dataType:"html",
			success: function(data) {
				// alert("success");
				if (data) {
					$('#main').empty();
					$('#main').html(data);
					altRows('alternatecolor');
				} else {
					$('#main').empty();
					$('#main').html(data);
				}
				
			},
			error: function(data) {
				alert("delete error !" );
			}
		});

 }


function submit_with_time(obj) {
	var first_date = $(obj).parent().prev().prev().children().val();
	var second_date = $(obj).parent().prev().children().val();
	// alert("the key is :" + first_date);
	// alert("the key is :" + second_date);
	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/orders/searchFieldDate",
			data: {'first_date': first_date,
					'second_date': second_date},
			type:"POST",
			dataType:"html",
			success: function(data) {
				// alert(data);
				if (data) {
					$('#main').empty();
					$('#main').html(data);
					altRows('alternatecolor');
				} else {
					$('#main').empty();
					$('#main').html(data);
				}
				
			},
			error: function(data) {
				alert("delete error !" );
			}
		});
}


function submit_with_location(obj) {
	var city = $(obj).parent().prev().prev().children().val();
	var state = $(obj).parent().prev().children().children("option").filter(":selected").text();
	// alert("the key is :" + city);
	// alert("the key is :" + state);
	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/orders/searchFieldArea",
			data: {'city': city,
					'state': state},
			type:"POST",
			dataType:"html",
			success: function(data) {
				// alert(data);
				if (data) {
					$('#main').empty();
					$('#main').html(data);
					altRows('alternatecolor');
				} else {
					$('#main').empty();
					$('#main').html(data);
				}
				
			},
			error: function(data) {
				alert("delete error !" );
			}
		});
}

function submit_with_field(obj) {
	var field = $(obj).parent().prev().prev().children().find("option").filter(":selected").val();
	var key = $(obj).parent().prev().children().val();
	// alert(field);
	// alert(key);
	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/orders/searchFieldKey",
			data: {'field': field,
					'keyword': key},
			type:"POST",
			dataType:"html",
			success: function(data) {
				// alert(data);
				if (data) {
					$('#main').empty();
					$('#main').html(data);
					altRows('alternatecolor');
				} else {
					$('#main').empty();
					$('#main').html(data);
				}
				
			},
			error: function(data) {
				alert("delete error !" );
			}
		});
}

function submit_with_keyword(obj) {
	var key = $(obj).parent().prev().children().val();
	alert(key);
	$.ajax({
		url: "http://localhost/~maydaygjf/adlerordering/index.php/orders/searchFuzzy",
			data: {'key': key},
			type:"POST",
			dataType:"html",
			success: function(data) {
				// alert(data);
				if (data) {
					$('#main').empty();
					$('#main').html(data);
					altRows('alternatecolor');
				} else {
					$('#main').empty();
					$('#main').html(data);
				}
				
			},
			error: function(data) {
				alert("delete error !" );
			}
		});
}
