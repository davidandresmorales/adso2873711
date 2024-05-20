var bd = true;
var ds = document.getElementById('display');
var rs = document.getElementById('result');
var dl = document.getElementById('b-del');
var dn = document.getElementById('b-dln');
var md = document.getElementById('b-mod');
var dv = document.getElementById('b-div');
var pr = document.getElementById('b-pro');
var ad = document.getElementById('b-add');
var sb = document.getElementById('b-sub');
var eq = document.getElementById('b-eql');
var cr = document.getElementById('b-crd');
var sn = document.getElementById('b-sin');
var cs = document.getElementById('b-cos');
var tn = document.getElementById('b-tan');
var sq = document.getElementById('b-sqrt');
var pi = document.getElementById('b-pi');
var ex = document.getElementById('b-exp');

var n1 = document.getElementById('n1');
var n2 = document.getElementById('n2');
var n3 = document.getElementById('n3');
var n4 = document.getElementById('n4');
var n5 = document.getElementById('n5');
var n6 = document.getElementById('n6');
var n7 = document.getElementById('n7');
var n8 = document.getElementById('n8');
var n9 = document.getElementById('n9');
var n0 = document.getElementById('n0');
var nd = document.getElementById('nd');

n1.onclick = function() { ds.value += '1'; }
n2.onclick = function() { ds.value += '2'; }
n3.onclick = function() { ds.value += '3'; }
n4.onclick = function() { ds.value += '4'; }
n5.onclick = function() { ds.value += '5'; }
n6.onclick = function() { ds.value += '6'; }
n7.onclick = function() { ds.value += '7'; }
n8.onclick = function() { ds.value += '8'; }
n9.onclick = function() { ds.value += '9'; }
n0.onclick = function() { ds.value += '0'; }
nd.onclick = function() { 
	if(bd == true) {
		ds.value += '.'; 
		bd = false;
	}
}

dl.onclick = function() { ds.value = ''; rs.value = ''; bd = true; }
dn.onclick = function() { ds.value = ds.value.slice(0, -1); }

md.onclick = function() { ds.value += '%'; bd = true; }
dv.onclick = function() { ds.value += '/'; bd = true; }
pr.onclick = function() { ds.value += '*'; bd = true; }
ad.onclick = function() { ds.value += '+'; bd = true; }
sb.onclick = function() { ds.value += '-'; bd = true; }
cr.onclick = function() { alert('Calc JS'); }

sn.onclick = function() { ds.value += 'Math.sin('; }
cs.onclick = function() { ds.value += 'Math.cos('; }
tn.onclick = function() { ds.value += 'Math.tan('; }
sq.onclick = function() { ds.value += '**(1/2)'; }
pi.onclick = function() { ds.value += 'Math.PI'; }
ex.onclick = function() { ds.value += '**'; }

eq.onclick = function() { 
	try {
		let expression = ds.value;
		// Reemplazar las funciones trigonométricas y la raíz cuadrada para evaluar correctamente
		expression = expression.replace(/Math\.sin\(([^)]+)\)/g, 'Math.sin($1 * Math.PI / 180)');
		expression = expression.replace(/Math\.cos\(([^)]+)\)/g, 'Math.cos($1 * Math.PI / 180)');
		expression = expression.replace(/Math\.tan\(([^)]+)\)/g, 'Math.tan($1 * Math.PI / 180)');
		rs.value = eval(expression);
	} catch(e) {
		rs.value = 'Error';
	}
	bd = true; 
}
