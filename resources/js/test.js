$(function() {
	$(".datepicker").datepicker({dateFormat: "yy-mm-dd"});
	
	$("#sendcomment").click(function() {
		var tourl = window.location.href + "/storecomment";
		var comments_content = $("#comments_content").val();
		$("#comments_content").val("");
		$.ajax({
			type : 'get',
			url : tourl,
			data : {
				'comments_content' : comments_content,
			},
		});
	});

	$("#submitsearch").click(function() {
		value = $("#searchkeyword").val();
		var checkBox = document.getElementById("partial");
		var isPartial = checkBox.checked ? true : false;
		var searchway = document.getElementById("searchselect");
		searchway = searchway.options[searchway.selectedIndex].text;
		$.ajax({
			type : 'get',
			url : 'http://localhost:8000/search',
			data : {
				'keyword' : value,
				'isPartial' : isPartial,
				'searchway' : searchway
			},
			success : function(data) {
				var index = data.indexOf('</p>') + 4;
				var summary = data.substring(0, index);
				var tabledata = data.substring(index);
				$("#summary").html(summary);
				$("#idea-results").html(tabledata);
			}
		});
	});

});