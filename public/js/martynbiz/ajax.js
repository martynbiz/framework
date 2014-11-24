// JavaScript Document

// define martynbiz namespace
if(typeof martynbiz === "undefined") martynbiz = {};

// ajax module
martynbiz.ajax = function() {
	
	// cache object
	var _Cache = function() {
		var _cache = {};
		return {
			get: function(url) {
				return (url !== undefined) ? _cache[url] : _cache; // if url not given, return full cache (for debugging)
			},
			insert: function(url, data) {
				_cache[url] = data;
				return _cache[url]
			},
			empty: function() {
			  _cache = {};
			  return _cache
			}
		};
	}();
	
	// prepare the data depending on what dataType is (e.g. JSON)
	function _prepareData(data, dataType) {
		switch(dataType.toUpperCase()) {
		  case "JSON":
		    data = JSON.parse(data);
		    break;
		}
		return data;
	}
	
	// return public properties and 
	return _this = {
		options: {},
		
		cache: _Cache,
		
		fetch: function(options) {
			
			// default options
			defaults = {
				success: function() {},
				cache: false,
				method: "GET",
				dataType: "text",
				data: null
			};
			options = function() {
				var new_options = {};
				for(var i=0; i<arguments.length; i++) {
					for(var name in arguments[i]) { new_options[name] = arguments[i][name] }
				}
				return new_options;
			}(defaults, options);
			
			// check cache
			if(options.cache && _Cache.get(options.url)) {
				options.success(_prepareData(_Cache.get(options.url), options.dataType), options.dataType);
				return true;
			}
			
			// make ajax call
			var xmlhttp;
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp = new XMLHttpRequest();
			} else {// code for IE6, IE5
		  	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  }
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					_Cache.insert(options.url, xmlhttp.responseText, options.dataType);
					options.success(_prepareData(xmlhttp.responseText, options.dataType));
				}
			}
			xmlhttp.open(options.method.toUpperCase(), options.url, true);
			if(options.method.toUpperCase() === 'POST') {
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				var data = function(data) {
					var pairs = [];
					for(var name in data) {
						pairs.push(name+"="+data[name]);
					}
					return pairs.join("&");
				}(options.data);
				xmlhttp.send(data);
			} else {
				xmlhttp.send();	
			}
			
		}
	}
	
}();
