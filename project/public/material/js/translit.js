var Translit = new function()
{
	var ru_str = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя1234567890 -_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZÅÄÖÉåäöé";
	var en_str = ['a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t',
		'u','f','h','c','ch','sh','shh','','i','i','je','ju',
		'ja','a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f',
		'h','c','ch','sh','shh','','i','i','je','ju','ja',
		// Поле букв
		1,2,3,4,5,6,7,8,9,0,
		// После цифр
		'-','-','_',
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u',
		'v', 'w', 'x', 'y', 'z',
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U',
		'V', 'W', 'X', 'Y', 'Z', 'A', 'A', 'O', 'E', 'a', 'a', 'o', 'e'];
	var el = this;
	var toLower = false;

	this.get = function(org_str) {
		var tmp_str = "";
		for(var i = 0, l = org_str.length; i < l; i++) {
			var result = org_str.charAt(i);
			var n = ru_str.indexOf(result);
			if(n >= 0) { tmp_str += en_str[n]; }
			//else { tmp_str += result; }
		}

		if (toLower){
			tmp_str = tmp_str.toLowerCase();
		}

		return tmp_str;
	}



	this.set = function(selector1, selector2){
		if ($(selector1).length === 0 || $(selector2).length === 0) return;

		$(selector1).keyup(function(){
			if ($(selector2).length > 0 && !$(selector2)[0].disabled &&
				(!$(selector2).attr('readonly')) ){
				$string = el.get(this.value);
				if (toLower){
					$string = $string.toLowerCase();
				}
				$(selector2).val($string);
			}
		});
	}
	this.setToLower = function(lower){
		toLower = lower;
	}
}
