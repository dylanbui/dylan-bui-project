function rollon(a) 
{
	a.style.backgroundColor='#F0F8FF';
}	
function rolloff(a)
{
	a.style.backgroundColor='';
}
function checkall_cb(form_name,cb_name,cball_name)
{
	var cb      = document.forms[form_name].elements[cb_name];
	var cb_len  = cb.length;
	var bln_allbox = document.forms[form_name].elements[cball_name].checked;
	for (var i = 0; i < cb_len; i++) 
	{
		cb[i].checked = bln_allbox;
	}
}
function exp_res(div_id,img_name)
{
	if(div_id.style.display == "inline")
	{ 	
		div_id.style.display = "none"; 
		/*if(img_name.src == btn_min.src) img_name.src = btn_max.src;
		else img_name.src = btn_min.src;*/
	}
	else
	{ 
		div_id.style.display = "inline";
		/*if(img_name.src== btn_min.src) img_name.src = btn_max.src;
		else img_name.src = btn_min.src;*/
	};
}
function on_off(div_id)
{
	div_id.style.display = "none";
}
function go(url)
{
	parent.location = url;
}
function menu_jump(url)
{
	if (url.substring(0,5) != "")
	{
		window.location=url;
	}
	else return false;
}
function menu_submit(data,form)
{
	if (data != "")
	{ 
		form.action=document.URL;
		form.submit();
	}
	else return false;
}
function ask(url,msg)
{
	if (!confirm(msg))
	{ //do nothing
	}
	else 
	{parent.location = url;}
}