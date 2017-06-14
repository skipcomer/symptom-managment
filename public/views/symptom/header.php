<body>

<!-- hide the top logo
<header>
	<div id="header-line2">
	<span id="burdette" onClick="javascript:get_page('_001');" style="cursor:pointer;cursor:hand;" );">The Portal</span>
	<span id="header_text">Information, Resources, and Tools for People Dealing with Cancer</span>
	</div>
</header>  -->

<script>
window.addEventListener("load", function(){
    if(window.self === window.top) return; // if w.self === w.top, we are not in an iframe 
    send_height_to_parent_function = function(){
        var height = document.getElementsByTagName("body")[0].clientHeight;
        //console.log("Sending height as " + height + "px");
        parent.postMessage({"height" : height }, "*");
    }
    // send message to parent about height updates
    send_height_to_parent_function(); // whenever the page is loaded
    window.addEventListener("resize", send_height_to_parent_function); // whenever the page is resized
    var observer = new MutationObserver(send_height_to_parent_function);           // whenever DOM changes PT1
    var config = { attributes: true, childList: true, characterData: true, subtree:true}; // PT2
    observer.observe(window.document, config);                                            // PT3 
});
</script>