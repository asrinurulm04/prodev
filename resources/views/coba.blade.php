<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form name="person">
  <input name="id_feasibility" value="1">
  <input name="id_data_mesin" value="2">
  <input name="runtime" value="2">
  <input name="standar_sdm" value="2">
</form>
<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
<script>
 // pre-fill FormData from the form
 let formData = new FormData(document.forms.person);

// add one more field
formData.append("3", "4");

// send it out
let xhr = new XMLHttpRequest();
xhr.open("POST", "http://127.0.0.1:8000/api/add");
xhr.send(formData);

xhr.onload = () => alert(xhr.response);
</script>
</html>