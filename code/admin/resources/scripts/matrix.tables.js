matrix.tables = {
	init:function(){
		/*$('.data-table').dataTable({
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sDom": '<""l>t<"F"fp>'
		});*/
		
		$(".data-table").dataTable({
			"bJQueryUI": true,   
            "sPaginationType": "full_numbers", 
			"sDom": '<""l>t<"F"fp>',//'<”top”fli>rt<”bottom”p><”clear”>',//, 
            "bFilter":false,  
            "bSort":false,  
            "iDisplayLength": 5,  
            "bRetrieve":true,  
            "bPaginate":true,  
            "bLengthChange": false,  
            "bStateSave" :false,  
            "bServerSide": true, 
            "aoColumns": [   {"mDataProp":"id"},  
                             {"mDataProp":"name"},
							 /*{"mDataProp":"operate",  
                                 "mRender": function(data, type, full) {
                                 return '<A href="../OrderdetailsServlet?customerID='+data+'" target="_blank">订单详情</A>';}  
                             }*/
                             /*{"mDataProp":"operate",  
                                 "mRender": function(data, type, full) {
                                 return '<A href="../OrderdetailsServlet?customerID='+data+'" target="_blank">订单详情</A>';}  
                             }*/],
           "oLanguage":{  
                 "sLengthMenu": "每页显示 _MENU_ 条记录",     
                            "sZeroRecords": "没有检索到数据",     
                            "sInfo": "显示 _START_-_END_ 条数据;共有 _TOTAL_ 条记录",     
                            "sInfoEmtpy": "没有数据",     
                            "sProcessing": "正在加载数据...",     
                            "oPaginate":   
                            {     
                                "sFirst": "首页",     
                                "sPrevious": "上一页",     
                                "sNext": "下一页",     
                                "sLast": "尾页"    
                            }     
  
            },  
			"sAjaxSource" : "/default/default/page/?rand="+Math.random(),  
			/*"fnServerData" : function(sSource, aoData, fnCallback){  
			$.getJSON(  
			sSource,  
			{contractID:$("#contractID").val(),  
			customerName:encodeURI(encodeURI($("#customerName").val())),  
			customerTel:$("#customerTel").val(),
			aoData:JSON.stringify(aoData)} ,  
				function callback(data){  
					fnCallback(data);  
				});   
			}  */
		});  
		
		
		/*$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
		
		$('select').select2();
		
		$("span.icon input:checkbox, th input:checkbox").click(function() {
			var checkedStatus = this.checked;
			var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
			checkbox.each(function() {
				this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
				}
			});
		});	*/
	}	
}
$(document).ready(function(){
	matrix.tables.init();
})