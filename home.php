
<?php  

	include 'includes/CDN.php';
	include 'includes/navbar.php';
	session_start();
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>Meet Emma</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<script type="text/javascript">

    var accessToken = "c77d14f6105b4faabe0f5a9f251b9c7c",
      subscriptionKey = "1c55f87c-ecb9-42d0-a789-b846a09cb842",
      baseUrl = "https://api.api.ai/v1/",
      $speechInput,
      $recBtn,
      recognition,
      messageRecording = "Recording...",
      messageCouldntHear = "I couldn't hear you, could you say that again?",
      messageInternalError = "Oh no, there has been an internal server error",
      messageSorry = "I'm sorry,It seems that i have'nt learnt that thing yet but will do in some days.";

      $(document).ready(function() {
        $speechInput = $("#speech");
        $recBtn = $("#rec");

        $speechInput.keypress(function(event) {
          if (event.which == 13) {
            event.preventDefault();
            send();
          }
        });
          $recBtn.on("click", function(event) {
            switchRecognition();
          });
          $(".debug__btn").on("click", function() {
            $(this).next().toggleClass("is-active");
            return false;
          });
        });
      function startRecognition() {
        recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
            recognition.interimResults = false;

        recognition.onstart = function(event) {
          respond(messageRecording);
          updateRec();
        };
        recognition.onresult = function(event) {
          recognition.onend = null;
          
          var text = "";
            for (var i = event.resultIndex; i < event.results.length; ++i) {
              text += event.results[i][0].transcript;
            }
            setInput(text);
          stopRecognition();
        };
        recognition.onend = function() {
          respond(messageCouldntHear);
          stopRecognition();
        };
        recognition.lang = "en-US";
        recognition.start();
      }
      function stopRecognition() {
        if (recognition) {
          recognition.stop();
          recognition = null;
        }
        updateRec();
      }

      function switchRecognition() {
        if (recognition) {
          stopRecognition();
        } else {
          startRecognition();
        }
      }

      function setInput(text) {
        $speechInput.val(text);
        send();
      }

      function updateRec() {
        $recBtn.text(recognition ? "Stop" : "Speak");
      }

      function send() {
        var text = $speechInput.val();
        $.ajax({
          type: "POST",
          url: baseUrl + "query/",
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          headers: {
            "Authorization": "Bearer " + accessToken,
            "ocp-apim-subscription-key": subscriptionKey
          },
          data: JSON.stringify({q: text, lang: "en"}),

          success: function(data) {
            prepareResponse(data);
          },
          error: function() {
            respond(messageInternalError);
          }
        });
      }

      function prepareResponse(val) {
        var debugJSON = JSON.stringify(val, undefined, 2),
          spokenResponse = val.result.speech;

        respond(spokenResponse);
        debugRespond(debugJSON);
      }

      function debugRespond(val) {
        $("#response").text(val);
      }

      function respond(val) {
        if (val == "") {
          val = messageSorry;
        }

        if (val !== messageRecording) {
          var msg = new SpeechSynthesisUtterance();
          var voices=window.speechSynthesis.getVoices();
          msg.voiceURI = "native";
          msg.text = val;
          msg.lang = "en-US";
          var voices = window.speechSynthesis.getVoices();

          // msg.voice = voices.filter(function(voice) { return voice.name == 'Alex'; })[2];
          msg.voice=voices[2];
          msg.rate=0.9;
          msg.pitch=1;
          window.speechSynthesis.speak(msg);
        }

        $("#spokenResponse").addClass("is-active").find(".spoken-response__text").html(val);
      }
      function getVoices(){
      var timer = setTimeout(function() {
          var voices = speechSynthesis.getVoices();
          console.log(voices);
          var msg=new SpeechSynthesisUtterance();
           msg.voice = voices[2];
            clearInterval(timer);
         	 
      			}, 200);
 		 }
      </script>
	<style type="text/css">
		body,html{
  			width: 100%;
  			height: 100%;
  			padding: 0px;
  			margin: 0px;
  			background-color: #192837;
      		color:#fff;
		}
		.section_border{
			//border:2px solid black; 
			height: 100%;
		}
		input {
		  background-color: #126077;
		  border: 1px solid #3F7F93;
		  color: #A6CAE6;
		  font-family: "Titillium Web";
		  font-size: 20px;
		  line-height: 43px;
		  padding: 0 0.75em;
		  width: 400px;
		  -webkit-transition: all 0.35s ease-in;
		}
		textarea {
		  background-color: #070F24;
		  border: 1px solid #122435;
		  color: #606B88;
		  padding: 0.5em;
		  width: 100%;
		  -webkit-transition: all 0.35s ease-in;
		}
		input:active, input:focus, textarea:active, textarea:focus {
		  outline: 1px solid #48788B;
		}
		.debug__content {
		  font-size: 14px;
		  max-height: 0;
		  overflow: hidden;
		  -webkit-transition: all 0.35s ease-in;
		}
		.debug__content.is-active {
		  display: block;
		  max-height: 500px;
		}
		.btn:hover {
		  background-color: #1888A9;
		  color: #183035;
		}
		.spoken-response {
		  max-height: 0;
		  overflow: hidden;
		  -webkit-transition: all 0.35s ease-in;
		}
		.spoken-response.is-active {
		  max-height: 400px;
		}
		.spoken-response__text {
		  background-color: #040E23;
		  color: #7584A2;
		  padding: 1em;
		}
		.btn {
		  background-color: #126178;
		  border: 1px solid #549EAF;
		  color: #549EAF;
		  cursor: pointer;
		  display: inline-block;
		  font-family: "Titillium Web";
		  font-size: 20px;
		  line-height: 43px;
		  padding: 0 0.75em;
		  text-align: center;
		  text-transform: uppercase;
		  -webkit-transition: all 0.35s ease-in;
		}
	</style> 
</head>
<body onload="getVoices()">

<div class="container-fluid" style="margin-top:0px; font-family: 'Raleway', sans-serif;">
	<div class="row" style="height: 80%">
		<div class="col-sm-2 section_border" >
			<?php include'includes/sidebar.php'; ?>
		</div>
		<div class="col-sm-7 section_border" style="font-family: "Titillium Web", Arial, sans-serif;">
<!-- 			<iframe src="material_search.html" style="width: 100%;height: 100%"></iframe>
 -->		<input id="speech" type="text">	
 			<button id="rec" class="btn">Speak</button>
 		<div class="spoken-response" id="spokenResponse">
 			<div class="spoken-response__text">
 				
 			</div>
 		</div>

 		<div class="debug">
 			<div class="debug__btn btn">
 				DEBUG JSON RESULTS
 			</div>
 		</div>
 		<div class="debug__content">
 			<textarea id="response" cols="40" rows="20">
 				
 			</textarea>
 		</div>
 		</div>
		<div class="col-sm-3 section_border"
		 style="background-image:url('http://cache4.asset-cache.net/xd/505229569.jpg?v=1&c=IWSAsset&k=2&d=62CA815BFB1CE48053E4E3C9F9FFA16F86871D979DBBA836C62C6C731A6616AADB1EAF54E7E3BE9A'); background-size:cover; color:#fff;">
  <?php if ($_SESSION['FBID']): ?>      <!--  After user login  -->
  	<div class="card" >
  	  <!--<img class="card-img-top" data-src="..." alt="Card image cap">-->
  	  <img  class=" card-image img-circle" style="margin:auto 20%;" src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture?type=large">
  	  <div class="card-block">
  	    <h4 class="card-title">Hello <?php echo $_SESSION['FULLNAME']; ?></h4>
  	    <p class="card-text">Your virtual assistant is up and running now.</p>
  	  </div>
  	  <ul class="list-group list-group-flush" style="color: #222">
  	    <li class="list-group-item"><?php echo $_SESSION['EMAIL']; ?></li>
  	    <li class="list-group-item">"LIVE,LAUGH,LOVE AND CODE" </li>
  	    <li class="list-group-item">&copy by Decode Black 96</li>
  	  </ul>
  	</div>

<?php else: ?>    
<?php header("Location:login_register.php"); ?>
<?php endif ?>
		</div>
	</div>
	<div class="row col-lg-12" style="height: 14%;background-color: #222;width:102%" > 
		<div class="col-lg-8 col-lg-offset-2" style="margin-top: 2%">
			<div class="col-sm-10">
				<input type="text" class="col-sm-8 form-control" placeholder="Say Something">
			</div>
			<div>
				<span class="pull-right col-sm-2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACrElEQVR42u2Xz2sTQRSAX8VSb1K8iNqKooJH2Ux6Ksn+iPQqxZMIehJB0do/IMhmQWsvHr2KSEGk0tSLIoWIYNUKij20F2/N7iaUZnYT0kYzzhMKs0HDJiTdLcwHDwKZSd63781LBiQSSW9JZdkhzfKm1Rz9mjZp/W9YdEU3vXv4HsQZ40FtNG36q5rls//Ej4tmbSS2T15Mvp3ExOPmEMQNbBtMMEyoljcFcQN7PqyAlqNfIG7gYQ0tYNIaxA1MrJPY3wImbUqBKAXSFv0tBSIVMOkvKRDtGKWN/T6FdqRAxFNoWwpEPIXqUqBT6ALU/UVgu8GW4GD3f6f9TRDYNJTDrk7YbtiqUumHwIYoUJuHERDAS0r4CvgFECgbY+cFAR7KT+g1POmCKFDNw6WggHc3fBtVb4CAoyauBgXIG+g1Xh5mRAGah6cggBd11fK/h7lOprIs0H6uRl6KAo5O7kOv4QmPiwJ4Jqqv4FiwCtXjvD2+tRmfK6kZ/ygI2HritK0rDVGgrClJ6DWMwYC/AGuCBMYcIC2V0CzvjmbRz3j3xUjn6CfeYreUJ2wQkGD75INPX1mFfsEFrrcIYCvdhC4paWQakxajpJMr0C9YFg54i7AsClRmh9/xnr0NHcInzZStk2aLwAcGMAD9pPIazvFKVDD5rdnhJeHLX5RTyRPQHpz5o66emMc9wdlPtvA8wF7Aq2BUHh1525qEo5JtR1WeOXpickO9cJIpyuD6xJmhYiZ5ytWSl3mlnuOaf+2zDaLDXmJrSgZ/MYVEugo+gSh+FkSBa4yd5Ul87DZ5XpFl/AyIEjzYjkau8WqshU2cr13HPbgX4gJOD97n465GZlyVvC9mSKloKI2iTnbwNT+gBX54H+IaXAtxJzE3ycSAFqSAFJACUkAikXD+AHj5/wx2o5osAAAAAElFTkSuQmCC" alt="microphone_img">
				</span>
			</div>
		</div>
	</div>
</div>
</body>
</html>