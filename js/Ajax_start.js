function createXmlHttpRequestObject() {
	var xmlHttp;

	xmlHttp = new XMLHttpRequest();

	if(!xmlHttp) {
		alert("Error occurred");
	} else {
		return xmlHttp;
	}
}
