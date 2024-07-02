art = document.getElementById('artpart').clientHeight;
info = document.getElementById('info').clientHeight;
if (art > info) {
	culculs = art + 90;
	result = culculs + "px";
	info_div = document.getElementById('info');
	info_div.style.minHeight = result;
}