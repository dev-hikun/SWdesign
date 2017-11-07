/**
 * HanMi Name Space
 */
var HM = HM || {};

/**
 * 怨듯넻 UTIL
 * @param HM
 * @param jQuery
 */
(function(HM, $){
	
	var util = HM.util || {};
	
	/**
	 * Window媛� �대뼡 �뺤떇�쇰줈 �대젮�덈뒗吏� 泥댄겕�댁꽌 諛섑솚 
	 * util.checkOpenFunction
	 * @param option
	 * 
	 * ex)
	HM.util.checkOpenFunction({
		popup : function(param) {
			window.opener.${callback}(param);
			console.log(param);
		},
		iframe : function(param) {
			window.parent.${callback}(param);
		},
		normal : func,
		param : param
	});
	 */
	util.checkOpenFunction = function(option){

		var defaultOption = {
				popup : function(param){
					// Window.open�� 寃쎌슦 
					// 湲곕낯�곸쑝濡� callback�대씪�� function�쇰줈 �ㅼ젙
					window.opener.callback(param);
				},
				iframe : function(param){
					// iFrame�� 寃쎌슦
					window.parent.callback(param);
				},
				normal : function(param){
					// �쇰컲 �섏씠吏�濡� �댁뿀�� 寃쎌슦
					//console.log(param);
				},
				param : {}
		};
		var opt = $.extend(defaultOption, option);
		
		var param = opt.param;
		if (window.opener != null) {
			opt.popup(param);
		} else if (window.location != window.parent.location) {
			opt.iframe(param);
		} else {
			opt.normal(param);
		}
		
	}
	
	/**
	 * �덈룄�곗갹 �リ린
	 * util.popupClose();
	 */
	util.popupClose = function(){
		window.close();
	}
	
	/**
	 * String�쇰줈 �섏뼱�덈뒗 �⑥닔紐낆쓣 �ㅽ뻾�� �� �덈룄濡� Function 諛섑솚
	 * - windowMessage濡� �섏뼱�� �몄닔 以묒뿉�� Function�� 李얠븘�� �ㅽ뻾
	 */
	util.executeFunctionByName = function(functionName, context /*, args */) {
		try {
			var args = [].slice.call(arguments).splice(2);
			var namespaces = functionName.split(".");
			var func = namespaces.pop();
			for(var i = 0; i < namespaces.length; i++) {
				context = context[namespaces[i]];
			}
			return context[func];
		} catch (e) {
			return functionName;
		}
	}
	
	/**
	 * inputbox�� �몄옄由� ,(肄ㅻ쭏) 李띿뼱二쇰뒗 �ㅽ겕由쏀듃
	 * - focus媛� �ㅼ뼱�ㅻ㈃ 肄ㅻ쭏 ��젣
	 * - focus �섍�硫� 肄ㅻ쭏 異붽� 
	 * util.setCommaInput("CSS Selector");
	 */
	util.setCommaInput = function(selector, onlyNumber) {
		$(document).on("focus.setComma", selector, function(){
			var v = $(this).val();
			if ( onlyNumber == "Y" || onlyNumber === true ) {
				v = v.replace(/[^0-9]/gi, "");
			}
			$(this).val(util.setRemoveComma(v));
		}).on("blur.setComma", selector, function(){
			var v = $(this).val();
			if ( onlyNumber == "Y" || onlyNumber === true ) {
				v = v.replace(/[^0-9]/gi, "");
			}
			$(this).val(util.setComma(v));
		});
		$(selector).each(function(){
			$(this).val(util.setComma($(this).val()));
		});
	}

	/**
	 * �좏깮�� inputbox 肄ㅻ쭏 �쇨큵 ��젣
	 * util.setRemoveCommaInput("CSS Selector");
	 */
	util.setRemoveCommaInput = function(selector) {
		$(selector).each(function(){
			$(this).val(util.setRemoveComma($(this).val()));
		});
	}
	
	/**
	 * �レ옄�� ,(肄ㅻ쭏) 李띿뼱�� 諛섑솚
	 * util.setComma("10000");
	 * => "10,000"
	 */
	util.setComma = function(num) {
		var price = num;
        var reg = /(^[+-]?\d+)(\d{3})/;
        price += "";
        while (reg.test(price))
            price = price.replace(reg, "$1" + "," + "$2");
        return price;
	}
	
	/**
	 * �レ옄�� ,(肄ㅻ쭏) ��젣 �� 諛섑솚
	 * util.setRemoveComma("-10,000");
	 * => "-10000"
	 */
	util.setRemoveComma = function(num) {
		return num.split(",").join("");
	}
	
	/**
	 * 怨듬갚 �쒓굅媛� 諛섑솚
	 * util.trim("   S   ");
	 * => "S"
	 */
	util.trim = function(s) {
		if ( typeof s === "string" ) {
			return s.replace(/^\s+|\s+$/gi,"");
		} else {
			return s;
		}
	}
	
	/**
	 * Global WindowMessage 蹂��� �좎뼵
	 */
	util.windowMessageFunction;
	
	/**
	 * Input, Textarea, select (Form媛�) Validation 泥댄겕
	 * @param $w - 媛먯떥怨� �덈뒗 �곸뿭�� jQuery �곸뿭�쇰줈 吏���
	 * 
	 * 媛� �쒓렇�먯꽌 data �띿꽦�� 吏��뺥븯硫� 洹� �듭뀡�� 留욎떠�� Validation �섎뒗 �뺤떇
	 * 
	 * data-valid = "Y" : Validation 吏���
	 * data-valid-default = "1000" : 媛믪씠 �놁쓣 寃쎌슦 湲곕낯 媛믪쑝濡� "1000"�� 吏���
	 * data-valid-notnull = "Y" : �꾩닔媛� 泥댄겕
	 * data-valid-msg = "鍮� 媛믪쓣 �ｌ뼱二쇱꽭��." : validation�� �ㅽ뙣�덉쓣 寃쎌슦 硫붿떆吏�
	 * 
	 * HM.util.validation($("#main"));
	 * => Validation �깃났�� : return true
	 * => Validation �ㅽ뙣�� : alert, focus, return false
	 */
	util.validation = function($w) {
		
		var rtnBool = true;
		
		if ( $w == undefined ) {
			$w = $(document);
		}
		
		// data-valid
		// data-valid-default
		// data-valid-msg
		// data-valid-type
		// data-valid-notnull

		$w.find("input[data-valid],textarea[data-valid],select[data-valid]").each(function(){
			
			var $t = $(this);
			var t_val = util.trim($t.val());
			
			// data-valid-default
			if ( $t.attr("data-valid-default") != undefined && t_val == "" ) {
				$t.val($t.attr("data-valid-default"));
			}
			
			// valid-notnull
			if ( $t.attr("data-valid-notnull") != undefined && $t.attr("data-valid-notnull").toLowerCase() == "y" ) {

				// 泥댄겕諛뺤뒪�� 寃쎌슦
				if ( $t.attr("type") == "checkbox" ) {
					t_val = $("[name='" + $t.attr("name") + "']:checked").val()
				}
				
				// 媛� 泥댄겕
				if ( t_val == "" || t_val == undefined ) {
					var errMsg = $t.attr("data-valid-msg");
					if ( errMsg == undefined ) {
						$label = $w.find("[for='" + $(this).attr("id") + "']");
						if ( $label.length > 0 ) {
							errMsg = $label.text() + " �낅젰�섏떆湲� 諛붾엻�덈떎.";
						} else {
							errMsg = "鍮덉뭏�� �낅젰�섏떆湲� 諛붾엻�덈떎.";
						}
					}
					alert(errMsg);
					$(this).focus();
					rtnBool = false;
					return false;
				}
				
			}
			
		});
		
		return rtnBool;
	}
	
	/**
	 * 怨듬갚 泥댄겕�댁꽌 媛믪씠 �놁쑝硫� Check-Focus-Alert
	 * (媛쒕퀎濡� 泥댄겕�좊븣 �ъ슜)
	 * 
	 * util.validation.cfa($��寃�, Alert 硫붿꽭吏�)
	 * @return Validation �깃났 �щ�
	 */
	util.validation.cfa = function($t, msg) {
		var t_val = util.trim( $t.val() );
		if ( t_val == "" || $t.val() == undefined || $t.val() == null ) {
			$t.focus();
			if ( typeof msg !== "undefined" ) {
				alert(msg);
			}
			return false;
		}
		return true;
	}
	
	/**
	 * 怨듬갚 泥댄겕�댁꽌 媛믪씠 �놁쑝硫� false 由ы꽩
	 * (媛쒕퀎濡� 泥댄겕�좊븣 �ъ슜)
	 * 
	 * util.validation.isEmpty($��寃�)
	 * @return Validation �깃났 �щ�
	 */
	util.validation.isEmpty = function($t) {
		var t_val = util.trim( $t.val() );
		if ( t_val == "" || $t.val() == undefined || $t.val() == null ) {
			return false;
		}
		return true;
	}
	/**
	 * 留ㅺ컻蹂��� nullId, nullName�� 諛곗뿴濡� �낅젰
	 * 
	 * nullId �� �꾨뱶 ID 媛� (�� id="�좊땲�ш컪")
	 * nullName �� �꾨뱶 �대쫫
	 * 
	 * ��) var nullId = ["testId1","testId2","testId3"];
	 *     var nullName = ["�뚯뒪�몄븘�대뵒1","�뚯뒪�몄븘�대뵒2","�뚯뒪�몄븘�대뵒3"];
	 *     
	 *     @return true/false
	 */
	util.validation.checkForm = function(nullId,nullName){
		var nullCheck = function(id){
			if($("#"+id).length > 0){
				if($("#"+id).val() == ""){
					return false;
				}
			}else{
				alert($("input[name=" + id + "]").val());
				if($("input[name=" + id + "]").val() == ""){
					return false;
				} 
			}
		}
		for(var s in nullId){
			if(nullCheck(nullId[s]) == false){
				alert(nullName[s] + "��(瑜�) �뺤씤�댁＜�몄슂.");	
				$("#"+nullId[s]).focus();
				return false;
			}
		}
		return true;
	}
	
	
	
	
	/**
	 * 荑좏궎媛� 諛섑솚
	 * 
	 * util.getCookie("荑좏궎紐�");
	 * @return 荑좏궎媛�
	 */
	util.getCookie = function(name) {
		var start = document.cookie.indexOf( name + "=" );
		var len = start + name.length + 1;
		
		if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {
			return null;
		}
		
		if ( start == -1 ) return null;
		
		var end = document.cookie.indexOf( ';', len );
		if ( end == -1 ) end = document.cookie.length;
		return unescape( document.cookie.substring( len, end ) );
	}

	/**
	 * 荑좏궎媛� �ㅼ젙
	 * 
	 * util.setCookie("荑좏궎紐�", 荑좏궎媛�, �좏슚湲곌컙, path, �꾨찓��, 蹂댁븞);
	 */
	util.setCookie = function( name, value, expires, path, domain, secure ) {
		
		var today = new Date();
		today.setTime( today.getTime() );
		
		if ( typeof expires === "string" ) {
			// �좏슚湲곌컙�� String���낆쑝濡� 0�� 寃쎌슦 �뱀씪 24:00�쒓퉴吏�留�
			if ( expires == "0" ) {
				var targetDay = new Date();
				targetDay.setTime( today.getTime() + (1000 * 60 * 60 * 24) );
				targetDay.setHours(0)
				targetDay.setMinutes(0)
				targetDay.setSeconds(0)
				targetDay.setMilliseconds(0)
				
				expires = targetDay.getTime() - today.getTime();
			// 洹� �� String ���낆� 洹몃�濡� �� 蹂��섑빐�� +
			} else {
				expires = parseInt(expires);
			}
		} else if ( expires ) {
			expires = parseInt(expires) * 1000 * 60 * 60 * 24;
		} else {
			expires = 1000 * 60 * 60 * 24;
		}
		
		//domain = ( domain ) ? domain : ".hmp.co.kr";

		var expires_date = new Date( today.getTime() + (expires) );
		document.cookie = name+'='+escape( value ) +
			( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
			( ( path ) ? ';path=' + path : '' ) + 
			( ( domain ) ? ';domain=' + domain : '' ) +
			( ( secure ) ? ';secure' : '' );
		
		
	}
	
	/**
	 * 荑좏궎媛� ��젣
	 * 
	 * util.deleteCookie("荑좏궎紐�")
	 */
	util.deleteCookie = function( name ) {
		util.setCookie(name, "", -1);
	}
	
	/**
	 * 濡쒕뵫 �곸뿭 蹂댁씠湲�/�④린湲�
	 * 
	 * HM.util.loading( $(�곸뿭) ); : 湲곕낯 �숈옉 / �좉� / 理쒖큹 �좎뼵�쒕뒗 �닿린
	 * - HM.util.loading.show( $(�곸뿭) ); : 濡쒕뵫 �닿린
	 * - HM.util.loading.hide( $(�곸뿭) ); : 濡쒕뵫 �④린湲�
	 * HM.util.loading( $(�곸뿭), true/false ); : 濡쒕뵫�붾㈃�� (true - 蹂닿린 / false - 媛먯텛湲�)
	 * HM.util.loading( true/false ); : 湲곕낯 濡쒕뵫�붾㈃�� (true - 蹂닿린 / false - 媛먯텛湲�)
	 * HM.util.loading(); : 湲곕낯 濡쒕뵫�붾㈃�� Toggle
	 * 湲곕낯 濡쒕뵫�붾㈃ �꾩튂
	 * - #container
	 * - 留뚯빟 �놁쑝硫� .container
	 * - 留뚯빟 �놁쑝硫� body 濡� �ㅼ젙, document 以묎컙�� �꾩튂.
	 */
	util.loading = function( $w, viewFunc ) {
		
		if ( typeof $w === "boolean" ) {
			viewFunc = $w;
			$w = undefined;
		}
		
		if ( $w == undefined ) {
			$w = $("#container");
			if ( $w.length <= 0 ) {
				$w = $(".container");
				if ( $w.length <= 0 ) {
					$w = $("body");
				}
			}
		}

		var $loading = $w.find(".f_data-loading-area");
		
		if ( $loading.length <= 0 ) {
			$w.prepend("<div class='f_data-loading-area loading'></div>");
			$loading = $w.find(".f_data-loading-area");
			Spinner({lines:10,length:8,width:8,radius:14,corneers:1,rotete:0,trail:50,speed:1}).spin( $loading.get(0) );
			$loading.addClass("_f_set").hide();
			$w.addClass("p_rel");	// position:relative
		}
		
		if ( viewFunc != undefined ) {
			if ( viewFunc ) {
				$loading.show();
			} else {
				$loading.hide();
			}
			return viewFunc;
		}

		$loading.toggle();
		
	}
	
	/**
	 * 濡쒕뵫 蹂댁씠湲�
	 */
	util.loading.show = function( $w ) {
		util.loading($w, true);
	}
	
	/**
	 * 濡쒕뵫 �④린湲�
	 */
	util.loading.hide = function( $w ) {
		util.loading($w, false);
	}
	
	/**
	 * Center Loading 
	 */
	util.centerLoading = function( bool ) {
		var $w = $("body");
		
		var $loading = $w.find(" > .f_data-loading-area");
		
		if ( $loading.length <= 0 ) {
			$w.prepend("<div class='f_data-loading-area loading'></div>");
			$loading = $w.find(".f_data-loading-area");
			//Spinner({lines:10,length:8,width:8,radius:14,corneers:1,rotete:0,trail:50,speed:1}).spin( $loading.get(0) );
			$loading.addClass("_f_set").hide();
		}
		
		if ( bool === true ) {
			$loading.show();
		} else if ( bool === false ) {
			$loading.hide();
		} else {
			$loading.toggle();
		}
	}
	
	/**
	 * 媛믪씠 "", null, undefined, "null", "undefined" �� 寃쎌슦 湲곕낯媛믪쑝濡� 諛섑솚
	 * 
	 * util.nvl(��寃잕컪, 湲곕낯媛�);
	 * @return 怨듬갚�대굹 媛믪씠 �놁쓣 寃쎌슦 - 湲곕낯媛� / �꾨땲硫� ��寃잕컪 
	 */
	util.nvl = function(value, replacer) {
		if ( typeof replacer === "undefined" ) {
			replacer = "";
		}
		if ( value == "" || value == null || value == "null" || value == "undefined" ) {
			return replacer;
		} else {
			return value;
		}
	}
	
	/**
	 * �덈룄�� �앹뾽 怨듯넻��
	 * 
	 * util.popup(�앹뾽二쇱냼, �앹뾽�덈룄�곕챸, �볦씠, 湲몄씠, top�꾩튂, left�꾩튂, 異붽� �듭뀡)
	 */
	util.popup = function(url, name, width, height, top, left, option, returnWin){
		var strOpt = "";
		var rtnWin = undefined;
		var returnOpt = function(optName, optValue) {
			if ( optValue != "" ) {
				return optName + "=" + optValue + ",";
			}
			return "";
		};

		strOpt += returnOpt("width", width);
		strOpt += returnOpt("height", height);
		strOpt += returnOpt("top", top);
		strOpt += returnOpt("left", left);

		if ( option != "" )
			strOpt += option;
        if ( url == "" )
			url = "about:blank";

        //ie8�먯꽌 name愿��� 踰꾧렇瑜� 媛쒖꽑�섍린�꾪빐 �꾩썙�곌린瑜� �쒓굅�쒕떎.
		name = name.replace(" ", "");

		rtnWin = window.open(url, name, strOpt);
		if ( returnWin == "Y" ) {
			return rtnWin;
		}
	};
	
	/**
	 * dateFormat
	 * 
	 * util.dateFormat(Date, "Format")
	 * yyyy	: �ㅼ옄由� �꾨룄
	 * yy	: �먯옄由� �꾨룄
	 * MM	: �먯옄由� ��
	 * dd	: �먯옄由� ��
	 * E	: �붿씪
	 * HH	: 24�쒓컙�� �쒓컙
	 * hh	: 12�쒓컙�� �쒓컙
	 * mm	: �먯옄由� 遺�
	 * ss	: �먯옄由� 珥�
	 * a/p	: �ㅼ쟾/�ㅽ썑
	 */
	util.dateFormat = function(dt, formatStr) {
		
		if ( dt == "" ) {
			dt = new Date();
		}
		
		if (!dt.valueOf()) return " ";
			혻
	혻혻혻혻var weekName = ["�쇱슂��", "�붿슂��", "�붿슂��", "�섏슂��", "紐⑹슂��", "湲덉슂��", "�좎슂��"];
	혻혻혻혻var d = dt;
	혻혻혻혻return formatStr.replace(/(yyyy|yy|MM|dd|E|hh|mm|ss|a\/p)/gi, function($1) {
	혻혻혻혻혻혻혻혻switch ($1) {
	혻혻혻혻혻혻혻혻혻혻혻혻case "yyyy": return d.getFullYear();
	혻혻혻혻혻혻혻혻혻혻혻혻case "yy": return (d.getFullYear() % 1000).zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "MM": return (d.getMonth() + 1).zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "dd": return d.getDate().zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "E": return weekName[d.getDay()];
	혻혻혻혻혻혻혻혻혻혻혻혻case "HH": return d.getHours().zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "hh": return ((h = d.getHours() % 12) ? h : 12).zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "mm": return d.getMinutes().zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "ss": return d.getSeconds().zf(2);
	혻혻혻혻혻혻혻혻혻혻혻혻case "a/p": return d.getHours() < 12 ? "�ㅼ쟾" : "�ㅽ썑";
	혻혻혻혻혻혻혻혻혻혻혻혻default: return $1;
	혻혻혻혻혻혻혻혻}
	혻혻혻혻});
	
	}
	
	
	/**
	 * doFileDown
	 * 
	 * doFileDown(filePath, fileNm)
	 * filePath	: �뚯씪寃쎈줈(猷⑦듃 �쒖쇅)
	 * fileNm	: �쒖뒪�� �뚯씪紐�
	 */
	util.doFileDown = function(filePath, fileNm) {
		
		var paramVal1 = filePath;
		var paramVal2 = fileNm;
		
		var param = "fileView="+encodeURIComponent(paramVal1)+"&orgFileName="+encodeURIComponent(paramVal2);
		$(location).attr('href',HM.config.CONTEXT_PATH+'/fileDown.hm?'+param);
	}
	
	String.prototype.string = function(len){
		var s = '', i = 0; while (i++ < len) { s += this; } return s;
	};
	String.prototype.zf = function(len){
		return "0".string(len - this.length) + this;
	};
	Number.prototype.zf = function(len){
		return this.toString().zf(len);
	};
	
	/**
	 * �좎쭨 datepicker �ㅼ젙
	 * �쒖옉~�� �쇰줈 �ㅼ젙�� �� �덈룄濡� rangeDatePicker
	 * 
	 * util.rangeDatePicker($�쒖옉��, $�앺뤌);
	 */
	
	util.rangeDatePicker = function($start, $end) {
		
		var sDate = util.convertDate($start.val());
		var eDate = util.convertDate($end.val());
		
		$start.val(sDate);
		$end.val(eDate);

		$start.datepicker({
			onClose: function( selectedDate ) {
				$end.datepicker( "option", "minDate", selectedDate );
			},
			maxDate : $end.val()
		});

		$end.datepicker({
			onClose: function( selectedDate ) {
				$start.datepicker( "option", "maxDate", selectedDate );
			},
			minDate : $start.val() 
		});
	}
	
	util.convertDate = function(strD) {
		if ( strD.length == 8 ) {
			return strD.substr(0, 4) + "-" + strD.substr(4, 2) + "-" + strD.substr(6, 2); 
		} else {
			return strD;
		}
	}
	
	util.getDomain = function() {
		var url = location.hostname;
		var p = new RegExp(/\.+(.*)/);
		var tmpUrl = p.exec(location.hostname);
		if ( tmpUrl != null && tmpUrl.length > 1 ) {
			url = tmpUrl[1];
			if ( url.indexOf(".") >= 0 ) {
				return url;
			}
		}
		return location.hostname;
	}
	
	/**
	 * �ㅻⅨ �곸뿭 �대┃�섎㈃ �ロ엳�� �덉씠�꾩썐 �앹뾽 留뚮뱾湲�
	 */
	util.layerPopup = function($t) {
		if ( $t.is(":visible") ) {
			$(document).unbind(".layout");
			$t.hide();
		} else {
			$t.show();
			$(document).on("click.layout", function(e){
				if ( $t.is(":visible") ) {
					var target = e.target || e.srcElement;
					var chkChild = $t.find(target).length > 0 ;
					if ( !chkChild ) {
						setTimeout(function(){$t.hide()}, 10)
						$(document).unbind(".layout");
					}
				}
			});
		}
	}
	
	/**
	 * �좎쭨�뺤떇 吏���(YYYY-MM-DD)
	 *function setDate(input)  {
	 */
	util.setDate = function(input){
		input = input.replaceAll("-","");
	    if (input.length == 8) {
		    return  input.substring(0,4)+'-'+input.substring(4,6)+'-'+input.substring(6,8);
	    }
	    else return input;
	}
	
	/**
	 * �좎쭨�뺤떇 吏���(YY.MM.DD)
	 *function setDateYyMmDd(input)  {
	 */
	util.setDateYyMmDd = function(input){
		input = input.replaceAll("-","");
	    if (input.length == 8) {
	    	
		    return input.substring(2,4)+"."+input.substring(4,6)+'.'+input.substring(6,8);
	    }
	    else return input;
	}
	
	/**
	 * 泥댄겕踰꾪듉 �꾩껜�좏깮
	 * function(allCheckId, elementId)
	 * HM.util.allCheck("allCheck", "checkId");
	 */
	util.allCheck = function(allCheckId, elementId){
		
		if ($("#"+allCheckId+"").is(":checked")) {
			$('[id='+elementId+']').each(function() {
				$(this).prop("checked", true);
			});
		} else {
			$('[id='+elementId+']').each(function() {
				$(this).prop("checked", false);
			});
		}
	}
	
	/**
	 * 泥댄겕�� 媛믪쓣 諛곗뿴濡� 諛섑솚
	 * function(checkId)
	 * HM.util.checkedValues("checkId");
	 */
	util.checkedValues = function(checkId){
		
		var checkArr = [];
		  $("input[id="+checkId+"]:checked").each(function(i){
			  checkArr.push($(this).val());
		  });
		
		  return checkArr;
		  
	}	
	
	/**
	 * String�� �덈뒗 臾몄옄 replaceAll
	 * parameter : 
	 * return : void
	 */
	String.prototype.replaceAll = function(s1, s2) { 
		if ("" == this) {
			return "";
		}

		var arrStr = this.split(s1);
		var resultVal = this;

		for (var idx=0; idx<arrStr.length; idx++) {
			resultVal = resultVal.replace(s1, s2);
		}

		return resultVal;
	}

	/**
	 * 留먯쨪�� �곸슜
	 * function(str, len)
	 * HM.util.textSubByte("媛��섎떎�쇰쭏諛붿궗", 4);
	 */
	util.textSubByte = function(str, len){
		
		 var s = 0;
		 for (var i=0; i<str.length; i++) {
		  s += (str.charCodeAt(i) > 128) ? 2 : 1;
		  if (s > len){
			  return str.substring(0,i)+"...";
		  }
		 }
		 return str;
		  
	}	
	
	/**
	 * 留먯쨪�� �곸슜
	 * function(str, len)
	 * HM.util.textSubLength("媛��섎떎�쇰쭏諛붿궗", 4);
	 */
	util.textSubLength = function(str, len){
		
		 var s = 0;
		 for (var i=0; i<str.length; i++) {
		  s += 1;
		  if (s > len){
			  return str.substring(0,i)+"...";
		  }
		 }
		 return str;
		  
	}		
	
	/**
	 *  �쇳겢由ъ뼱 �덈뱺媛� �쇰룄 紐⑤몢 珥덇린�� �쒗궡
	 */
	util.formClear = function(id){
		$("#" + id).find("input").each(function(idx,val){
			$(this).val('');
		});
	}
	
	util.appendList = function(url,params,callback){
		$.ajax({
				type : "post"
			,	url : url
			,	data : params
			,	cache : false
			,	async : false
			,	success : callback
			,   error : function(xhr, status, exception){
				alert("�꾩넚�� �ㅽ뙣�섏��듬땲��. \n (" + status + ")");
				return false;
			}
		});
	}
	
	/**
	 *  \n (Linefeed) --> <br> �쒓렇濡� 蹂���
	 */
	util.LF2BR = function(str){
		if(str == null || str == "")
			return "";
		else
			return str.replaceAll("\n", "<br>");
	}
	
	
	/**
	 * 釉뚮씪�곗� ���� 蹂���
	 */
	util.BrowserType = function(){
	
		var _ua = navigator.userAgent;
	    var rv = -1;
	     
	    //IE 11,10,9,8
	    var trident = _ua.match(/Trident\/(\d.\d)/i);
	    if( trident != null )
	    {

	        if( trident[1] == "7.0" ) return rv = "InternetExplorer" + 11;
	        if( trident[1] == "6.0" ) return rv = "InternetExplorer" + 10;
	        if( trident[1] == "5.0" ) return rv = "InternetExplorer" + 9;
	        if( trident[1] == "4.0" ) return rv = "InternetExplorer" + 8;
	    }
	   
	    //IE 7...
	    if( navigator.appName == 'Microsoft Internet Explorer' ) return rv = "InternetExplorer" + 7;
	    
	    
	    var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	    if(re.exec(_ua) != null) rv = parseFloat(RegExp.$1);
	    if( rv == 7 ) return rv = "InternetExplorer" + 7; 
	    
	     
	    //other
	    var agt = _ua.toLowerCase();
	    if (agt.indexOf("chrome") != -1) return 'Chrome';
	    if (agt.indexOf("opera") != -1) return 'Opera'; 
	    if (agt.indexOf("staroffice") != -1) return 'Star Office'; 
	    if (agt.indexOf("webtv") != -1) return 'WebTV'; 
	    if (agt.indexOf("beonex") != -1) return 'Beonex'; 
	    if (agt.indexOf("chimera") != -1) return 'Chimera'; 
	    if (agt.indexOf("netpositive") != -1) return 'NetPositive'; 
	    if (agt.indexOf("phoenix") != -1) return 'Phoenix'; 
	    if (agt.indexOf("firefox") != -1) return 'Firefox'; 
	    if (agt.indexOf("safari") != -1) return 'Safari'; 
	    if (agt.indexOf("skipstone") != -1) return 'SkipStone'; 
	    if (agt.indexOf("netscape") != -1) return 'Netscape'; 
	    if (agt.indexOf("mozilla/5.0") != -1) return 'Mozilla';
	    
	}
	
	/**
	 * HM.util �꾩뿭 �ㅼ젙
	 */
	HM.util = util;

})(HM, jQuery);

/**
 * console�� �녿뒗 寃쎌슦�� ���� ��泥�
 */
var console = window.console || {log:function(e){ }};

/**
 * POPUP CrossDomain 臾몄젣 �닿껐
 * @param e
 */
if (window.addEventListener) {
	window.addEventListener('message', windowMessage);
} else {	// IE8 or earlier
	window.attachEvent('onmessage', windowMessage);
}

function windowMessage(e) {
	var data = e.data;
	if ( typeof HM.util.windowMessageFunction == "function" ) {
		if ( typeof data === "string" ) {
			var winFunc = HM.util.executeFunctionByName(data, window);
			if ( typeof winFunc === "function" ) {
				winFunc();
			}
		} else {
			var extendFunc = e.data.extendFunc;
			// 以묐났 Function 泥섎━
			if ( extendFunc != undefined ) {
				var winFunc = HM.util.executeFunctionByName(extendFunc, window);
				if ( typeof winFunc === "function" ) {
					winFunc(e.data);
				}
			} else {
				HM.util.windowMessageFunction(e.data);
			}
		}
	} else {
		//console.log(e.data);
	}
}


/**
 *  �뚯씠釉� ��/�� 異붽���  �몃뱾留�
 */
function DynaListHelper(listDiv,data) {
	this.tbodyObj = $("table tbody",listDiv);
	this.data = data;

	this.initList = function(listDiv) {
		$("> tr",this.tbodyObj).remove();
	};

	this.makeTr = function() {
		$("table tbody",this.listDiv).append("<tr></tr>");
		return $("tr:last-child",this.tbodyObj);
	};

	this.makeTd = function(data) {
		$("tr:last-child",this.tbodyObj).append("<td>" + data + "</td>");
		return $("tr:last-child td:last-child",this.tbodyObj);
	};

	this.makeInput = function(tdObj, inputType) {
		tdObj.html('<input type="' + inputType +'"/>');
		return $("input",tdObj).first();
	};

	this.getTdObj = function(trIdx, tdIdx) {
		return $("tr:eq(" + trIdx+") td:eq(" + tdIdx + ")" ,this.tbodyObj);
	};
	
	this.removeTr = function(obj) {
		var idx = $("[id="+obj.id+"]").index(obj);
		
		$("tr:eq(" + idx +")", this.tbodyObj).remove();
	};
	
	
};


//�듯빀�쏀뭹�뺣낫 �곸꽭 媛�湲�
function _goProduct(prodSeq){
	location.href = "/product/productView.hm?prodSeq="+prodSeq;
}

//�쒓렇 寃��됲븯湲�
function _goSearchTag(tag){
	location.href = "/search/search.hm?mode=tag&srchNm="+tag;
}

//�쇱씠釉뚯떖�ъ��� 媛�湲�
function _goLiveSypmo(seq){
	location.href = "/symposium/schedulerequest/scheduleList.hm?openSeq="+seq;
}



// jQuery Ajax No Cache
$.ajaxSetup({
	cache: false
});

function g_selectBox(){
	/*���됲듃諛뺤뒪 */
	var sel;
	var node;
	var idx;
	$('.selectBox .selectArea li').on({
		click : function(){
			var tData = $(this).text();
			node = $(this).parent().parent().siblings('select');
			idx = $(this).index();
			sel = $(this).parent().siblings('.opt').text(tData);
			$(node).children().eq(idx).prop('selected',true);
			$(node).siblings('.selectArea').children('ul').show();
			$(node).trigger('change');
			$(this).parent().trigger('mouseleave');
		}
	});
	
	/* Select Box�먯꽌 留덉슦�쨚ut�쒖엯�덈떎. �� click�대깽�몄� �④퍡�ъ슜. */
	$('.selectBox .selectArea').on({
		mouseleave : function(){
			if($(this).children('ul').css('display') == "block"){
				$('.selectBox .selectArea .opt').removeClass('on');
				$(this).children('ul').slideUp(100);
				$(this).css({zIndex:'1',border:'1px solid #d6d6d6'});
			}
		}
	});
	
	//���됲듃諛뺤뒪 �놁뿉 �대━�� 踰꾪듉 �대┃�� 泥섎━�댁＜�� �대깽��.
	$('.selectBox .selectArea .opt').on({
		click : function(){
			if($(this).hasClass('on')!= true){
				$(this).siblings('ul').slideDown(100);
				$(this).addClass('on');
				$(this).parent().css({border:'1px solid #7a7a7a',zIndex:'10'});
			}else{
				$(this).siblings("ul").slideUp(100);
				$(this).parent().css({zIndex:'1',border:'1px solid #d6d6d6'});
				$(this).removeClass('on');
			}
		}
	});
}

$(document).ready(function(){
	g_selectBox();	
	
	
	/* 紐⑤컮�쇱뿉�� �섏젙 & ��젣 �� �リ린 */
	$("section").mousedown(function(e){
		if(!$('div.setMenu.on').has(e.target).length){
			$(".setMenu").removeClass("on");
		}
	});
	/*//紐⑤컮�쇱뿉�� �섏젙 & ��젣 �� �リ린 */
});
	
//寃��� 寃곌낵媛� �곸꽭 �섏씠吏�濡� Link to
function goDetail(seq, strTxt, gbn) {
	if (gbn == '05') {
		location.href = HM.config.CONTEXT_PATH + "/knowqa/knowQaBoardView.hm?cntntGbn="+strTxt+"&questSeq="+seq;
		
	} else if (gbn == '01') {
		location.href = HM.config.CONTEXT_PATH + "/symposium/symposiumlibry/mediaDetail.hm?mediaSeq="+seq;
		
	} else if (gbn == '17') {
		location.href = HM.config.CONTEXT_PATH + "/product/productView.hm?prodSeq="+seq;

	} else if (gbn == '20') {
		
		var url = HM.config.CONTEXT_PATH + "/showroom/showroomPopup.hm?seq="+seq;
		window.open(url, "detail", "width=1044px, height=650px,toolbar=no,status=yes,menubar=yes,resizable=no,scrollbars=no,titlebar=no,top=5,left=5");

	} else if (gbn == '21') {
		
		var url = HM.config.CONTEXT_PATH + "/ebrochure/ebrochurePopup.hm?seq="+seq;
		window.open(url, "detail", "width=1044px, height=650px,toolbar=no,status=yes,menubar=yes,resizable=no,scrollbars=no,titlebar=no,top=5,left=5");
		
	} else if (gbn == '04') {
		location.href = HM.config.CONTEXT_PATH + "/moveofgod/moveOfGodMain.hm?sysSeq="+seq+"&randomYn=N";

	} else if (gbn == '09') {
		location.href = HM.config.CONTEXT_PATH + "/event/eventView.hm?seq=" + seq;

	} else if (gbn == '13') {
		location.href = HM.config.CONTEXT_PATH + "/insuchr/insuChrView.hm?colSeq=" + seq;
	
	} else if (gbn == '03') {
		location.href = HM.config.CONTEXT_PATH + "/cardnews/cardNewsView.hm?newsSeq=" + seq+"&menuGbn="+HM.config.MEM_GBN;

	} else if (gbn == '23') {		
		location.href = HM.config.CONTEXT_PATH + "/jurnlmaterl/jurnlMaterlView.hm?jurnlSeq="+seq;
		
	} else if (gbn == '22') {
		location.href = HM.config.CONTEXT_PATH + "/patientedumng/patientEduMngList.hm";
	} 
	
}

/**
 * PcToMobile �섏씠吏� �대룞 湲�濡쒕쾶 function紐� g_遺숈씤��. 
 * @param redirectUrl : redirectUrl �놁쓣 寃쎌슦 /main/main.hm
 */
function g_pcToMobile(redirectUrl){
	var url = HM.config.CONTEXT_PATH + "/pcToMobile.hm";
	
	if(redirectUrl == undefined || redirectUrl == ""){
		location.href = url;
	}else{
		location.href = url + "?redirectUrl="+redirectUrl;
	}
}


function g_goProfile(profileGbn,param,memId) {
	if(param != null && param != ''){
		if(profileGbn == 'F'){
			//移쒓뎄 
			location.href= HM.config.CONTEXT_PATH + "/myhmp/profile/visitProfile.hm?nick="+param+"&memId="+memId;
		}else {
			//紐⑥엫
			location.href= HM.config.CONTEXT_PATH + "/prsnmng/groupartcl/groupArtclList.hm?cntntSeq="+param;
		}
	}
	
}

function g_goProfileTime(gbn,obj) {
	var $r = $(obj).closest("[name='replyForm']");
	var nick = $r.find("[name=replyWritrId]").text();
	g_goProfile(gbn,nick);
}