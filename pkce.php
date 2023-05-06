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
					var lastChar = "";

					for(let i = 0; i < strLength; i++) 
					{
						var currentChar;

						do 
						{
							currentChar = this.genVerifierValidChar();
						}
						while(currentChar == lastChar)

						lastChar = currentChar;
						verifier = verifier + currentChar;
					}

					document.getElementById("txtVerifier").value = verifier;
				},
				genVerifierValidChar: function()
				{
					var index = this.randomNumber(0, 20);

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
								case 0: return String.fromCharCode(this.randomNumber(48, 57)); break; //48-57
								case 1: return String.fromCharCode(this.randomNumber(65, 90)); break; //65-90
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
			$PKCE = "";

			if (sizeof($_POST) > 0) 
			{echo print_r($_POST);
				$hash = hash("sha256", $_POST["txtVerifier"]);
				$hash = base64_encode(pack('H*', $hash));
				$hash = strtr($hash, '+/', '-_');
				$hash = rtrim($hash, '=');
				$PKCE = $hash;	
						
			}
		?>		
		<form method="POST">
			1. Generate a Code Verifier. <button type="button" onclick="pkcegen.genVerifier();">Generate</button><br />
			<input id="txtVerifier" name="txtVerifier" maxlength="128" class="inputlength" />
			<br />		

			2. Generate PKCE <button>Generate</button><br />
			<textarea class="inputlength" rows="10" id="txtPKCE"><?php echo $PKCE;?></textarea>
		</form>
	</body>
</html>