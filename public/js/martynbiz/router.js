// JavaScript Document

// define martynbiz namespace
if(typeof martynbiz === "undefined") martynbiz = {};

// ajax module
martynbiz.router = function(ajax) {
    
    /**
    * Our routes loaded from the server
    */
    var _routes;
    
    
    //methods
    
    /**
    * Load the routes
    */
    var _load = function(url) {
        
        // 
        ajax.fetch({
            url: "/routes.php",
            useCache: true,
            dataType: "json",
            success: function(data) {
                _routes = data;
            }
        });
    }
    
    /**
    * Match a route with a url
    */
    var _match = function(url, method, config, pattern, result) {
        
        //set default
        if (! method) method = "GET";
        if (! pattern) pattern = "";
        if (! config) config = _routes;
        
        for(var key in config) {
            
            // all pattern level object keys begin with "/...". the script will
            // assume that the next level keys will be methods (e.g. GET, POST)
            if(key.charAt(0) === '/') {
                
                // we will dig deeper, as we're not done yet. in the next recursion we will
                // obtain the method and do a comparison
                result = _match(url, method, config[key], pattern+key, result);
                
            } else {
                
                // right trim pattern and url
                pattern = pattern.replace(/\/+$/, "");
                
                // compare the pattern and the url
                var re = new RegExp("^" + pattern + "$");
                var params = re.exec(url);
                
                // this is the only time that 
                if(params) {
                    params.shift() // we don't need the string
                    result = config[key];
                    result.params = params
                }
            }
        }
        
        return result;
    }
    
    
    // return public properties and 
    return _this = { // _this allows us to 
        
        /**
        * Load the routes
        */
        load: _load,
        
        /**
        * Match a route with a url
        */
        match: _match
    }
}(martynbiz.ajax);