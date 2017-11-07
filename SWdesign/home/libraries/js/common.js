/*
 * file   : common.js
 * author : Heehyeon, lee
 * cDate  : 2017. 10. 27
 */

var Werun = Werun || {};



/**
 * 위런 UTIL
 * @param Werun
 * @param jQuery
 */
(function(Werun, jQuery){

	var util = Werun.util || {};

	/**
	 * 이메일 체크
	 */
	util.EmailCheck = function(s){
		var pattern = /^([a-zA-Z0-9_\.])+(@{1})[a-zA-Z0-9]+\.+[a-zA-Z0-9(?:\.)?]+$/;
		return pattern.test(s);
	}

	util.PhoneCheck = function(s){
		var pattern = /^([0-9]{3,4})+-+([0-9]{3,4})+-+([0-9]{3,4})+$/;
		return pattern.test(s);
	}
	/**
	 * 공백 제거값 반환
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
	 * 공백 체크
	 * util.BlankCheck(인풋객체)
	 */
	 util.BlankCheck = function(s){
	 	if(s.value == undefined || s.value == ""){
	 		return true;
	 	}

	 	return false;
	 }

	/**
	 * 입력 불가능한 스트링이 있는지 검사
	 * util.SpecialCharCheck(인풋객체)
	 */
	 util.SpetialCharCheck = function(s){
	 	var str = s.value;
		var special_pattern = /[$|\<\>\\\'\"\;]+/gi;
		return special_pattern.test(str);
	 }

	 /**
	  * 인풋 밸류 length 검사
	  */
	  util.LengthCheck = function(s, l){
	  	if(s.length >= l) return true;
	  	return false;
	  }

	/**
	 * 폼을 체크함
	 * util.FormCheck(폼 객체)
	 *
	 * 폼 내의 input을 Validation 함
	 *
	 * required : 필수값 체크
	 * data-valid-msg = "빈 값을 넣어주세요." : validation이 실패했을 경우 메시지
	 *
	 * => Validation 성공시 : return true
	 * => Validation 실패시 : alert, focus, return false
	 */
	util.FormCheck = function($frm){
		var returnVal = true;
		var msg = null;
		var obj = null;
		$frm.find("input[type=text], input[type=password], textarea[data-valid], select[data-valid]").each(function(){

			var $t = this;
			var t_val = util.trim($t.value);

			//필수항목의 두번째 공백체크
			if($t.required == true){
				if(util.BlankCheck($t) == true){
					msg = $t.title + "을(를) 입력해주세요.";
					returnVal = false;
					obj = $(this);
				}
			}

			//폼 내 입력 가능한 string 체크
			if(util.SpetialCharCheck($t) == true){
				msg = "사용할 수 없는 문자 (<>\\$;)가 들어있습니다.";
				returnVal = false;
				obj = $(this);
			}

			//전화번호 체크
			var name = $t.name.toLowerCase();
			if($t.name.indexOf("phone") != -1){
				if(util.PhoneCheck(t_val) == false){
					msg = "전화번호 형식이 잘못되었습니다.";
					returnVal = false;
					obj = $(this);
				}
			}

			//날짜 체크
			if(($t.name).indexOf("date") != -1 || ($t.name).indexOf("birth") != -1){
				if(util.DateCheck(t_val) == false){
					msg = "날짜 형식이 잘못되었습니다.";
					returnVal = false;
					obj = $(this);
				}
			}
		});

		if(msg != null) alert(msg);
		if(obj != null) obj.focus();
		return returnVal;
	}

	Werun.util = util;
})(Werun, jQuery);
