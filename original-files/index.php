<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Musical Turing Test</title>
<style>
li {
    vertical-align:middle;
    padding: 0.5em;
   }
li audio {
    position:relative;
    top: 0.5em;
    bottom: -0.5em;
    padding-right: 0.5em;
    /*
    display:block;
    */
}
    /*
input[type="radio"] {
    padding-left: 1em;
    padding-right: 1em;
    border-style: solid;
    border-width: 1px;
    background-color: "#557799";
}
    */
label {
    padding-left: 1em;
}
#vote {
    font-size: 1.2em;
}
</style>

<script>
function onLoadFunction() {
    var loadingMesg = document.getElementById("loadingMesg");
    loadingMesg.innerHTML = "<h4>Musical Turing Test</h4>";
    /* Discuss debugging the following line which is incorrect. */
    //loadingMesg[0].innerHTML = "<h4>Musical Turing Test</h4>";
    //document.getElementById("loadingMesg").style.color = "#888";
    //alert("onLoadFunction ran -- before innerHTML");
}

function checkSubmit(obj) {
    obj2=document.body.form[3].ol[1].li[7].label[2].input[1].style.backgroundColor="#22cc22";
    //body > form:nth-child(3) > ol:nth-child(1) > li:nth-child(7) > label:nth-child(2) > input:nth-child(1)
    //obj.style.backgroundColor="#1ec5e5";
    //obj.innerHTML="Release Me"
    //alert("Submit button pressed");
    var radioButtons = document.querySelectorAll("input[type='radio']");
    //alert(radioButtons.length);
    //for(i=0; i<radioButtons.length; i++) {
    for(i=0; i<2; i++) {
	radiobuttons[i].childNodes[0].innerHTML = '!!!';
	//alert(radioButtons.getAttribute("name"));
    }
    return true;
    /*
    for(i=0; i<10; i++) {
        //var button = document.getElementByName("song"+i);
        //var button = document.getElementByTagName("input");
	document.html.body[1].innerHTML+="x";
	button.value = "Yo!";
    }
    */
}

//window.addEventListener("load", onLoadFunction);
window.addEventListener("DOMContentLoaded", onLoadFunction, false);
window.addEventListener("submit", checkSubmit, false);

</script>
</head>
<body>
    <div id="loadingMesg">
    <h4>Loading Musical Turing Test ... </h4>
    </div>
	    <h1>Song List</h1>
	    <!--<form action="turing_submit.php" method="get" accept-charset="utf-8">-->
	    <form action="index.php" method="get" accept-charset="utf-8">
	    <ol>
	    <?php
		    #$filetype = "midi";
		    #$filetype = "mp3";
		    $filetype = "wav";
		    $files = glob(dirname(__FILE__) . "/*." . $filetype);
		    shuffle($files);
		    if(sizeof($files) == 0) {
			    print "<p>Sorry, no $filetype files were found.</p>";
		    }
		    $date = getdate();
		    $strdate = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . ":" . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"];
		    $handle = fopen("MusicTuring-" . $strdate . ".txt", "w");
		    # Only present ten choices from a set of 6 Bach + 6 EMI.
		    #for ($i=0; $i<sizeof($files); $i++) {
		    for ($i=0; $i<10; $i++) {
			    preg_match('/([^\/]+)$/', $files[$i], $matches);
			    fwrite($handle, $matches[0] . "\n");
			    print "<li><audio controls>\n";
			    #print "<source src=\"$matches[0]\" type=\"audio/mpeg\">\n
			    print "<source src=\"$matches[0]\" type=\"audio/wav\">
				   Your browser does not support the audio element for wav files\n";
			    print "</audio>\n";
			    print "<label><input type=\"radio\" name=\"song$i\" value=\"Bach\">Bach?</label>";
			    print "<label><input type=\"radio\" name=\"song$i\" value=\"EMI\">EMI?</label>";
			    //print "$matches[0]<br>\n";
			    # How to deal with needing different types of audio for different browsers. E.g., 
			    #<audio controls>
			    #  <source src="vincent.mp3" type="audio/mpeg"/>
			    #  <source src="vincent.ogg" type="audio/ogg"/>
			    #</audio>
			    #print "<input type=\"radio\" name=\"song$i\" value=\"human\">Human";
			    #print "<input type=\"radio\" name=\"song$i\" value=\"computer\">Computer";
			    print "</li>\n";
			    #print '<li><a href="' . $matches[0] . '">' . $matches[0] . '</a></li>';
	    /*
	    */
		    }
		    fclose($handle);
	    ?>
		    <!-- <p><input type="submit" value="Submit &rarr;"></p> -->
	    </ol>		
	    <!--<label>Click here when done: <input type="submit" value="Vote" id="vote" disabled></label>-->
	    <!--<label>Click here when done: <input type="submit" value="Vote" id="vote"></label>-->
	    <label>Click here when done: <input type="button" value="Vote" id="vote" onclick="checkSubmit(this)"></label>
	    </form>
</body>
</html>
