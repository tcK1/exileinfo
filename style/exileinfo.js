// Clear the load image
function start_load(){
	parent.document.getElementById("loading").innerHTML='<p class="text-center"><img src="gif.gif" class="img-responsive"></p>';
}
// Clear the load image
function end_load(){
	parent.document.getElementById("loading").innerHTML='';
}
// Show full graph
function resizeIframe(obj) {
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}
