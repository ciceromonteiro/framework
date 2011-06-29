var wwwroot = "http://localhost/engine";
var webroot = wwwroot+"/webroot";

function gE(ID)
{
	return document.getElementById(ID);
}

function gT(ID)
{
	return document.getElementsByTagName(ID);
}

function openAjax() {
	var ajax;
	try {
			ajax = new XMLHttpRequest();
	} catch(ee) {
			try {
					ajax = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
					try {
							ajax = new ActiveXObject("Microsoft.XMLHTTP");
					} catch(E) {
							ajax = false;
					}
			}
	}
	return ajax;
}

function validates_presence_of(ID)
{
	if (gE(ID).className.indexOf("short") != -1)
	{
		gE(ID).className += " empty short";
	}
	else
	{
		gE(ID).className += " empty";
	}
}

function show(ID)
{
	gE(ID).style.display = "block";
	return false;
}

function hide(ID)
{
	gE(ID).style.display = "none";
	return false;
}

function toggle(ID)
{
	if (gE(ID).style.display == "none")
	{
		show(ID);
	}
	else
	{
		hide(ID);
	}
}

function set_value(ID, vlw)
{
	gE(ID).value = vlw;
	return false;
}

function choose()
{
	var id = gE('chs').value;
	$.colorbox({
		href:""+wwwroot+"/app/views/_ajax/users.choose.php?id="+id,
		title: "Provedor escolhido com sucesso"
	});
}

function change_provider()
{
	$.colorbox({
		overlayClose : false,
		escKey: false,
		href:""+wwwroot+"/app/views/_ajax/users.choose.php",
		title: "Escolha o provedor"
	});
}

//Formata número tipo moeda usando o evento onKeyUp

function Limpar(valor, validos) {
	// retira caracteres invalidos da string
	var result = "";
	var aux;
	for (var i=0; i < valor.length; i++)
	{
		aux = validos.indexOf(valor.substring(i, i+1));
		if (aux>=0)
		{
			result += aux;
		}
	}
	return result;
}

function mask(campo, teclapres) {
	var tecla = teclapres.keyCode;
	vr = Limpar(campo.value,"0123456789");
	tam = vr.length;
	dec = 2;

	/*if (tam < tammax && tecla != 8)
	{
		stam = vr.length + 1;
	}*/

	if (tecla == 8 ){ tam = tam - 1 ; }

	if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105)
	{

	if ( tam <= dec )
	{ campo.value = vr ; }
	if ( (tam > dec) && (tam <= 5) ){
	campo.value = vr.substr( 0, tam - 2 ) + "," + vr.substr( tam - dec, tam ) ; }
	if ( (tam >= 6) && (tam <= 8) ){
	campo.value = vr.substr( 0, tam - 5 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ;
	}
	if ( (tam >= 9) && (tam <= 11) ){
	campo.value = vr.substr( 0, tam - 8 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
	if ( (tam >= 12) && (tam <= 14) ){
	campo.value = vr.substr( 0, tam - 11 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - dec, tam ) ; }
	if ( (tam >= 15) && (tam <= 17) ){
	campo.value = vr.substr( 0, tam - 14 ) + "." + vr.substr( tam - 14, 3 ) + "." + vr.substr( tam - 11, 3 ) + "." + vr.substr( tam - 8, 3 ) + "." + vr.substr( tam - 5, 3 ) + "," + vr.substr( tam - 2, tam ) ;}
	}
}

var count = 0;
function add_phone()
{
    var container = gE('phones_container');
    var content = gE('phones_info').innerHTML;
    var div = document.createElement('div');
    div.setAttribute('class','span-25');
    div.setAttribute('id','phones_info_'+count);
    div.innerHTML = content;
    container.appendChild(div);
    count++;
    return true;
}

var count = 0;
function del_product(ID)
{
	var table = gE('products_table');
	var container = table.getElementsByTagName('tbody')[0];
	var child = gE('tr_'+ID);
	container.removeChild(child);
	return false;
}
function add_product(ID, name)
{
	var table = gE('products_table');
	var container = table.getElementsByTagName('tbody')[0];
	// creates row
	var row = document.createElement('tr');
	// creates cells
	var cell_prd = document.createElement('td');
	var cell_qtd = document.createElement('td');
	var cell_vlw = document.createElement('td');
	var cell_del = document.createElement('td');
	// creates fields and objects
	var prd = document.createElement('input');
	prd.setAttribute('type', 'hidden');
	prd.setAttribute('name', 'prd[]');
	prd.setAttribute('value', ID);
	var qtd = document.createElement('input');
	qtd.setAttribute('type', 'text');
	qtd.setAttribute('class', 'text');
	qtd.setAttribute('style', 'width: 40px;');
	qtd.setAttribute('name', 'qtd[]');
	var vlw = document.createElement('input');
	vlw.setAttribute('type', 'text');
	vlw.setAttribute('class', 'text');
	vlw.setAttribute('style', 'width: 80px;');
	vlw.setAttribute('name', 'vlw[]');
	vlw.setAttribute('id', 'input_'+ID);
	vlw.setAttribute('onkeyup', 'mask(this, event);');
	var del = document.createElement('a');
	del.setAttribute('href', 'javascript:void(0);');
	del.setAttribute('onclick', "del_product("+count+");");
	del.innerHTML = "<img src=\""+webroot+"/img/01.png\" alt=\"Excluir\" />";
	// sets attributes
	row.setAttribute('id','tr_'+count);
	cell_prd.setAttribute('id','prd_td_'+count);
	cell_del.setAttribute('class','align-center');
	// puts everything in its right place
	cell_prd.appendChild(prd);
	cell_qtd.appendChild(qtd);
	cell_vlw.appendChild(vlw);
	cell_del.appendChild(del);
	cell_prd.innerHTML += name;
	row.appendChild(cell_prd);
	row.appendChild(cell_qtd);
	row.appendChild(cell_vlw);
	row.appendChild(cell_del);
	container.appendChild(row);
	// increments counter
	count++;
	$.colorbox.close();
	return false;
}

/* lightbox and ajax search */

function loading(cnt)
{
	var img = webroot+"/img/43.gif";
	gE(cnt).innerHTML = "<img src=\""+img+"\" alt=\"Carregando...\" />";
	return false;
}

// disable lightbox by pressing ESC key
$(document).bind('keydown',function(e){
	if (e.keyCode == 27)
	{
		lightbox(false);
	}
});

function lightbox(op)
{
	var container = document.getElementsByTagName('body')[0];
	if (op)
	{
		// cretes the overlay
		var overlay = document.createElement('div');
		overlay.setAttribute('id', 'ajax_bg');
		overlay.setAttribute('class', 'black_overlay');
		overlay.setAttribute('onclick', 'lightbox(false)');
		// creates the white div
		var content = document.createElement('div');
		content.setAttribute('id', 'ajax_content');
		content.setAttribute('class', 'white_content');
		// puts the elements into page body
		container.appendChild(content);
		container.appendChild(overlay);
	}
	else
	{
		var overlay = gE('ajax_bg');
		var content = gE('ajax_content');
		container.removeChild(content);
		container.removeChild(overlay);
	}
	return false;
}

function search_for(op)
{
	lightbox(true);
	var page = wwwroot+"/app/views/_ajax/"+op;
	if (ajax = openAjax())
	{
		loading('ajax_content');
		try{
			ajax.open('GET', page, true);
			ajax.onreadystatechange = function()
			{
				if(ajax.readyState == 4)
				{
					gE('ajax_content').innerHTML = ajax.responseText;
					gE('q').focus();
				}
			}
			ajax.send(null);
		}
		catch(err)
		{
			alert('Desculpe. Algo deu errado no processamento da página. Entre com contato com o suporte.');
		}
	}
	else
	{
		alert('Desculpe. Houve um erro na requsição do ajax. Contate o suporte.');
	}
}

function search(t, e, url)
{
	var vlw = t.value;
	var page = wwwroot+"/app/views/_ajax/"+url+"?q="+vlw;
	// when user press ENTER
	// it allows empty searches
	if ((e.keyCode == 13))
	{
		if (ajax = openAjax())
		{
			loading('output');
			ajax.open('GET', page, true);
			ajax.onreadystatechange = function()
			{
				if(ajax.readyState == 4)
				{
					gE('output').innerHTML = ajax.responseText;
				}
			}
			ajax.send(null);
		}
	}
}

function cpf_cnpj(t)
{
	// cpf
	if (t.value == 0)
	{
		gE('cnpj').disabled = 'disabled';
		gE('cpf').disabled = '';
	}
	// cpnj
	else if (t.value == 1)
	{
		gE('cpf').disabled = 'disabled';
		gE('cnpj').disabled = '';
	}
	return false;
}