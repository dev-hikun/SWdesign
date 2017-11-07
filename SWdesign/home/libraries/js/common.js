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
		$frm.find("input[type=text], input[type=password], textarea[data-valid], select[data-valid]").each(function(){
			var $t = this;
			var t_val = util.trim($t);
			
			if($t.required == true){
				console.log($t);
			};
		});
		
		return false;
	}
	
	/**
	 * 공백 체크
	 *
	 */
	
	Werun.util = util;
})(Werun, jQuery);
