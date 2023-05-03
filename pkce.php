<!DOCTYPE html>
<html>
	<head>
		<title>PKCE Generator</title>

		<style>

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
		1. Generate a Code Verifier. <br />
		<input id="txtVerifier" name="txtVerifier" maxlength="128" style="width:500px" readonly/>
		<br />
		<button type="button" onclick="pkcegen.genVerifier();">Generate</button>
		<br />
		<textarea cols="30" rows="10" id="txt"></textarea>
		
	</body>
</html>