function hash_password(form, server_id, nonce) {
	passhash=hex_sha1(hex_sha1(form.p.value+server_id)+nonce);
	form.p.value="";
	form.hash.value=passhash;
}
function hash_change_password(form, server_id) {
	passhash=hex_sha1(form.p.value+server_id);
	newhash=hex_sha1(form.n.value+server_id);
	confirmhash=hex_sha1(form.c.value+server_id);
	form.p.value="";
	form.n.value="";
	form.c.value="";
	form.hash.value=passhash;
	form.newhash.value=newhash;
	form.confirmhash.value=confirmhash;
}
function hash_register(form, server_id,nonce) {
	passhash=hex_sha1(hex_sha1(form.p.value+server_id)+nonce);
	newhash=hex_sha1(form.n.value+server_id);
	confirmhash=hex_sha1(form.c.value+server_id);
	form.p.value="";
	form.n.value="";
	form.c.value="";
	form.hash.value=passhash;
	form.newhash.value=newhash;
	form.confirmhash.value=confirmhash;
}
