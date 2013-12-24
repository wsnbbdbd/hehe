var matrix;
common = {
	/**
	 * 动态加载js、css文件
	 * @param opts
	 * @returns
	 */
	includeFile : function(opts) {
		var defaults = {
			type : 'js', 	//js代表js文件 ， css代表css文件
			url : '',		//文件路径
			cbfunc : {},	//加载完成后回调方法
			params : {}		//回调方法所带参数
		}, myopts = $.extend({}, defaults, opts || {}), fileref = {};
		
		if(!myopts.url){
			return false;
		}
		if(myopts.type == 'js'){
		    fileref = document.createElement('script');
		    fileref.setAttribute('type', 'text/javascript');
		    fileref.setAttribute('src', myopts.url);
		}
		else{
			fileref = document.createElement("link");
		    fileref.setAttribute("rel", "stylesheet");
		    fileref.setAttribute("type", "text/css");
		    fileref.setAttribute("href", myopts.url);
		}
		
		var _doc = document.getElementsByTagName('head')[0];
	    _doc.appendChild(fileref);
	    
	    if(typeof myopts.cbfunc == 'function'){
		    if (document.all) { //如果是IE
		    	fileref.onreadystatechange = function () {
		    		if (fileref.readyState == 'loaded' || fileref.readyState == 'complete') {
		    			myopts.cbfunc(myopts.params);
		            }
		        }
		    }
		    else {
		    	fileref.onload = function () {
	    			myopts.cbfunc(myopts.params);
		        }
		    }
	    }
	    return false;
	}
}