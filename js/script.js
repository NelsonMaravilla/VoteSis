// JavaScript Document
 function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("list").innerHTML = ['<img class="thumb img-responsive img-thumbnail" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
						 document.getElementById("list_2").style.display = 'none';
						};
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('files').addEventListener('change', archivo, false);

function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
document.tree.miSelect.options[indice].text
}
var patron = new Array(2,2,4)
var patron2 = new Array(1,3,3,3,3)
var patron3 = new Array(8,1)
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
  val = d.value
  largo = val.length
  val = val.split(sep)
  val2 = ''
  for(r=0;r<val.length;r++){
    val2 += val[r]  
  }
  if(nums){
    for(z=0;z<val2.length;z++){
      if(isNaN(val2.charAt(z))){
        letra = new RegExp(val2.charAt(z),"g")
        val2 = val2.replace(letra,"")
      }
    }
  }
  val = ''
  val3 = new Array()
  for(s=0; s<pat.length; s++){
    val3[s] = val2.substring(0,pat[s])
    val2 = val2.substr(pat[s])
  }
  for(q=0;q<val3.length; q++){
    if(q ==0){
      val = val3[q]
    }
    else{
      if(val3[q] != ""){
        val += sep + val3[q]
        }
    }
  }
  d.value = val
  d.valant = val
  }
}
//funciones para coalicion
function mostrar(id) {
	if (id == "1") {
		$("#demo1").show();
		$("#demo2").show();
	}
	
	if (id == "2") {
		$("#demo1").show();
		$("#demo2").hide();
	}
	
	if (id == "3") {
		$("#demo1").hide();
		$("#demo2").hide();
	}
}

//funciones para verificar partidos
function mostrar_par(id) {
	if (id == "1") {
		$("#demo1").show();
		$("#demo2").show();
	}
	
	if (id == "2") {
		$("#demo1").show();
		$("#demo2").hide();
	}
	
	if (id == "3") {
		$("#demo1").hide();
		$("#demo2").hide();
	}
}