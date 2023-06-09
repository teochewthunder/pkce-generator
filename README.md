# pkce-generator
This is a basic PKCE (Proof-key Cert Exchange) generator which will generate an OAuth2 Code Verifier and Code Challenge. The Verifier will be generated by JavaScript and the output will be used to generate a Code Challenege in PHP.

## HTML
There is a HTML form with two textboxes and two buttons.
- The first textbox is `txtVerifier` and the accompanying button calls a JavaScript method to populate it with the generated Code Verifier.
- The second textbox is `txtChallenge` and the accompanying button submits the form.

## Code Verifier (generated by JavaScript)
- The string has to be 43 to 128 characters in length.
- Only characters `-`, `_`, `~`, `.`, `a - z`, `A - Z`, `0 - 9` are allowed.
- The script randomizes an occurence of each in a string of the required length, then populates `txtVerifier` with the value.

## Code Challenge (generated by PHP)
- The text value of `txtVerifier` is put through the `hash()` function to obtain the SHA-256 hash.
- Normally, we should be able to simply do a base64 encode, but PHP's `base64_encode()` function has some limitations, so we need to call the `pack()` function first.
- Replace all `+` characters with `-`.
- Replace all `/` characters with `_`.
- Remove trailing `=` characters.
