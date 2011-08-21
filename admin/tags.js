$(document).ready(function(){
$('.bb_bar a').click(function() {
var button_id = attribs = $(this).attr("alt");
button_id = button_id.replace(/\[.*\]/, '');
if (/\[.*\]/.test(attribs)) { attribs = attribs.replace(/.*\[(.*)\]/, ' $1'); } else attribs = '';
var start = '['+button_id+attribs+']';
var end = '[/'+button_id+']';
insert(start, end);
return false;
});
});
function insert(start, end) {
element = document.getElementById('text');
if (document.selection) {
element.focus();
sel = document.selection.createRange();
sel.text = start + sel.text + end;
} else if (element.selectionStart || element.selectionStart == '0') {
element.focus();
var startPos = element.selectionStart;
var endPos = element.selectionEnd;
element.value = element.value.substring(0, startPos) + start + element.value.substring(startPos, endPos) + end + element.value.substring(endPos, element.value.length);
} else {
element.value += start + end;
}
}
