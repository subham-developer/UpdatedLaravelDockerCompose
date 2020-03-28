/*

	1. isrequired:
		isrequired is used for validating the input data. We have some of validation are given below.
		a. required: Input is compulsory
		b. alp_space: Input only accept alphabet and spaces
		c. email: Input should be email
		d. phone: Input contain number from 8 to 10 range
		e. minlength: Input is validate with min char limit
		f. maxlength: Input is validate with max char limit
		g. min: Input is validate with min value
		h. max: Input is validate with max value
		i. number: Input only required number
		j. pan: Input is validate as per pan format
		k. gst: Input is validate as per gst format

		Eg: <input type="phone" name="phone" isrequired="required|phone">

	2. funtionName: funtionName is use to call your own function. But it only accept the one parameter i.e jsonData

*/

var formSubmitCount = 0;

function submitForm(currentObj, formId, postUrl, funtionName = '', errorIdName = ''){

	if(formSubmitCount != 0){
		return false;
	}
	formSubmitCount++;

	var validationCount = 0;

	$('#'+formId).find('input').each(function(key, obj){
		var required = $(obj).attr('isrequired');
		var name = $(obj).attr('name');
		var value = $(obj).val();

		// console.log(name);

		var status = formValidation(name, value, required);

		if(status != true){
			// alert(status);
			if(errorIdName == ''){
        		alert(status);
        	}
        	else{
        		$("#"+errorIdName).find('strong').text(status);
        		$("#"+errorIdName).slideDown();
        		setTimeout(function(){
        			$("#"+errorIdName).slideUp();
        		}, 3500);
        	}
			$(obj).focus();
			validationCount++;
			return false;
		}
	})

	if(validationCount != 0){
		formSubmitCount = 0;
		return false;
	}


	$('#'+formId).find('textarea').each(function(key, obj){
		var required = $(obj).attr('isrequired');
		var name = $(obj).attr('name');
		var value = $(obj).val();

		// console.log(name);

		var status = formValidation(name, value, required);

		if(status != true){
			// alert(status);
			if(errorIdName == ''){
        		alert(status);
        	}
        	else{
        		$("#"+errorIdName).find('strong').text(status);
        		$("#"+errorIdName).slideDown();
        		setTimeout(function(){
        			$("#"+errorIdName).slideUp();
        		}, 3500);
        	}
			$(obj).focus();
			validationCount++;
			return false;
		}
	})


	if(validationCount != 0){
		formSubmitCount = 0;
		return false;
	}


	$('#'+formId).find('select').each(function(key, obj){
		var required = $(obj).attr('isrequired');
		var name = $(obj).attr('name');
		var value = $(obj).val();

		// console.log(name);

		var status = formValidation(name, value, required);

		if(status != true){
			// alert(status);
			if(errorIdName == ''){
        		alert(status);
        	}
        	else{
        		$("#"+errorIdName).find('strong').text(status);
        		$("#"+errorIdName).slideDown();
        		setTimeout(function(){
        			$("#"+errorIdName).slideUp();
        		}, 3500);
        	}
			$(obj).focus();
			validationCount++;
			return false;
		}
	})


	if(validationCount != 0){
		formSubmitCount = 0;
		return false;
	}

	var oldBtnText = $(currentObj).text();
    var oldOnClick = $(currentObj).attr("onclick");

    $(currentObj).removeAttr("onclick");
    $(currentObj).text("Please wait...");

	var form_obj = document.getElementById(formId);
    var form_data_object = new FormData(form_obj);

	$.ajax({
		type:"post",
		url:postUrl,
		data:form_data_object,
		contentType:false,
        processData:false,
        success:function(res){
        	try{

        		var jsonData = JSON.parse(res);

        		if(jsonData.code == 200){
        			$("#"+formId).trigger("reset");
        			if(funtionName != ''){
						var fn = window[funtionName];
						if (typeof fn === "function") fn(jsonData);
						if (typeof fn !== "function"){
							if(errorIdName == ''){
				        		alert(jsonData.message)
				        	}
				        	else{
				        		$("#"+errorIdName).find('strong').text(jsonData.message);
				        		$("#"+errorIdName).slideDown();
				        		setTimeout(function(){
				        			$("#"+errorIdName).slideUp();
				        		}, 3500);
				        	}
						}
        			}
        			else{
        				// alert(jsonData.message)
        				if(errorIdName == ''){
			        		alert(jsonData.message)
			        	}
			        	else{
			        		$("#"+errorIdName).find('strong').text(jsonData.message);
			        		$("#"+errorIdName).slideDown();
			        		setTimeout(function(){
			        			$("#"+errorIdName).slideUp();
			        		}, 3500);
			        	}
        			}
        		}
        		else{
        			// alert(jsonData.message);
        			if(errorIdName == ''){
		        		alert(jsonData.message)
		        	}
		        	else{
		        		$("#"+errorIdName).find('strong').text(jsonData.message);
		        		$("#"+errorIdName).slideDown();
		        		setTimeout(function(){
		        			$("#"+errorIdName).slideUp();
		        		}, 3500);
		        	}
        		}
        	}
        	catch(ex){
        		console.log(ex);
        		// alert('Server side error');
        		if(errorIdName == ''){
	        		alert('Server side error')
	        	}
	        	else{
	        		$("#"+errorIdName).find('strong').text('Server side error');
	        		$("#"+errorIdName).slideDown();
	        		setTimeout(function(){
	        			$("#"+errorIdName).slideUp();
	        		}, 3500);
	        	}
        	}


        	$(currentObj).attr("onclick", oldOnClick);
            $(currentObj).text(oldBtnText);
        },
        error:function(res){
        	if(errorIdName == ''){
        		alert('Network issue');
        	}
        	else{
        		$("#"+errorIdName).find('strong').text('Network issue');
        		$("#"+errorIdName).slideDown();
        		setTimeout(function(){
        			$("#"+errorIdName).slideUp();
        		}, 3500);
        	}
        	
        	$(currentObj).attr("onclick", oldOnClick);
            $(currentObj).text(oldBtnText);
            console.log(res);
        }
	});
	formSubmitCount = 0;
	return false;

}


function formValidation(name, value, condition){


	// if(!isset($_REQUEST[$DbconnectionName])){
	// 	return ucfirst($DbconnectionName).' is not set';
	// }

	if(condition == "" || condition == null || condition == undefined){
		return true;
	}

	if(!condition.includes("|")){
		condition = condition + "|";
	}

	var arrayContition = condition.split("|");

	if(arrayContition.length == 0){
		return true;
	}

	for (var i = 0; i < arrayContition.length; i++) {
		// console.log(arrayContition[i]);
		var tempNameArray = name.replace(/[\[\]']+/g, "").split('_');
		name = '';
		for (var j = 0; j < tempNameArray.length; j++) {
			name = name+' '+tempNameArray[j]
		}

		switch(arrayContition[i]){

			case 'required':
				if(value == ""){
					return ucwords(name)+' is required fields';
				}
				break;

			case 'alp_space':
				var regExpression = /^[a-zA-Z ]+$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return ucwords(name)+' is required alphabet and space';	
				}
				break;

			case 'email':
				var regExpression = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return 'Incorrect email format found. Eg: abc@gmail.com';	
				}
				break;

			case 'phone':
				var regExpression = /^[1-9]{1}[0-9]{7,9}$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return 'Incorrect phone/mobile number found';
				}
				break;

			case 'number':
				var regExpression = /^[0-9]+$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return ucwords(name)+' is required only number';	
				}
				break;

			case 'string':
				var regExpression = /^[a-zA-Z]+$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return ucwords(name)+' is required only character';	
				}
				break;

			case 'pan':
				var regExpression = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return 'Incorrect PAN number found';	
				}
				break;

			case 'gst':
				var regExpression = /^([0-9]){2}([A-Za-z]){5}([0-9]){4}([A-Za-z]){1}([0-9]{1})([A-Za-z]){1}([0-9]){1}?$/;
				if(value != "" && value != null && value != undefined && !regExpression.test(value)){
					return 'Incorrect GST number found';	
				}
				break;

			default:
				var otherContition = arrayContition[i].split(":");
				if(value != "" && value != null && value != undefined && otherContition[0] == 'minlength'){
					if(value.length < otherContition[1]){
						return ucwords(name)+' should have min '+otherContition[1]+' character';
					}
				}

				if(value != "" && value != null && value != undefined && otherContition[0] == 'maxlength'){
					if(value.length > otherContition[1]){
						return ucwords(name)+' should have max '+otherContition[1]+' character';
					}
				}

				if(value != "" && value != null && value != undefined && otherContition[0] == 'min'){
					if(parseInt(value) < parseInt(otherContition[1])){
						return ucwords(name)+' should have min '+otherContition[1]+' value';
					}
				}

				if(value != "" && value != null && value != undefined && otherContition[0] == 'max'){
					if(parseInt(value) > parseInt(otherContition[1])){
						return ucwords(name)+' should have max '+otherContition[1]+' value';
					}
				}

				// return true;
				// break;
		}
	}


	return true;
}



function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}