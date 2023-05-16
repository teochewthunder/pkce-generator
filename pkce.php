<!DOCTYPE html>
<html>
	<head>
		<title>PKCE Generator</title>

		<style>
			.inputlength
			{
				width: 100em;
			}
		</style>

		<script>
			let pkcegen = {
				genVerifier: function()
				{
					var strLength = this.randomNumber(43, 128);
					var verifier = "";

					for(let i = 0; i < strLength; i++) 
					{
						var currentChar;
						currentChar = this.genVerifierValidChar();

						verifier = verifier + currentChar;
					}

					document.getElementById("txtVerifier").value = verifier;
				},
				genVerifierValidChar: function()
				{
					var index = this.randomNumber(0, 50);

					switch(index)
					{
						case 0: return "-"; break;
						case 1: return "_"; break;
						case 2: return "~"; break;
						case 3: return "."; break;
						default: 
							var letterIndex = this.randomNumber(0, 3);
							switch(letterIndex)
							{
								case 0: return String.fromCharCode(this.randomNumber(48, 57)); break; 
								case 1: return String.fromCharCode(this.randomNumber(65, 90)); break; 
								default: return String.fromCharCode(this.randomNumber(97, 122)); break;
							}
							break;
					}

				},
				randomNumber: function(min, max)
				{
					return Math.floor(Math.random() * (max - min)) + min;
				}
			};
		</script>
	</head>

	<body>
		<?php
			$verifier="";
			$challenge = "";

			if (sizeof($_POST) > 0) 
			{
				$verifier = $_POST["txtVerifier"];
				$hash = hash("sha256", $verifier);
				$challenge = base64_encode(pack("H*", $hash));
				$challenge = strtr($challenge, "+/", "-_");
				$challenge = rtrim($challenge, "=");		
			}
		?>		
		<fieldset>
			<legend>PKCE Generator</legend>
			<form method="POST">
				1. Generate a Code Verifier. <button type="button" onclick="pkcegen.genVerifier();">Generate</button><br />
				<input id="txtVerifier" name="txtVerifier" maxlength="128" class="inputlength" value="<?php echo $verifier;?>" />
				<br />		
				<br />
				2. Generate Code Challenge. <button>Generate</button><br />
				<input class="inputlength" id="txtChallenge" value="<?php echo $challenge;?>" />
			</form>			
		</fieldset>
	</body>
</html>