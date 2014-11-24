(function() {
    
    // ** load with ajax, then pass into router. removes routers dependency on ajax
    martynbiz.router.load("/routes.php");
    
    // set links
    var _initLinks = function(container) {
        var links = container.getElementsByTagName("a");
        for(var i=0; i<links.length; i++) {
            
            // set link click event behaviour
            links[i].addEventListener("click", function(e) {
                
                // get the route from the router
                var route = martynbiz.router.match( this.getAttribute("href"), "GET" );
                
                // load data and template
                if(route) {
                    martynbiz.dispatch.load({
                        template_url: "/templates/" + route["controller"] + "/" + route["action"] + ".php",
                        data_url: this.getAttribute("href")
                    });
                }
                
                // update the browser url bar
                history.pushState({}, '', this.getAttribute("href"));
                
                e.preventDefault(); 
            }, false);
        }
    }
    
    // configure our dispatch
    martynbiz.dispatch.config('view', function(template, data) { // designed to handle two data sources 
        
        var template = Handlebars.compile(template);
        var html = template(data);
        
        container = document.getElementById("content");
        container.innerHTML = html;
        _initLinks(container);
    });
    
    _initLinks(document);
    
})();