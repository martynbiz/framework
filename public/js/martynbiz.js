(function() {
    
    // ** load with ajax, then pass into router. removes routers dependency on ajax
    martynbiz.router.load("/routes.php");
    
    // set links
    var _initLinks = function(container) {
        var links = container.getElementsByTagName("a");
        for(var i=0; i<links.length; i++) {
            links[i].addEventListener("click", function(e) {
                
                // **move this to bottom, for now i want to debug
                e.preventDefault(); 
                
                // get the route from the router
                var route = martynbiz.router.match( this.getAttribute("href"), "GET" );
                
                // load data and template
                if(route) {
                    var dataUrl = this.getAttribute("href"); // ajax call will request json
                    var templateUrl = "/templates/" + route["controller"] + "/" + route["action"] + ".php";
                    
                    // ** move this into load method, just pass route
                    martynbiz.dispatch.load({
                        template_url: templateUrl,
                        data_url: dataUrl
                    });
                }
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