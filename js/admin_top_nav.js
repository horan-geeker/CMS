function admin_top_nav(num){
	for(var i=1;i<5;i++){
		document.getElementById("nav"+i).style.backgroundPosition='left bottom';
		document.getElementById("nav"+i).style.color='#fff';
	}
	document.getElementById("nav"+num).style.backgroundPosition='right bottom';
	document.getElementById("nav"+num).style.color='#3b6ea5';
}