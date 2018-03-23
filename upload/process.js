var xmlHttp = createXmlHttpRequestObject();
function process() {
	if(xmlHttp) {
		try {
			xmlHttp.open("GET", "display.php", true);
			xmlHttp.onreadystatechange = handleRequestStateChange;
			xmlHttp.send(null);
		} catch (e) {
			alert("No connection to server");
		}
	}
}

function handleRequestStateChange() {
	if(xmlHttp.readyState == 4) {
		if(xmlHttp.status == 200) {
			try {
				handleServerResponse();
			} catch (e) {
				alert("Error : " + e.toString());
			}
		} else {
			alert("Error on transferring data :\n" + xmlHttp.statusText + ", status:" + xmlHttp.status);
		}
	}
}

function handleServerResponse() {
	var xmlResponse = xmlHttp.responseXML;
	if(!xmlResponse || !xmlResponse.documentElement) {
		throw("Invalid XML Document: \n" + xmlHttp.ResponseText);
	}
	var rootNodeName = xmlResponse.documentElement.nodeName;
	if(rootNodeName == "parseerror") throw("Invalid XML Document.");
	xmlRoot = xmlResponse.documentElement;
	file_names = xmlRoot.getElementsByTagName("file_name");
	file_sizes = xmlRoot.getElementsByTagName("file_size");
	file_descs = xmlRoot.getElementsByTagName("file_desc");
	names = xmlRoot.getElementsByTagName("name");
	file_exts = xmlRoot.getElementsByTagName("extension");

	var html = "";
	for(var i=0; i < file_names.length; i++) {
		var name = names.item(i).firstChild.data;

		var file_name = file_names.item(i).firstChild.data;
		var start = file_name.indexOf('_');
		var file_time = file_name.substring(0, start);
		var file = file_name.substring(start+1);

		var file_size = file_sizes.item(i).firstChild.data;
		var size = parseInt(file_size);
		if( size >= 1024*1024) {
			file_size = (size/1024/1024).toFixed(2) + " MegaByte";
		} else if( size >= 1024) {
			file_size = Math.round(size/1024) + " KiloByte";
		} else {
			file_size += " Byte";
		}


		var file_desc = file_descs.item(i).firstChild.data;

		var file_ext = file_exts.item(i).firstChild.data;
		file_ext = file_ext.toLowerCase();
		var src;
		if( file_ext == "pdf" || file_ext == "hwp") {
			src = "../image/" + file_ext + ".png";
		} else {
			src = "files/" + file_name;
		}
		html = "<div class='col-sm-3 col-dm-2'>"
			+ "<div class='thumnail'>"
				+ "<img src='" + src + "' alt='" + file_name + "' width='100' height='100'>"
				+ "<div class='caption'>" 
					+ "<h5>" + file + "</h5>"
					+ "<p>file size : " + file_size 
					+ "<p>Owner : " + name + "<br/>extenstion : " + file_ext + "<br/> Time : " + file_time
					+ "<br/>Description : " + file_desc + "</p>"
					+ "<p><a href='download.php?file=" + file_name + "' class='btn btn-primary' role='button'>" 
					+ "Download</a></p></div>"
			+ "</div></div>" + html;
	}
	html = "<div class='row'>" + html;
	html += "</div>";
	file_display = document.getElementById("file-display");
	file_display.innerHTML = html;
}
